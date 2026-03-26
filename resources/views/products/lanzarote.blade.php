{{-- resources/views/products/lanzarote.blade.php --}}
@extends('layouts.app')

@section('title', 'Decoración de Fiestas en Lanzarote — Entrega a domicilio')

@section('meta')
    <meta name="description"
        content="Piñatas, cajas y decoración para fiestas con entrega en Lanzarote. Personalización incluida.">
    <meta name="geo.region" content="ES-CN">
    <meta name="geo.placename" content="Lanzarote, Canarias, España">
@endsection

@section('content')

    {{--
        PAGE HERO
        Esta sección muestra el título de la página y el breadcrumb.
        El breadcrumb le dice al usuario dónde está dentro del sitio.
        $productos->total() viene del controlador — cuenta todos los registros
        que coinciden con los filtros, sin importar la paginación.
    --}}
    <div class="page-hero">
        <div class="page-hero-inner">
            <div class="breadcrumn">
                <a href="{{ route('home') }}">Inicio</a> <span>›</span>
                <span>Productos</span>
                @if (request('q'))
                    › <span>Búsqueda: "{{ request('q') }}"</span>
                @endif
                <h1>
                    {{-- Si viene de una búsqueda mostramos el término --}}
                    @if (request('q'))
                        Resultados para <span>"{{ request('q') }}"</span> 🔍

                        {{-- Si viene filtrado por categoría --}}
                    @elseif(request('categoria'))
                        Plantillas de
                        <span>{{ is_array(request('categoria')) ? implode(', ', request('categoria')) : request('categoria') }}</span>
                        🎨

                        {{-- Si no hay filtro, título genérico --}}
                    @else
                        Todas nuestras <span>Plantillas</span> 🎨
                    @endif

                    @if (request('q'))
                        <div class="busqueda-activa">
                            Mostrando resultados para
                            <strong>"{{ request('q') }}"</strong>
                            · <a href="{{ route('productos.index') }}">Limpiar</a>
                        </div>
                    @endif
                </h1>
            </div>
        </div>
    </div>

    {{--
        LAYOUT PRINCIPAL
        Usamos CSS Grid con dos columnas:
        - columna izquierda: sidebar de filtros (240px)
        - columna derecha: área de productos (el resto del espacio)
    --}}
    <div class="page-layout">

        {{--
            SIDEBAR DE FILTROS
            Cada filtro usa name="precio[]" o name="tipo[]" con corchetes [].
            Los corchetes le dicen a PHP que es un array — el usuario puede
            marcar varios checkboxes al mismo tiempo.

            request('precio', []) recupera los valores actuales de la URL
            para mantener los checkboxes marcados después de filtrar.
            El [] del final es el valor por defecto si no hay nada en la URL.
        --}}
        <aside class="filtros-sidebar">
            <h3>🎯 Filtrar por</h3>

            <form method="GET" action="{{ route('productos.index') }}">

                {{-- Filtro por precio --}}
                <div class="filtro-grupo">
                    <div class="filtro-grupo">
                        <h4>🗂️ Categoría</h4>
                        @foreach ($categorias as $cat)
                            <label>
                                <input type="radio" name="categoria" value="{{ $cat->slug }}"
                                    {{ request('categoria') == $cat->slug ? 'checked' : '' }}>
                                {{ $cat->emoji }} {{ $cat->nombre }}
                            </label>
                        @endforeach
                    </div>
                    <h4>💰 Precio</h4>
                    <label>
                        <input type="checkbox" name="precio[]" value="gratis"
                            {{ in_array('gratis', request('precio', [])) ? 'checked' : '' }}>
                        Gratis
                    </label>
                    <label>
                        <input type="checkbox" name="precio[]" value="menos5"
                            {{ in_array('menos5', request('precio', [])) ? 'checked' : '' }}>
                        Menos de $5
                    </label>
                    <label>
                        <input type="checkbox" name="precio[]" value="5a10"
                            {{ in_array('5a10', request('precio', [])) ? 'checked' : '' }}>
                        $5 – $10
                    </label>
                    <label>
                        <input type="checkbox" name="precio[]" value="mas10"
                            {{ in_array('mas10', request('precio', [])) ? 'checked' : '' }}>
                        Más de $10
                    </label>
                </div>

                {{-- Filtro por tipo de archivo --}}
                <div class="filtro-grupo">
                    <h4>📄 Tipo de archivo</h4>
                    <label>
                        <input type="checkbox" name="formato[]" value="pdf"
                            {{ in_array('pdf', request('formato', [])) ? 'checked' : '' }}>
                        PDF imprimible
                    </label>
                    <label>
                        <input type="checkbox" name="formato[]" value="canva"
                            {{ in_array('canva', request('formato', [])) ? 'checked' : '' }}>
                        Editable Canva
                    </label>
                    <label>
                        <input type="checkbox" name="formato[]" value="pptx"
                            {{ in_array('pptx', request('formato', [])) ? 'checked' : '' }}>
                        PowerPoint
                    </label>
                    <label>
                        <input type="checkbox" name="formato[]" value="kit"
                            {{ in_array('kit', request('formato', [])) ? 'checked' : '' }}>
                        Kit completo
                    </label>
                </div>

                {{-- En filtros-sidebar, añade este grupo --}}
                <div class="filtro-grupo">
                    <h4>🚀 Modalidad</h4>
                    <label>
                        <input type="radio" name="modalidad" value="" {{ !request('modalidad') ? 'checked' : '' }}>
                        Todos
                    </label>
                    <label>
                        <input type="radio" name="modalidad" value="digital"
                            {{ request('modalidad') === 'digital' ? 'checked' : '' }}>
                        ⚡ Descarga digital
                    </label>
                    <label>
                        <input type="radio" name="modalidad" value="fisico"
                            {{ request('modalidad') === 'fisico' ? 'checked' : '' }}>
                        📦 Físico (Lanzarote)
                    </label>
                </div>

                {{--
                    Si hay un filtro de búsqueda activo (q=...) lo preservamos
                    como campo oculto para que no se pierda al filtrar.
                    Un input hidden envía datos sin mostrarse al usuario.
                --}}
                @if (request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif

                {{--
                    Botón de aplicar — estilos inline para que no dependan
                    de clases que puedan estar faltando en el CSS.
                --}}
                <button type="submit"
                    style="
                        width: 100%;
                        padding: 10px;
                        background: #FF6B9D;
                        color: white;
                        border: none;
                        border-radius: 50px;
                        font-family: 'Nunito', sans-serif;
                        font-size: 13px;
                        font-weight: 800;
                        cursor: pointer;
                        margin-top: 8px;
                        margin-bottom: 8px;
                        transition: background .2s;
                    "
                    onmouseover="this.style.background='#e5558a'" onmouseout="this.style.background='#FF6B9D'">
                    🔍 Aplicar filtros
                </button>

                {{--
                    Limpiar filtros — enlace simple que va a la URL sin parámetros.
                    Esto resetea todos los filtros de una sola vez.
                --}}
                <a href="{{ route('productos.index') }}"
                    style="
                        display: block;
                        text-align: center;
                        font-size: 12px;
                        font-weight: 700;
                        color: #9B7B87;
                        text-decoration: none;
                        margin-top: 4px;
                    ">
                    ✕ Limpiar filtros
                </a>

            </form>
        </aside>

        {{-- ÁREA DE PRODUCTOS --}}
        <div class="productos-area">

            {{--
                TOOLBAR
                Muestra cuántos productos hay y el selector de orden.
                ?? 0 es el operador "null coalescing" — si firstItem() devuelve
                null (cuando no hay resultados), muestra 0 en vez de nada.
            --}}
            <div class="productos-toolbar">
                <p class="productos-count">
                    Mostrando
                    <strong>{{ $productos->firstItem() ?? 0 }}–{{ $productos->lastItem() ?? 0 }}</strong>
                    de
                    <strong>{{ $productos->total() }}</strong>
                    productos
                </p>

                {{--
                    SELECT DE ORDEN
                    Cada option compara request('orden') con su propio value.
                    Si coinciden, agrega selected para que se vea seleccionado
                    cuando el usuario vuelve a la página con ese filtro activo.
                --}}
                <div class="toolbar-right">
                    <select class="select-ordenar" aria-label="Ordenar por" id="select-orden">
                        <option value="relevantes" {{ request('orden', 'relevantes') == 'relevantes' ? 'selected' : '' }}>
                            Más relevantes
                        </option>
                        <option value="novedades" {{ request('orden') == 'novedades' ? 'selected' : '' }}>
                            Más recientes
                        </option>
                        <option value="precio_asc" {{ request('orden') == 'precio_asc' ? 'selected' : '' }}>
                            Precio: menor a mayor
                        </option>
                        <option value="precio_desc" {{ request('orden') == 'precio_desc' ? 'selected' : '' }}>
                            Precio: mayor a menor
                        </option>
                        <option value="mas_vendidos" {{ request('orden') == 'mas_vendidos' ? 'selected' : '' }}>
                            Más populares
                        </option>
                    </select>
                </div>
            </div>

            {{--
                GRID DE PRODUCTOS
                @if isEmpty() muestra el mensaje de sin resultados.
                @else muestra las tarjetas.
                @forelse es como @foreach pero con @empty para cuando no hay items.
            --}}
            @if ($productos->isEmpty())
                <div class="no-results" style="text-align:center; padding:60px 24px; color:#9B7B87">
                    <p style="font-size:18px; margin-bottom:12px">😕 No se encontraron productos con esos filtros.</p>
                    <a href="{{ route('productos.index') }}" style="color:#FF6B9D; font-weight:700">
                        ✕ Limpiar filtros
                    </a>
                </div>
            @else
                <div class="productos-grid" id="productos-grid">

                    {{--
                        TARJETA DE PRODUCTO
                        Estructura correcta:
                        - el <a> envuelve imagen y texto (navega al producto)
                        - el botón carrito va FUERA del <a> (evita conflicto de clicks)
                        - data-id guarda el ID para que el JS lo lea después
                    --}}
                    @foreach ($productos as $producto)
                        <div class="product-card">

                            {{-- Enlace que lleva al detalle del producto --}}
                            <a href="{{ route('productos.show', $producto->slug) }}">

                                {{-- Imagen con fallback emoji si no carga --}}
                                <div class="product-img-wrap">
                                    <img src="{{ $producto->thumb_url }}" alt="{{ $producto->nombre }}"
                                        onerror="this.style.display='none';
                                                  this.nextElementSibling.style.display='block'">
                                    <div class="img-emoji" style="display:none">🎨</div>

                                    {{--
                                        Badge del producto (NUEVO, POPULAR, etc.)
                                        match() en PHP es como un switch — compara $producto->badge
                                        con cada caso y devuelve la clase CSS correspondiente.
                                    --}}
                                    @if ($producto->badge_label)
                                        <span
                                            class="product-badge {{ match ($producto->badge) {
                                                'oferta' => 'badge-sale',
                                                'popular' => 'badge-popular',
                                                'gratis' => 'badge-free',
                                                'editable' => 'badge-editable',
                                                default => '',
                                            } }}">
                                            {{ $producto->badge_label }}
                                        </span>
                                    @endif
                                    {{-- Badge de modalidad --}}
                                    @if ($producto->modalidad === 'digital')
                                        <span class="badge-modalidad badge-digital">⚡ Descarga inmediata</span>
                                    @elseif($producto->modalidad === 'fisico')
                                        <span class="badge-modalidad badge-fisico">📦 Envío Lanzarote</span>
                                    @else
                                        <span class="badge-modalidad badge-ambos">⚡📦 Digital + Físico</span>
                                    @endif

                                    {{-- Botón wishlist — solo visual por ahora --}}
                                    <button class="btn-wish" title="Guardar" onclick="event.preventDefault()">🤍</button>
                                </div>

                                {{-- Información textual del producto --}}
                                <div class="product-body">
                                    <div class="product-title">{{ $producto->nombre }}</div>

                                    {{--
                                        Str::limit() corta el texto a N caracteres
                                        y agrega "..." al final automáticamente.
                                        Es un helper de Laravel para textos largos.
                                    --}}
                                    <div class="product-desc">
                                        {{ Str::limit($producto->descripcion, 80) }}
                                    </div>

                                    {{--
                                        Estrellas de rating
                                        round() redondea el promedio al entero más cercano.
                                        El @for genera 5 iteraciones: si $i <= rating muestra ⭐, sino ☆
                                    --}}
                                    <div class="product-rating">
                                        <span class="stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                {{ $i <= round($producto->rating_promedio) ? '⭐' : '☆' }}
                                            @endfor
                                        </span>
                                        <span class="rating-num">({{ $producto->resenas_count }})</span>
                                    </div>

                                    {{--
                                        Tags del producto
                                        array_slice() toma solo los primeros 3 elementos del array
                                        para no sobrecargar la tarjeta visualmente.
                                    --}}
                                    @if ($producto->tags)
                                        <div class="product-tags">
                                            @foreach (array_slice($producto->tags, 0, 3) as $tag)
                                                <span class="tag">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                            </a>
                            {{-- ↑ El <a> cierra AQUÍ — antes del footer con precio y botón --}}

                            {{--
                                FOOTER DE LA CARD — FUERA del enlace
                                El botón va fuera del <a> para que el click
                                no navegue al producto sino que agregue al carrito.

                                data-id y data-nombre son atributos HTML personalizados.
                                El JavaScript los leerá con: boton.dataset.id
                                Es la forma correcta de pasar datos de PHP a JS.
                            --}}
                            <div class="product-footer">
                                <div class="price-wrap">
                                    @if ($producto->precio == 0)
                                        <span class="price free">Gratis</span>
                                    @else
                                        <span class="price">
                                            ${{ number_format($producto->precio, 2) }}
                                        </span>
                                        @if ($producto->tiene_descuento)
                                            <span class="price-old">
                                                ${{ number_format($producto->precio_original, 2) }}
                                            </span>
                                        @endif
                                    @endif
                                </div>

                                <button class="btn-add-cart {{ $producto->precio == 0 ? 'free-btn' : '' }}"
                                    data-id="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}"
                                    data-precio="{{ $producto->precio }}">
                                    {{ $producto->precio == 0 ? '↓ Descargar' : '+ Carrito' }}
                                </button>
                            </div>

                        </div>
                        {{-- ↑ product-card cierra acá, una por cada $producto --}}
                    @endforeach
                </div>
                {{-- ↑ productos-grid cierra acá --}}

            @endif

            {{--
                PAGINACIÓN
                withQueryString() es CRÍTICO — hace que los links de paginación
                conserven todos los filtros activos en la URL.
                Sin esto, al ir a la página 2 se pierden todos los filtros.

                links('pagination.custom') usa la vista que creaste en
                resources/views/pagination/custom.blade.php
            --}}
            <div class="paginacion">
                {{ $productos->withQueryString()->links('pagination.custom') }}
            </div>

        </div>
        {{-- ↑ productos-area cierra acá --}}

    </div>
    {{-- ↑ page-layout cierra acá --}}

@endsection

{{--
    SCRIPTS
    @push('scripts') agrega este JS al @stack('scripts') del layout.
    Va al final del <body> para que el HTML ya esté cargado cuando el JS corre.
--}}
@push('scripts')
    <script>
        // ═══════════════════════════════════════════════════
        // SELECT DE ORDEN
        // Cuando el usuario cambia el orden, actualizamos la URL
        // conservando todos los filtros activos.
        //
        // URL API es una herramienta nativa del navegador que permite
        // manipular URLs de forma segura sin concatenar strings manualmente.
        // ═══════════════════════════════════════════════════
        document.getElementById('select-orden').addEventListener('change', function() {

            // Tomamos la URL actual completa (con todos sus parámetros)
            const url = new URL(window.location.href);

            // Solo reemplazamos el parámetro "orden" con el nuevo valor
            // Todos los demás parámetros (precio[], tipo[], q) se conservan
            url.searchParams.set('orden', this.value);

            // Navegamos a la nueva URL
            window.location.href = url.toString();
        });

        // ═══════════════════════════════════════════════════
        // BOTONES DE CARRITO
        // querySelectorAll devuelve TODOS los botones .btn-add-cart de la página.
        // forEach itera sobre cada uno y le agrega un listener de click.
        // ═══════════════════════════════════════════════════
        document.querySelectorAll('.btn-add-cart').forEach(function(boton) {

            boton.addEventListener('click', function() {

                // dataset lee los atributos data-* del elemento HTML
                // <button data-id="5"> → boton.dataset.id === "5"
                const productId = this.dataset.id;
                const botonActual = this;

                // fetch() hace una petición HTTP al servidor
                // sin recargar la página (llamado AJAX o fetch API)
                fetch('{{ route('carrito.agregar') }}', {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',

                            // CSRF Token: Laravel exige este token en todo POST
                            // para verificar que la petición viene de tu propio sitio
                            // y no de otro sitio malicioso (protección CSRF)
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },

                        // JSON.stringify convierte el objeto JS a texto JSON
                        // para enviarlo en el cuerpo de la petición
                        body: JSON.stringify({
                            product_id: productId,
                            cantidad: 1
                        })
                    })
                    .then(function(respuesta) {
                        // .json() convierte la respuesta del servidor a objeto JS
                        return respuesta.json();
                    })
                    .then(function(data) {

                        // Feedback visual — el botón cambia temporalmente
                        botonActual.textContent = '✅ Agregado';
                        botonActual.style.background = '#06D6A0';
                        botonActual.style.color = 'white';

                        // Actualizamos el badge del carrito en el header
                        // querySelector busca el PRIMER elemento que coincida
                        const badge = document.querySelector('.cart-badge');
                        if (badge && data.cart_count !== undefined) {
                            badge.textContent = data.cart_count;
                        }

                        // Después de 2 segundos volvemos al estado original
                        setTimeout(function() {
                            botonActual.textContent = '+ Carrito';
                            botonActual.style.background = '';
                            botonActual.style.color = '';
                        }, 2000);
                    })
                    .catch(function(error) {
                        // .catch() captura errores de red o del servidor
                        console.error('Error al agregar al carrito:', error);
                        botonActual.textContent = '❌ Intentá de nuevo';
                    });
            });
        });
    </script>
@endpush
