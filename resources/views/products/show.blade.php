@extends('layouts.app')

@section('title', $producto->nombre . ' – Gomita')

{{-- SEO específico por modalidad --}}
@section('meta')
    <meta name="description" content="{{ Str::limit($producto->descripcion, 155) }}">
    @if ($producto->modalidad === 'fisico')
        <meta name="geo.region" content="ES-CN">
        <meta name="geo.placename" content="Lanzarote, Canarias, España">
    @endif
@endsection

@section('content')

    {{-- ═══ BREADCRUMB ═══ --}}
    <div class="breadcrumb-wrap">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Inicio</a> <span>›</span>
            <a href="{{ route('categorias.index') }}">Categorías</a> <span>›</span>
            <a href="{{ route('categorias.show', $producto->categoria->slug) }}">
                {{ $producto->categoria->nombre }}
            </a> <span>›</span>
            <span>{{ $producto->nombre }}</span>
        </nav>
    </div>

    <div class="producto-layout">

        {{-- ═══ GALERÍA ═══ --}}
        <div class="galeria">
            <div class="galeria-main">
                <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" id="img-main"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                <div class="img-emoji" style="display:none">
                    {{ $producto->categoria->emoji ?? '🎀' }}
                </div>

                @if ($producto->badge)
                    <span class="badge-producto badge-{{ $producto->badge }}">
                        {{ $producto->badge_label }}
                    </span>
                @endif

                {{-- Badge de modalidad sobre la imagen --}}
                @if ($producto->modalidad === 'digital')
                    <span class="badge-modalidad badge-digital">⚡ Descarga inmediata</span>
                @elseif($producto->modalidad === 'fisico')
                    <span class="badge-modalidad badge-fisico">📦 Envío Lanzarote</span>
                @endif
            </div>

            <div class="galeria-thumbs">
                @forelse($producto->getMedia('galeria') as $i => $media)
                    <div class="thumb {{ $i === 0 ? 'active' : '' }}"
                        onclick="cambiarImagen(this, '{{ $media->getUrl() }}')">
                        <img src="{{ $media->getUrl('thumb') }}" alt="Vista {{ $i + 1 }}"
                            onerror="this.style.display='none'">
                    </div>
                @empty
                    @foreach (['🦄', '🏷️', '🎂', '🎈'] as $i => $emoji)
                        <div class="thumb {{ $i === 0 ? 'active' : '' }}">
                            <span style="font-size:20px">{{ $emoji }}</span>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>

        {{-- ═══ INFO DEL PRODUCTO ═══ --}}
        <div class="producto-info">

            {{-- Badges categoría + badge del producto --}}
            <div class="info-badges">
                <span class="info-badge badge-cat">
                    {{ $producto->categoria->emoji ?? '' }} {{ $producto->categoria->nombre }}
                </span>
                @if ($producto->badge)
                    <span class="info-badge badge-{{ $producto->badge }}">
                        {{ $producto->badge_label }}
                    </span>
                @endif
                @if ($producto->modalidad === 'fisico')
                    <span class="info-badge badge-fisico-pill">📦 Físico</span>
                @else
                    <span class="info-badge badge-digital-pill">⚡ Digital</span>
                @endif
            </div>

            <h1>{{ $producto->nombre }}</h1>

            {{-- Rating y ventas --}}
            <div class="rating-row">
                <span class="stars-big">
                    @for ($i = 1; $i <= 5; $i++)
                        {{ $i <= round($producto->rating_promedio) ? '⭐' : '☆' }}
                    @endfor
                </span>
                <span class="rating-text">
                    <a href="#resenas">{{ $producto->resenas_count }} valoraciones</a>
                </span>
                @if ($producto->modalidad === 'digital')
                    <span class="ventas-pill">🔥 +{{ $producto->ventas_count }} descargas</span>
                @else
                    <span class="ventas-pill">🛒 +{{ $producto->ventas_count }} vendidos</span>
                @endif
            </div>

            {{-- Precio --}}
            <div class="precio-row">
                @if ($producto->precio == 0)
                    <span class="precio-main" style="color:var(--teal)">Gratis</span>
                @else
                    <span class="precio-main">€{{ number_format($producto->precio, 2) }}</span>
                    @if ($producto->tiene_descuento)
                        <span class="precio-old">
                            €{{ number_format($producto->precio_original, 2) }}
                        </span>
                        <span class="precio-ahorro">
                            Ahorras {{ $producto->porcentaje_descuento }}%
                        </span>
                    @endif
                @endif
            </div>

            {{-- ── Info según modalidad ── --}}
            @if ($producto->modalidad === 'digital')
                <div class="descarga-info">
                    ⚡ Descarga inmediata tras la compra · 📁 Acceso de por vida
                </div>
            @elseif($producto->modalidad === 'fisico')
                {{-- Info de envío --}}
                <div class="envio-info-box">
                    <div class="envio-row">
                        <span>📦</span>
                        <span>Envío a domicilio en
                            <strong>{{ $producto->zona_envio ?? 'Lanzarote' }}</strong>
                        </span>
                    </div>
                    <div class="envio-row">
                        <span>🕐</span>
                        <span>Plazo de entrega:
                            <strong>
                                {{ $producto->detalles['plazo_entrega'] ?? '2–4 días laborables' }}
                            </strong>
                        </span>
                    </div>
                    {{-- Stock en tiempo real --}}
                    <div class="envio-row">
                        <span>📊</span>
                        @if ($producto->stock === null || $producto->stock > 10)
                            <span class="stock-ok">✅ En stock</span>
                        @elseif($producto->stock > 0)
                            <span class="stock-poco">
                                ⚠️ ¡Solo quedan {{ $producto->stock }} unidades!
                            </span>
                        @else
                            <span class="stock-agotado">❌ Agotado</span>
                        @endif
                    </div>
                    <div class="envio-row">
                        <span>✏️</span>
                        <span>{{ $producto->detalles['personalizacion'] ?? 'Personalización incluida' }}</span>
                    </div>
                </div>
            @endif

            <div class="divider"></div>

            {{-- Tags del producto --}}
            @if ($producto->tags && count($producto->tags) > 0)
                <div class="tags-wrap">
                    <span class="tags-label">🏷️ Etiquetas:</span>
                    <div class="tags-list">
                        @foreach ($producto->tags as $tag)
                            <a href="{{ route('productos.index', ['q' => $tag]) }}" class="tag-pill">
                                {{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="divider"></div>
            @endif

            {{-- Contenido del kit (digital) o materiales (físico) --}}
            @if ($producto->modalidad === 'digital')
                <div class="kit-titulo">🎁 ¿Qué incluye este kit?</div>
                <div class="kit-items">
                    @if ($producto->detalles && isset($producto->detalles['archivos_incluidos']))
                        <div class="kit-item">
                            <span>📁</span> {{ $producto->detalles['archivos_incluidos'] }}
                        </div>
                    @endif
                    @if ($producto->tipo_archivo)
                        <div class="kit-item">
                            <span>📄</span> Formato: {{ $producto->tipo_archivo }}
                        </div>
                    @endif
                    @if (isset($producto->detalles['editable']))
                        <div class="kit-item">
                            <span>✏️</span> Editable: {{ $producto->detalles['editable'] }}
                        </div>
                    @endif
                    @if (isset($producto->detalles['resolucion']))
                        <div class="kit-item">
                            <span>🖨️</span> Resolución: {{ $producto->detalles['resolucion'] }}
                        </div>
                    @endif
                    @if (isset($producto->detalles['tamano_papel']))
                        <div class="kit-item">
                            <span>📐</span> Tamaño: {{ $producto->detalles['tamano_papel'] }}
                        </div>
                    @endif
                    @if (isset($producto->detalles['licencia']))
                        <div class="kit-item">
                            <span>⚖️</span> Licencia: {{ $producto->detalles['licencia'] }}
                        </div>
                    @endif
                </div>
            @else
                <div class="kit-titulo">📦 Detalles del producto físico</div>
                <div class="kit-items">
                    @if (isset($producto->detalles['material']))
                        <div class="kit-item">
                            <span>🧱</span> Material: {{ $producto->detalles['material'] }}
                        </div>
                    @endif
                    @if (isset($producto->detalles['medidas']))
                        <div class="kit-item">
                            <span>📐</span> Medidas: {{ $producto->detalles['medidas'] }}
                        </div>
                    @endif
                    @if (isset($producto->detalles['acabado']))
                        <div class="kit-item">
                            <span>✨</span> Acabado: {{ $producto->detalles['acabado'] }}
                        </div>
                    @endif
                    @if (isset($producto->detalles['embalaje']))
                        <div class="kit-item">
                            <span>📦</span> Embalaje: {{ $producto->detalles['embalaje'] }}
                        </div>
                    @endif
                    @if (isset($producto->detalles['minimo_pedido']))
                        <div class="kit-item">
                            <span>🔢</span> Mínimo: {{ $producto->detalles['minimo_pedido'] }}
                        </div>
                    @endif
                </div>
            @endif

            {{-- Formato (solo digitales) --}}
            @if ($producto->modalidad === 'digital' && $producto->tipo_archivo)
                <div class="formatos-wrap">
                    <div class="formatos-label">📄 Formato de descarga</div>
                    <div class="formatos-chips">
                        @foreach (explode('+', $producto->tipo_archivo) as $formato)
                            <button class="formato-chip {{ $loop->first ? 'active' : '' }}" onclick="selectFormato(this)">
                                {{ trim($formato) }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Cantidad (solo físicos o si el producto lo permite) --}}
            @if ($producto->modalidad === 'fisico')
                <div class="cantidad-wrap">
                    <span class="cantidad-label">Cantidad:</span>
                    <div class="cantidad-ctrl">
                        <button class="qty-btn" onclick="cambiarQty(-1)">−</button>
                        <input type="number" class="qty-input" id="qty" value="1" min="1"
                            max="{{ $producto->stock ?? 99 }}" readonly>
                        <button class="qty-btn" onclick="cambiarQty(1)">+</button>
                    </div>
                    @if ($producto->stock && $producto->stock <= 10)
                        <span class="stock-warning">
                            ⚠️ Solo {{ $producto->stock }} disponibles
                        </span>
                    @endif
                </div>
            @endif

            {{-- CTA --}}
            <div class="cta-wrap">
                @if ($producto->stock === 0)
                    <button class="btn-comprar btn-agotado" disabled>
                        ❌ Agotado
                    </button>
                @elseif($producto->precio == 0)
                    <button class="btn-comprar btn-gratis" onclick="agregarCarrito({{ $producto->id }})">
                        ⬇️ Descargar gratis
                    </button>
                @else
                    <button class="btn-comprar" onclick="agregarCarrito({{ $producto->id }})">
                        🛒 Agregar al carrito
                    </button>
                @endif
                <button class="btn-wish-big" id="wishBtn" onclick="toggleWish()">🤍</button>
            </div>

            <div class="garantia-row">
                🔒 Pago seguro ·
                @if ($producto->modalidad === 'digital')
                    ↩️ Reembolso en 7 días si no quedas conforme
                @else
                    ↩️ Devoluciones según política de la tienda
                @endif
            </div>

            <div class="divider"></div>

            {{-- Trust badges según modalidad --}}
            <div class="trust-mini">
                @if ($producto->modalidad === 'digital')
                    <div class="trust-mini-item">
                        <div class="ti">⚡</div>
                        <p>Descarga inmediata</p>
                    </div>
                    <div class="trust-mini-item">
                        <div class="ti">🖨️</div>
                        <p>Imprime en casa</p>
                    </div>
                    <div class="trust-mini-item">
                        <div class="ti">✏️</div>
                        <p>100% editable</p>
                    </div>
                    <div class="trust-mini-item">
                        <div class="ti">♾️</div>
                        <p>Acceso de por vida</p>
                    </div>
                @else
                    <div class="trust-mini-item">
                        <div class="ti">🤝</div>
                        <p>Hecho a mano</p>
                    </div>
                    <div class="trust-mini-item">
                        <div class="ti">🏝️</div>
                        <p>Entrega Lanzarote</p>
                    </div>
                    <div class="trust-mini-item">
                        <div class="ti">✏️</div>
                        <p>Personalizado</p>
                    </div>
                    <div class="trust-mini-item">
                        <div class="ti">📦</div>
                        <p>Embalaje seguro</p>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- ═══ TABS ═══ --}}
    <div class="tabs-section">
        <div class="tabs-nav">
            <button class="tab-btn active" onclick="showTab('descripcion', this)">
                📋 Descripción
            </button>
            <button class="tab-btn" onclick="showTab('detalles', this)">
                📄 Especificaciones
            </button>
            <button class="tab-btn" onclick="showTab('resenas', this)" id="tab-btn-resenas">
                ⭐ Reseñas ({{ $producto->resenas_count }})
            </button>
            <button class="tab-btn" onclick="showTab('relacionados', this)">
                💝 También te puede gustar
            </button>
        </div>

        {{-- TAB: DESCRIPCIÓN --}}
        <div class="tab-panel active" id="tab-descripcion">
            <div class="desc-grid">
                <div class="desc-text">
                    <p>{{ $producto->descripcion_larga ?? $producto->descripcion }}</p>

                    {{-- Tags clickables al final de la descripción --}}
                    @if ($producto->tags && count($producto->tags) > 0)
                        <div class="desc-tags">
                            @foreach ($producto->tags as $tag)
                                <a href="{{ route('productos.index', ['q' => $tag]) }}" class="tag-pill">
                                    #{{ $tag }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Info de envío en la descripción (físicos) --}}
                @if ($producto->modalidad === 'fisico')
                    <div class="info-box info-box-envio">
                        <h4>🚚 Información de envío</h4>
                        <div class="info-row">
                            <span class="label">Zona de entrega</span>
                            <span class="value">{{ $producto->zona_envio ?? 'Lanzarote' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="label">Plazo de entrega</span>
                            <span class="value">
                                {{ $producto->detalles['plazo_entrega'] ?? '2–4 días laborables' }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="label">Embalaje</span>
                            <span class="value">
                                {{ $producto->detalles['embalaje'] ?? 'Caja protectora' }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="label">Stock actual</span>
                            <span class="value">
                                @if ($producto->stock > 10)
                                    ✅ Disponible
                                @elseif($producto->stock > 0)
                                    ⚠️ {{ $producto->stock }} unidades
                                @else
                                    ❌ Agotado
                                @endif
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- TAB: ESPECIFICACIONES --}}
        <div class="tab-panel" id="tab-detalles">
            @if ($producto->detalles && count($producto->detalles) > 0)
                <div class="info-box info-box-full">
                    <h4>
                        {{ $producto->modalidad === 'fisico' ? '📦 Especificaciones físicas' : '📄 Especificaciones del archivo' }}
                    </h4>
                    @foreach ($producto->detalles as $clave => $valor)
                        <div class="info-row">
                            <span class="label">
                                {{ ucfirst(str_replace('_', ' ', $clave)) }}
                            </span>
                            <span class="value">{{ $valor }}</span>
                        </div>
                    @endforeach

                    {{-- Campos extra del modelo que no están en detalles --}}
                    @if ($producto->modalidad === 'digital' && $producto->tipo_archivo)
                        <div class="info-row">
                            <span class="label">Formato</span>
                            <span class="value">{{ $producto->tipo_archivo }}</span>
                        </div>
                    @endif
                    @if ($producto->modalidad === 'fisico' && $producto->zona_envio)
                        <div class="info-row">
                            <span class="label">Zona de envío</span>
                            <span class="value">{{ $producto->zona_envio }}</span>
                        </div>
                        <div class="info-row">
                            <span class="label">Stock disponible</span>
                            <span class="value">{{ $producto->stock ?? '—' }} unidades</span>
                        </div>
                    @endif
                </div>
            @else
                <p class="text-muted">No hay especificaciones disponibles para este producto.</p>
            @endif
        </div>

        {{-- TAB: RESEÑAS --}}
        <div class="tab-panel" id="tab-resenas">
            <div class="resenas-header">
                <div class="resena-score">
                    <div class="score-num">{{ number_format($producto->rating_promedio, 1) }}</div>
                    <div class="score-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            {{ $i <= round($producto->rating_promedio) ? '⭐' : '☆' }}
                        @endfor
                    </div>
                    <div class="score-total">{{ $producto->resenas_count }} reseñas</div>
                </div>
            </div>
            <div class="resenas-lista">
                {{-- Hardcodeadas por ahora — futuro modelo Review --}}
                <div class="resena-card">
                    <div class="resena-top">
                        <div class="resena-avatar">A</div>
                        <div class="resena-meta">
                            <strong>Ana M.</strong>
                            <span>Hace 3 días</span>
                        </div>
                        <span class="resena-stars">⭐⭐⭐⭐⭐</span>
                    </div>
                    <p class="resena-text">Quedó hermoso, los colores salieron espectaculares.</p>
                    <div class="resena-verified">✅ Compra verificada</div>
                </div>
            </div>
        </div>

        {{-- TAB: RELACIONADOS --}}
        <div class="tab-panel" id="tab-relacionados">
            <div class="relacionados-grid">
                @forelse($relacionados as $rel)
                    <a href="{{ route('productos.show', $rel->slug) }}" class="rel-card">
                        <div class="rel-img">
                            <img src="{{ $rel->thumb_url }}" alt="{{ $rel->nombre }}"
                                onerror="this.style.display='none';
                                          this.nextElementSibling.style.display='block'">
                            <span style="display:none;font-size:2rem">
                                {{ $rel->categoria->emoji ?? '🎀' }}
                            </span>
                        </div>
                        <div class="rel-body">
                            <div class="rel-title">{{ $rel->nombre }}</div>
                            {{-- Badge de modalidad en relacionados --}}
                            <div class="rel-modalidad">
                                @if ($rel->modalidad === 'digital')
                                    <span class="rel-badge-digital">⚡ Digital</span>
                                @else
                                    <span class="rel-badge-fisico">📦 Físico</span>
                                @endif
                            </div>
                            <div class="rel-price">
                                @if ($rel->precio == 0)
                                    <span style="color:var(--teal)">Gratis</span>
                                @else
                                    €{{ number_format($rel->precio, 2) }}
                                    @if ($rel->tiene_descuento)
                                        <span class="rel-price-old">
                                            €{{ number_format($rel->precio_original, 2) }}
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <p>No hay productos relacionados.</p>
                @endforelse
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        function showTab(id, btn) {
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.getElementById('tab-' + id).classList.add('active');
            btn.classList.add('active');
        }

        function selectFormato(el) {
            document.querySelectorAll('.formato-chip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
        }

        function cambiarQty(delta) {
            const input = document.getElementById('qty');
            if (!input) return;
            const max = parseInt(input.max) || 99;
            input.value = Math.max(1, Math.min(max, parseInt(input.value) + delta));
        }

        function toggleWish() {
            const btn = document.getElementById('wishBtn');
            btn.textContent = btn.textContent === '🤍' ? '❤️' : '🤍';
        }

        function agregarCarrito(productId) {
            const btn = document.querySelector('.btn-comprar');
            const qtyInput = document.getElementById('qty');
            const cantidad = qtyInput ? parseInt(qtyInput.value) : 1;

            // Bloquea el botón mientras procesa
            btn.disabled = true;
            btn.textContent = '⏳ Agregando...';

            fetch('{{ route('carrito.agregar') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        cantidad: cantidad
                    })
                })
                .then(res => res.json())
                .then(data => {
                    btn.textContent = '✅ ¡Agregado!';
                    btn.style.background = 'var(--teal)';
                    btn.disabled = false;

                    // Actualiza badge del carrito en el header
                    const badge = document.querySelector('.cart-badge');
                    if (badge && data.cart_count !== undefined) {
                        badge.textContent = data.cart_count;
                    }

                    setTimeout(() => {
                        btn.textContent = '🛒 Agregar al carrito';
                        btn.style.background = '';
                    }, 2000);
                })
                .catch(() => {
                    btn.textContent = '❌ Error, intenta de nuevo';
                    btn.disabled = false;
                    setTimeout(() => {
                        btn.textContent = '🛒 Agregar al carrito';
                    }, 2000);
                });
        }

        function cambiarImagen(thumb, url) {
            document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
            const imgMain = document.getElementById('img-main');
            if (imgMain && url) imgMain.src = url;
        }
    </script>
@endpush
