{{--
    Usamos nuestro propio layout en vez de x-guest-layout
    porque tenemos un diseño personalizado de dos paneles
--}}
@extends('layouts.auth')
{{--
    Nota: necesitas crear layouts/auth.blade.php
    Es como layouts/app.blade.php pero sin header ni footer completo
    Solo tiene el <html>, <head> con el CSS, y @yield('content')
--}}

@section('title', 'Iniciar sesión – Gomita')

@section('content')
    <div class="auth-page">

        {{-- PANEL IZQUIERDO — solo visual, sin lógica --}}
        <div class="auth-visual">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
            <div class="visual-content">
                <span class="visual-mascot">🐻</span>
                <h2>Tu mundo de <span>plantillas</span> te espera</h2>
                <p>Inicia sesión y accede a todos tus diseños kawaii.</p>
                <div class="visual-benefits">
                    <div class="benefit-item">
                        <span class="b-icon">📥</span>
                        <p>Tus compras guardadas
                            <span>Accede a tus descargas cuando quieras</span>
                        </p>
                    </div>
                    <div class="benefit-item">
                        <span class="b-icon">❤️</span>
                        <p>Lista de favoritos
                            <span>Guarda los diseños que más te gustan</span>
                        </p>
                    </div>
                    <div class="benefit-item">
                        <span class="b-icon">🔔</span>
                        <p>Ofertas exclusivas
                            <span>Recibe descuentos antes que nadie</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- PANEL DERECHO — aquí vive el formulario real de Breeze --}}
        <div class="auth-form-wrap">
            <div class="auth-form-inner">

                {{-- Tabs de navegación entre login y registro --}}
                <div class="auth-tabs">
                    <a href="{{ route('login') }}" class="auth-tab active">
                        Iniciar sesión
                    </a>
                    <a href="{{ route('register') }}" class="auth-tab">
                        Crear cuenta
                    </a>
                </div>

                {{--
                Mensaje de sesión — Breeze lo usa para mostrar
                "Te enviamos el email de recuperación" etc.
            --}}
                @if (session('status'))
                    <div class="auth-status">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="auth-title">¡Bienvenida de vuelta! 👋</div>
                <div class="auth-sub">
                    ¿No tienes cuenta?
                    <a href="{{ route('register') }}">Registrate gratis</a>
                </div>

                {{--
                FORMULARIO REAL DE BREEZE
                method="POST" envía los datos al servidor
                action="{{ route('login') }}" le dice a Laravel
                qué controlador procesa el formulario
                @csrf es el token de seguridad obligatorio
            --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Campo email --}}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrap">
                            <input type="email" id="email" name="email"
                                class="form-input {{ $errors->has('email') ? 'error' : '' }}" placeholder="tu@email.com"
                                value="{{ old('email') }}" required autofocus>
                            {{--
                            old('email') recupera el valor que escribió
                            el usuario si el formulario falló — así no
                            tiene que escribirlo de nuevo
                        --}}
                        </div>
                        {{--
                        $errors es una variable que Laravel inyecta
                        automáticamente con los errores de validación
                        has('email') verifica si hay error en ese campo
                    --}}
                        @error('email')
                            <div class="field-error visible">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Campo contraseña --}}
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-wrap">
                            <input type="password" id="password" name="password"
                                class="form-input has-icon {{ $errors->has('password') ? 'error' : '' }}"
                                placeholder="Tu contraseña" required>
                            <span class="input-icon" onclick="togglePass('password', this)">👁️</span>
                        </div>
                        @error('password')
                            <div class="field-error visible">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Recordarme y olvidé mi contraseña --}}
                    <div class="login-extras">
                        <label class="remember-wrap">
                            <input type="checkbox" name="remember">
                            Recordarme
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    {{-- Botón submit — este SÍ envía el formulario al servidor --}}
                    <button type="submit" class="btn-auth">
                        🔓 Iniciar sesión
                    </button>

                </form>

                <div class="auth-switch">
                    ¿Primera vez aquí?
                    <a href="{{ route('register') }}">Crea tu cuenta gratis</a>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Solo toggle de contraseña — la validación la hace Laravel en el servidor
        function togglePass(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = '🙈';
            } else {
                input.type = 'password';
                icon.textContent = '👁️';
            }
        }
    </script>
@endpush
