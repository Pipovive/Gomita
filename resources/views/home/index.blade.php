@extends('layouts.app')
@section('title', 'Gomita – Plantillas Digitales Kawaii para tus Fiestas')

@section('meta')
    <meta name="description"
        content="Plantillas digitales descargables para cumpleaños, baby shower, bodas y más. Diseños kawaii editables en Canva. Descarga inmediata.">
    <meta property="og:title" content="Gomita – Plantillas Digitales">
    <meta property="og:description" content="Más de 2000 plantillas kawaii para tus celebraciones">
    <meta property="og:image" content="{{ asset('images/og-home.jpg') }}">
@endsection



@section('content')

    <!-- ═══ HERO ═══ -->
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-text">
                <div class="hero-tag">✨ +2.000 plantillas disponibles</div>
                <h1>Plantillas que hacen tus <span>fiestas</span> únicas</h1>
                <p>Descarga, personaliza e imprime desde casa. Diseños kawaii para todas tus celebraciones.</p>
                <div class="hero-btns">
                    <a href="categorias.html" class="btn-primary">🎉 Ver plantillas</a>
                    <a href="#novedades" class="btn-secondary">✨ Novedades</a>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat"><strong>2.000+</strong><span>Plantillas</span></div>
                    <div class="hero-stat"><strong>10K+</strong><span>Clientas felices</span></div>
                    <div class="hero-stat"><strong>⭐ 4.9</strong><span>Calificación</span></div>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-cards-preview">
                    <div class="hero-card-mini"><span class="emoji">🦄</span>Unicornio</div>
                    <div class="hero-card-mini"><span class="emoji">🎂</span>Cumpleaños</div>
                    <div class="hero-card-mini"><span class="emoji">🌸</span>Baby Shower</div>
                    <div class="hero-card-mini"><span class="emoji">✨</span>Stickers</div>
                </div>
            </div>
        </div>
    </section>


    {{-- ═══ PLANTILLAS NUEVAS ═══ --}}
    <section id="novedades">
        <div class="section-header">
            <h2>✨ Plantillas Nuevas</h2>
            <a href="{{ route('productos.index') }}">Ver todas →</a>
        </div>
        <div class="slider-outer">
            <button class="slider-arrow left" onclick="slide('slider-nuevas', -230)" aria-label="Anterior">&#10094;</button>
            <div class="slider-track" id="slider-nuevas">

                @forelse($nuevos as $producto)
                    <div class="product-card">
                        <a href="{{ route('productos.show', $producto->slug) }}">
                            <div class="img-wrap">
                                <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <div class="img-placeholder" style="display:none">
                                    {{ match ($producto->badge) {
                                        'popular' => '🔥',
                                        'nuevo' => '✨',
                                        'oferta' => '🏷️',
                                        'editable' => '🎨',
                                        'gratis' => '🆓',
                                        default => '🎀',
                                    } }}
                                </div>


                                @if ($producto->badge)
                                    <div class="product-badge badge-{{ $producto->badge }}">
                                        {{ strtoupper($producto->badge) }}
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="card-title">{{ $producto->nombre }}</div>
                                <div class="card-sub">{{ $producto->tipo_archivo }}</div>
                                <div class="card-footer">
                                    <div>
                                        @if ($producto->precio == 0)
                                            <span class="card-price" style="color:#06D6A0">Gratis</span>
                                        @else
                                            <span class="card-price">${{ number_format($producto->precio, 2) }}</span>
                                            @if ($producto->tiene_descuento)
                                                <span
                                                    class="card-price-old">${{ number_format($producto->precio_original, 2) }}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="card-stars">
                                        <span>★★★★★</span> ({{ $producto->resenas_count }})
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>No hay productos nuevos todavía.</p>
                @endforelse

            </div>
            <button class="slider-arrow right" onclick="slide('slider-nuevas', 230)"
                aria-label="Siguiente">&#10095;</button>
        </div>
    </section>

    {{-- ═══ MÁS DESCARGADAS ═══ --}}
    <section id="ofertas">
        <div class="section-header">
            <h2>🔥 Más Descargadas</h2>
            <a href="{{ route('productos.index') }}">Ver ranking →</a>
        </div>
        <div class="slider-outer">
            <button class="slider-arrow left" onclick="slide('slider-populares', -230)"
                aria-label="Anterior">&#10094;</button>
            <div class="slider-track" id="slider-populares">

                @forelse($destacados as $index => $producto)
                    <div class="product-card">
                        <a href="{{ route('productos.show', $producto->slug) }}">
                            <div class="img-wrap">
                                <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                                <div class="img-placeholder" style="display:none">⭐</div>

                                {{-- medalla para los primeros 3 --}}
                                @if ($index === 0)
                                    <div class="product-badge badge-top1">🥇 TOP 1</div>
                                @elseif($index === 1)
                                    <div class="product-badge badge-top2">🥈 TOP 2</div>
                                @elseif($index === 2)
                                    <div class="product-badge badge-top3">🥉 TOP 3</div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="card-title">{{ $producto->nombre }}</div>
                                <div class="card-sub">{{ $producto->tipo_archivo }}</div>
                                <div class="card-footer">
                                    <div>
                                        <span class="card-price">${{ number_format($producto->precio, 2) }}</span>
                                    </div>
                                    <div class="card-stars">
                                        <span>★★★★★</span> ({{ $producto->resenas_count }})
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>No hay productos destacados todavía.</p>
                @endforelse

            </div>
            <button class="slider-arrow right" onclick="slide('slider-populares', 230)"
                aria-label="Siguiente">&#10095;</button>
        </div>
    </section>

    {{-- ═══ CATEGORÍAS DESTACADAS ═══ --}}
    <section class="categorias-section">
        <div class="section-header">
            <h2>🗂️ Categorías Populares</h2>
            <a href="{{ route('categorias.index') }}">Ver todas →</a>
        </div>
        <div class="categorias-grid">
            @forelse($categorias as $categoria)
                <a href="{{ route('categorias.show', $categoria->slug) }}" class="categoria-card">
                    <span class="cat-icon">{{ $categoria->emoji }}</span>
                    <div class="cat-name">{{ $categoria->nombre }}</div>
                    <div class="cat-count">{{ $categoria->productos_activos_count ?? 0 }} plantillas</div>
                </a>
            @empty
                <p>No hay categorías disponibles.</p>
            @endforelse
        </div>
    </section>

    {{-- ═══ TRUST BAR ═══ --}}


@endsection

@push('scripts')
    <script>
        function slide(id, amount) {
            document.getElementById(id).scrollBy({
                left: amount,
                behavior: 'smooth'
            });
        }
    </script>
@endpush
