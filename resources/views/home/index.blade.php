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
    <!-- ═══ PLANTILLAS NUEVAS ═══ -->
    <section id="novedades">
        <div class="section-header">
            <h2>✨ Plantillas Nuevas</h2>
            <a href="categorias.html">Ver todas →</a>
        </div>
        <div class="slider-outer">
            <button class="slider-arrow left" onclick="slide('slider-nuevas', -230)" aria-label="Anterior">&#10094;</button>
            <div class="slider-track" id="slider-nuevas">

                <div class="product-card">
                    <a href="producto.html">
                        <div class="img-wrap">
                            <img src="Imagenes/Productos/no-results.png" alt="Kit Cumpleaños Unicornio"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                            <div class="img-placeholder" style="display:none">🦄</div>
                            <div class="product-badge">NUEVO</div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">Kit Cumpleaños Unicornio</div>
                            <div class="card-sub">Invitación + Etiquetas + Banderín</div>
                            <div class="card-footer">
                                <div>
                                    <span class="card-price">$4.99</span>
                                </div>
                                <div>
                                    <div class="card-stars"><span>★★★★★</span> (124)</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="product-card">
                    <a href="producto.html">
                        <div class="img-wrap">
                            <img src="Imagenes/Productos/no-results.png" alt="Baby Shower Safari"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                            <div class="img-placeholder" style="display:none">🦁</div>
                            <div class="product-badge badge-popular">POPULAR</div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">Baby Shower Safari</div>
                            <div class="card-sub">Kit completo imprimible</div>
                            <div class="card-footer">
                                <div><span class="card-price">$6.99</span></div>
                                <div>
                                    <div class="card-stars"><span>★★★★★</span> (89)</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="product-card">
                    <a href="producto.html">
                        <div class="img-wrap">
                            <img src="Imagenes/Productos/no-results.png" alt="Stickers Kawaii"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                            <div class="img-placeholder" style="display:none">✨</div>
                            <div class="product-badge badge-sale">-50%</div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">Pack 50 Stickers Kawaii</div>
                            <div class="card-sub">Descarga inmediata</div>
                            <div class="card-footer">
                                <div>
                                    <span class="card-price">$2.49</span>
                                    <span class="card-price-old">$4.99</span>
                                </div>
                                <div>
                                    <div class="card-stars"><span>★★★★★</span> (203)</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="product-card">
                    <a href="producto.html">
                        <div class="img-wrap">
                            <img src="Imagenes/Productos/no-results.png" alt="Invitación Editable"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                            <div class="img-placeholder" style="display:none">🎨</div>
                            <div class="product-badge badge-editable">EDITABLE</div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">Invitación Editable Canva</div>
                            <div class="card-sub">Personaliza en Canva</div>
                            <div class="card-footer">
                                <div><span class="card-price">$3.99</span></div>
                                <div>
                                    <div class="card-stars"><span>★★★★★</span> (156)</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="product-card">
                    <a href="producto.html">
                        <div class="img-wrap">
                            <img src="Imagenes/Productos/no-results.png" alt="Etiquetas Escolares"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                            <div class="img-placeholder" style="display:none">🏷️</div>
                            <div class="product-badge badge-free">GRATIS</div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">Etiquetas Escolares</div>
                            <div class="card-sub">Descarga gratuita</div>
                            <div class="card-footer">
                                <div><span class="card-price" style="color: #06D6A0;">Gratis</span></div>
                                <div>
                                    <div class="card-stars"><span>★★★★★</span> (412)</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <button class="slider-arrow right" onclick="slide('slider-nuevas', 230)"
                aria-label="Siguiente">&#10095;</button>
        </div>
    </section>

    <!-- ═══ MÁS DESCARGADAS ═══ -->
    <section id="ofertas">
        <div class="section-header">
            <h2>🔥 Más Descargadas</h2>
            <a href="categorias.html">Ver ranking →</a>
        </div>
        <div class="slider-outer">
            <button class="slider-arrow left" onclick="slide('slider-populares', -230)"
                aria-label="Anterior">&#10094;</button>
            <div class="slider-track" id="slider-populares">

                <div class="product-card">
                    <a href="producto.html">
                        <div class="img-wrap">
                            <img src="Imagenes/Productos/no-results.png" alt="Kit Fiesta Unicornio"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                            <div class="img-placeholder" style="display:none">🦄</div>
                            <div class="product-badge badge-top1">🥇 TOP 1</div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">Kit Fiesta Unicornio Completo</div>
                            <div class="card-sub">+50 elementos incluidos</div>
                            <div class="card-footer">
                                <div><span class="card-price">$12.99</span></div>
                                <div>
                                    <div class="card-stars"><span>★★★★★</span> (534)</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="product-card">
                    <a href="producto.html">
                        <div class="img-wrap">
                            <img src="Imagenes/Productos/no-results.png" alt="Planificador Mensual"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                            <div class="img-placeholder" style="display:none">📅</div>
                            <div class="product-badge badge-top2">🥈 TOP 2</div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">Planificador Mensual 2025</div>
                            <div class="card-sub">12 meses + extras</div>
                            <div class="card-footer">
                                <div><span class="card-price">$5.99</span></div>
                                <div>
                                    <div class="card-stars"><span>★★★★★</span> (421)</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="product-card">
                    <a href="producto.html">
                        <div class="img-wrap">
                            <img src="Imagenes/Productos/no-results.png" alt="Toppers para Tortas"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                            <div class="img-placeholder" style="display:none">🎂</div>
                            <div class="product-badge badge-top3">🥉 TOP 3</div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">Toppers para Tortas</div>
                            <div class="card-sub">20 diseños variados</div>
                            <div class="card-footer">
                                <div><span class="card-price">$3.99</span></div>
                                <div>
                                    <div class="card-stars"><span>★★★★★</span> (389)</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <button class="slider-arrow right" onclick="slide('slider-populares', 230)"
                aria-label="Siguiente">&#10095;</button>
        </div>
    </section>

    <!-- ═══ CATEGORÍAS DESTACADAS ═══ -->
    <section class="categorias-section">
        <div class="section-header">
            <h2>🗂️ Categorías Populares</h2>
            <a href="categorias.html">Ver todas →</a>
        </div>
        <div class="categorias-grid">
            <a href="#" class="categoria-card">
                <span class="cat-icon">🎂</span>
                <div class="cat-name">Cumpleaños</div>
                <div class="cat-count">348 plantillas</div>
            </a>
            <a href="#" class="categoria-card">
                <span class="cat-icon">✨</span>
                <div class="cat-name">Stickers</div>
                <div class="cat-count">210 diseños</div>
            </a>
            <a href="#" class="categoria-card">
                <span class="cat-icon">💌</span>
                <div class="cat-name">Invitaciones</div>
                <div class="cat-count">185 plantillas</div>
            </a>
            <a href="#" class="categoria-card">
                <span class="cat-icon">🎁</span>
                <div class="cat-name">Regalos personalizados</div>
                <div class="cat-count">120 kits</div>
            </a>
        </div>
    </section>

    <!-- ═══ TRUST BAR ═══ -->
    <div class="trust-bar">
        <div class="trust-inner">
            <div class="trust-item">
                <div class="t-icon">📥</div>
                <strong>Descarga inmediata</strong>
                <span>Al instante de comprar</span>
            </div>
            <div class="trust-item">
                <div class="t-icon">🖨️</div>
                <strong>Imprime en casa</strong>
                <span>Formato A4 y carta</span>
            </div>
            <div class="trust-item">
                <div class="t-icon">✏️</div>
                <strong>100% Editable</strong>
                <span>Canva, Word, PDF</span>
            </div>
            <div class="trust-item">
                <div class="t-icon">💬</div>
                <strong>Soporte incluido</strong>
                <span>Te ayudamos siempre</span>
            </div>
        </div>
    </div>
    <script>
        function slide(id, amount) {
            document.getElementById(id).scrollBy({
                left: amount,
                behavior: 'smooth'
            });
        }
    </script>
@endsection
