@extends('layouts.app')

@section('title', 'Mi Carrito – Gomita')

@section('content')

    {{-- PAGE HERO --}}
    <div class="page-hero">
        <div class="page-hero-inner">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Inicio</a>
                <span>›</span>
                <span>Mi carrito</span>
            </div>
            <div
                style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-top:8px;">
                <h1>Mi carrito 🛒
                    {{-- $items viene del controlador — contamos los elementos reales --}}
                    <span>({{ $items->count() }} producto{{ $items->count() !== 1 ? 's' : '' }})</span>
                </h1>
                <div class="envio-gratis-pill">✅ ¡Descarga inmediata incluida!</div>
            </div>
        </div>
    </div>

    {{-- PROGRESO DE COMPRA --}}
    <div class="progreso-wrap">
        <div class="progreso-steps">
            <div class="step active">
                <div class="step-num">1</div>
                <span>Carrito</span>
            </div>
            <div class="step-line done"></div>
            <div class="step">
                <div class="step-num">2</div>
                <span>Datos</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-num">3</div>
                <span>Pago</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-num">4</div>
                <span>¡Listo!</span>
            </div>
        </div>
    </div>

    {{--
        CARRITO VACÍO
        Solo se muestra cuando no hay items
        $items viene del CartController@index
    --}}
    @if ($items->isEmpty())
        <div class="carrito-vacio" style="text-align:center; padding:60px 24px;">
            <div style="font-size:72px; margin-bottom:16px">🛒</div>
            <h2 style="font-size:22px; font-weight:900; margin-bottom:8px">Tu carrito está vacío</h2>
            <p style="color:var(--text-soft); font-weight:600; margin-bottom:24px">
                ¡Hay miles de plantillas kawaii esperándote!
            </p>
            <a href="{{ route('categorias.index') }}" class="btn-auth"
                style="display:inline-flex; align-items:center; gap:8px; text-decoration:none;">
                ✨ Ver plantillas
            </a>
        </div>
    @else
        {{-- LAYOUT PRINCIPAL: items a la izquierda, resumen a la derecha --}}
        <div class="carrito-layout" id="carrito-layout">

            {{-- COLUMNA IZQUIERDA: lista de productos --}}
            <div>
                <div class="carrito-lista">
                    <div class="carrito-header">
                        <h2>Productos en tu carrito</h2>
                        {{--
                            Vaciar carrito — llama al método eliminar
                            para cada producto. Por ahora recarga la página.
                            Mejorable con JS después.
                        --}}
                        <button class="btn-vaciar" onclick="confirmarVaciar()">
                            🗑️ Vaciar carrito
                        </button>
                    </div>

                    {{--
                        $items es una colección que arma el CartController
                        Cada item tiene: ['producto' => Product, 'cantidad' => int, 'subtotal' => float]
                    --}}
                    @foreach ($items as $item)
                        <div class="item-card" id="item-{{ $item['producto']->id }}">

                            {{-- Imagen del producto --}}
                            <div class="item-img">
                                <img src="{{ $item['producto']->thumb_url }}" alt="{{ $item['producto']->nombre }}"
                                    onerror="this.style.display='none';
                                              this.parentElement.innerHTML='{{ $item['producto']->categoria->emoji ?? '🎀' }}'">
                            </div>

                            {{-- Información del producto --}}
                            <div class="item-info">
                                <span class="item-badge">
                                    {{ $item['producto']->categoria->emoji }}
                                    {{ $item['producto']->categoria->nombre }}
                                </span>
                                <div class="item-name">{{ $item['producto']->nombre }}</div>
                                <div class="item-variant">
                                    📄 {{ $item['producto']->tipo_archivo }} · Descarga inmediata
                                </div>

                                <div class="item-actions">
                                    {{--
                                        Control de cantidad
                                        data-id guarda el ID del producto para que el JS lo use
                                        Los botones llaman a cambiarCantidad() que hace fetch al servidor
                                    --}}
                                    <div class="qty-ctrl">
                                        <button class="qty-btn"
                                            onclick="cambiarCantidad({{ $item['producto']->id }}, -1, this)">
                                            −
                                        </button>
                                        <span class="qty-val" id="qty-{{ $item['producto']->id }}">
                                            {{ $item['cantidad'] }}
                                        </span>
                                        <button class="qty-btn"
                                            onclick="cambiarCantidad({{ $item['producto']->id }}, 1, this)">
                                            +
                                        </button>
                                    </div>

                                    {{-- Botón eliminar item --}}
                                    <button class="btn-remove" onclick="eliminarItem({{ $item['producto']->id }})"
                                        title="Eliminar">
                                        🗑️
                                    </button>
                                </div>
                            </div>

                            {{-- Precio del item --}}
                            <div class="item-price-wrap">
                                <span class="item-price" id="precio-{{ $item['producto']->id }}">
                                    ${{ number_format($item['subtotal'], 2) }}
                                </span>
                                @if ($item['producto']->tiene_descuento)
                                    <span class="item-price-old">
                                        ${{ number_format($item['producto']->precio_original * $item['cantidad'], 2) }}
                                    </span>
                                    <span class="item-descuento">
                                        -{{ $item['producto']->porcentaje_descuento }}%
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- SECCIÓN DE CUPÓN --}}
                <div class="cupon-wrap" style="margin-top:16px">
                    <h4>🏷️ ¿Tienes un cupón de descuento?</h4>
                    <div class="cupon-row">
                        {{--
                            Si ya hay un cupón activo en sesión lo mostramos
                            $cupon viene del CartController@index
                        --}}
                        @if ($cupon)
                            <input type="text" class="cupon-input" value="{{ $cupon['codigo'] }}" readonly
                                style="border-color:var(--teal)">
                            <button class="btn-aplicar" style="background:var(--teal)" onclick="quitarCupon()">
                                ✕ Quitar
                            </button>
                        @else
                            <input type="text" class="cupon-input" id="cupon-input" placeholder="Ingresa tu código"
                                style="text-transform:uppercase">
                            <button class="btn-aplicar" onclick="aplicarCupon()">
                                Aplicar
                            </button>
                        @endif
                    </div>

                    {{-- Mensaje de éxito del cupón --}}
                    @if ($cupon)
                        <div class="cupon-ok visible">
                            ✅ Cupón <strong>{{ $cupon['codigo'] }}</strong>
                            aplicado — {{ $cupon['label'] }}
                        </div>
                    @endif

                    {{-- Mensaje de error del cupón (viene de la sesión) --}}
                    @if (session('cupon_error'))
                        <div style="color:#FF5252; font-size:12px; font-weight:700; margin-top:6px">
                            ❌ {{ session('cupon_error') }}
                        </div>
                    @endif
                </div>

                <a href="{{ route('categorias.index') }}" class="seguir-link" style="margin-top:16px; display:inline-flex">
                    ← Seguir comprando
                </a>
            </div>

            {{-- COLUMNA DERECHA: resumen del pedido --}}
            <div class="resumen-card">
                <h3>📋 Resumen del pedido</h3>

                <div class="resumen-row">
                    <span class="label">
                        Subtotal ({{ $items->count() }} producto{{ $items->count() !== 1 ? 's' : '' }})
                    </span>
                    {{-- $subtotal viene del controlador --}}
                    <span class="value" id="resumen-subtotal">
                        ${{ number_format($subtotal, 2) }}
                    </span>
                </div>

                {{-- Fila de descuento solo si hay cupón activo --}}
                @if ($cupon && $descuento > 0)
                    <div class="resumen-row">
                        <span class="label">
                            Cupón ({{ $cupon['codigo'] }})
                        </span>
                        <span class="value descuento">
                            -${{ number_format($descuento, 2) }}
                        </span>
                    </div>
                @endif

                <div class="resumen-row">
                    <span class="label">Envío digital</span>
                    <span class="value gratis">✅ Gratis</span>
                </div>

                <div class="resumen-total">
                    <span class="label">Total</span>
                    {{-- $total viene del controlador ya con descuento aplicado --}}
                    <span class="value" id="resumen-total">
                        ${{ number_format($total, 2) }}
                    </span>
                </div>

                {{--
                    Botón de checkout
                    Solo redirige si el usuario está logueado
                    @auth y @guest son directivas de Laravel para verificar sesión
                --}}
                @auth
                    <a href="{{ route('checkout.index') }}" class="btn-checkout"
                        style="display:flex; align-items:center; justify-content:center; gap:8px; text-decoration:none;">
                        🔒 Finalizar compra
                    </a>
                @else
                    {{--
                        Si no está logueado lo mandamos al login
                        El parámetro ?redirect=checkout guarda a dónde volver
                        después del login (lo implementamos después)
                    --}}
                    <a href="{{ route('login') }}?redirect=checkout" class="btn-checkout"
                        style="display:flex; align-items:center; justify-content:center; gap:8px; text-decoration:none;">
                        🔒 Iniciar sesión para comprar
                    </a>
                    <p style="text-align:center; font-size:12px; color:var(--text-soft); margin-top:8px; font-weight:600">
                        ¿No tienes cuenta?
                        <a href="{{ route('register') }}" style="color:var(--pink)">Regístrate gratis</a>
                    </p>
                @endauth

                <div class="pagos-info">Métodos de pago aceptados</div>
                <div class="pagos-icons">
                    <span class="pago-icon">💳 Tarjeta</span>
                    <span class="pago-icon">🏦 PSE</span>
                    <span class="pago-icon">💵 Efecty</span>
                    <span class="pago-icon">📱 Nequi</span>
                </div>

                <div class="garantia-mini">
                    <span class="g-icon">🔒</span>
                    <p>Compra 100% segura
                        <span>Reembolso garantizado en 7 días.</span>
                    </p>
                </div>
            </div>

        </div>
    @endif

@endsection

@push('scripts')
    <script>
        // ═══════════════════════════════════════════════
        // CAMBIAR CANTIDAD
        // Envía una petición PATCH al servidor con la nueva cantidad
        // PATCH significa "actualización parcial de un recurso"
        // ═══════════════════════════════════════════════
        function cambiarCantidad(productId, delta, btn) {

            // Leemos la cantidad actual del DOM
            const spanCantidad = document.getElementById('qty-' + productId);
            const cantidadActual = parseInt(spanCantidad.textContent);
            const nuevaCantidad = Math.max(1, cantidadActual + delta);

            // Si no cambia, no hacemos nada
            if (nuevaCantidad === cantidadActual) return;

            // Deshabilitamos los botones mientras espera la respuesta
            btn.disabled = true;

            fetch(`/carrito/actualizar/${productId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        cantidad: nuevaCantidad
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.ok) {
                        // Actualizamos la cantidad en el DOM sin recargar
                        spanCantidad.textContent = nuevaCantidad;

                        // Recargamos el resumen para actualizar precios
                        // Por ahora recargamos la página — después lo hacemos con JS
                        location.reload();
                    }
                })
                .catch(err => console.error('Error:', err))
                .finally(() => btn.disabled = false);
        }

        // ═══════════════════════════════════════════════
        // ELIMINAR ITEM
        // Envía DELETE al servidor y anima la salida del elemento
        // ═══════════════════════════════════════════════
        function eliminarItem(productId) {
            const card = document.getElementById('item-' + productId);

            // Animación de salida
            card.style.transition = 'opacity .3s, transform .3s';
            card.style.opacity = '0';
            card.style.transform = 'translateX(20px)';

            fetch(`/carrito/eliminar/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.ok) {
                        setTimeout(() => {
                            card.remove();

                            // Si no quedan items, recargamos para mostrar carrito vacío
                            const itemsRestantes = document.querySelectorAll('.item-card');
                            if (itemsRestantes.length === 0) {
                                location.reload();
                            }
                        }, 300);
                    }
                })
                .catch(err => console.error('Error:', err));
        }

        // ═══════════════════════════════════════════════
        // VACIAR CARRITO
        // Elimina todos los items uno por uno
        // ═══════════════════════════════════════════════
        function confirmarVaciar() {
            if (!confirm('¿Estás segura de vaciar el carrito?')) return;

            document.querySelectorAll('.item-card').forEach(card => {
                // Extraemos el ID del elemento id="item-5" → 5
                const productId = card.id.replace('item-', '');
                eliminarItem(productId);
            });

            // Recargamos después de las animaciones
            setTimeout(() => location.reload(), 600);
        }

        // ═══════════════════════════════════════════════
        // APLICAR CUPÓN
        // Envía el código al servidor que lo valida contra la BD
        // ═══════════════════════════════════════════════
        function aplicarCupon() {
            const input = document.getElementById('cupon-input');
            const codigo = input.value.trim().toUpperCase();

            if (!codigo) {
                input.style.borderColor = '#FF5252';
                return;
            }

            fetch('{{ route('carrito.cupon') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        codigo: codigo
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.ok) {
                        // Cupón válido — recargamos para mostrar el descuento
                        location.reload();
                    } else {
                        // Cupón inválido — mostramos el error
                        input.style.borderColor = '#FF5252';
                        input.value = '';
                        input.placeholder = data.mensaje || 'Código inválido';
                    }
                })
                .catch(err => console.error('Error:', err));
        }

        // ═══════════════════════════════════════════════
        // QUITAR CUPÓN
        // Limpia el cupón de la sesión recargando sin el parámetro
        // ═══════════════════════════════════════════════
        function quitarCupon() {
            fetch('{{ route('carrito.cupon') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        codigo: ''
                    })
                })
                .then(() => location.reload());
        }

        // Toggle wishlist en items
        document.querySelectorAll('.btn-wish-item').forEach(btn => {
            btn.addEventListener('click', () => {
                btn.textContent = btn.textContent === '🤍' ? '❤️' : '🤍';
            });
        });
    </script>
@endpush
