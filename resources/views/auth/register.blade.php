{{--
    Usamos el layout de autenticación — sin header completo ni footer del sitio
    Es el mismo que usa login.blade.php
--}}
@extends('layouts.auth')

@section('title', 'Crear cuenta – Gomita')

@section('content')
    <div class="auth-page">

        {{-- PANEL IZQUIERDO — visual, sin lógica --}}
        <div class="auth-visual">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
            <div class="visual-content">
                <span class="visual-mascot">🐻</span>
                <h2>Tu mundo de <span>plantillas</span> te espera</h2>
                <p>Crea tu cuenta y accede a miles de diseños kawaii para todas tus celebraciones.</p>
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
                    <div class="benefit-item">
                        <span class="b-icon">🎁</span>
                        <p>Plantillas gratis de bienvenida
                            <span>Al registrarte te regalamos acceso especial</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- PANEL DERECHO — formulario real de Breeze --}}
        <div class="auth-form-wrap">
            <div class="auth-form-inner">

                {{--
                Tabs de navegación
                En register.blade.php el tab "Crear cuenta" está activo
                En login.blade.php el tab "Iniciar sesión" está activo
                Son enlaces reales, no JavaScript
            --}}
                <div class="auth-tabs">
                    <a href="{{ route('login') }}" class="auth-tab">
                        Iniciar sesión
                    </a>
                    <a href="{{ route('register') }}" class="auth-tab active">
                        Crear cuenta
                    </a>
                </div>

                <div class="auth-title">¡Crea tu cuenta gratis! 🎉</div>
                <div class="auth-sub">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}">Inicia sesión</a>
                </div>

                {{--
                FORMULARIO REAL DE REGISTRO
                action="{{ route('register') }}" apunta al controlador
                de Breeze que procesa el registro en la base de datos
            --}}
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{--
                    Fila de dos columnas para nombre y apellido
                    El campo "name" es el que usa Breeze internamente
                    Usamos solo un campo de nombre para simplificar
                --}}
                    <div class="form-row-2">
                        <div class="form-group">
                            <label for="name">
                                Nombre <span style="color:var(--pink)">*</span>
                            </label>
                            <input type="text" id="name" name="name"
                                class="form-input {{ $errors->has('name') ? 'error' : '' }}" placeholder="Tu nombre"
                                value="{{ old('name') }}" required autofocus>
                            {{--
                            @error('name') es equivalente a @if ($errors->has('name'))
                            $message contiene el texto del error automáticamente
                        --}}
                            @error('name')
                                <div class="field-error visible">{{ $message }}</div>
                            @enderror
                        </div>

                        {{--
                        El apellido es opcional en Breeze por defecto
                        Si quieres guardarlo necesitarías modificar el
                        controlador de registro de Breeze
                        Por ahora lo dejamos como campo visual sin name
                    --}}
                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" class="form-input" placeholder="Tu apellido (opcional)">
                        </div>
                    </div>

                    {{-- Campo email --}}
                    <div class="form-group">
                        <label for="email">
                            Email <span style="color:var(--pink)">*</span>
                        </label>
                        <input type="email" id="email" name="email"
                            class="form-input {{ $errors->has('email') ? 'error' : '' }}" placeholder="tu@email.com"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="field-error visible">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Campo contraseña con indicador de fortaleza --}}
                    <div class="form-group">
                        <label for="password">
                            Contraseña <span style="color:var(--pink)">*</span>
                        </label>
                        <div class="input-wrap">
                            <input type="password" id="password" name="password"
                                class="form-input has-icon {{ $errors->has('password') ? 'error' : '' }}"
                                placeholder="Mínimo 8 caracteres" required autocomplete="new-password"
                                oninput="checkStrength(this.value)">
                            <span class="input-icon" onclick="togglePass('password', this)">👁️</span>
                        </div>
                        {{--
                        Indicador visual de fortaleza de contraseña
                        Las barras las maneja el JavaScript de abajo
                    --}}
                        <div class="strength-wrap">
                            <div class="strength-bars">
                                <div class="strength-bar" id="sb1"></div>
                                <div class="strength-bar" id="sb2"></div>
                                <div class="strength-bar" id="sb3"></div>
                                <div class="strength-bar" id="sb4"></div>
                            </div>
                            <div class="strength-label" id="strength-label">
                                Ingresa una contraseña
                            </div>
                        </div>
                        @error('password')
                            <div class="field-error visible">{{ $message }}</div>
                        @enderror
                    </div>

                    {{--
                    Campo de confirmación de contraseña
                    name="password_confirmation" es el nombre exacto
                    que Breeze espera para comparar con "password"
                --}}
                    <div class="form-group">
                        <label for="password_confirmation">
                            Confirmar contraseña <span style="color:var(--pink)">*</span>
                        </label>
                        <div class="input-wrap">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-input has-icon" placeholder="Repite tu contraseña" required
                                autocomplete="new-password">
                            <span class="input-icon" onclick="togglePass('password_confirmation', this)">👁️</span>
                        </div>
                        {{--
                        Breeze valida automáticamente que password y
                        password_confirmation coincidan — si no coinciden
                        muestra este error
                    --}}
                        @error('password_confirmation')
                            <div class="field-error visible">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Checkbox de términos — solo visual por ahora --}}
                    <div class="terms-check">
                        <input type="checkbox" id="terminos" required>
                        <label for="terminos">
                            Acepto los <a href="#">términos y condiciones</a>
                            y la <a href="#">política de privacidad</a>. 🎁
                        </label>
                    </div>

                    {{--
                    Botón submit
                    type="submit" envía el formulario al servidor
                    No necesita onclick ni JavaScript
                --}}
                    <button type="submit" class="btn-auth">
                        ✨ Crear mi cuenta
                    </button>

                </form>

                <div class="auth-switch">
                    ¿Ya tienes cuenta?
                    <a href="{{ route('login') }}">Inicia sesión aquí</a>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle mostrar/ocultar contraseña
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

        // Indicador de fortaleza de contraseña
        // Se ejecuta cada vez que el usuario escribe en el campo
        function checkStrength(val) {
            const bars = [
                document.getElementById('sb1'),
                document.getElementById('sb2'),
                document.getElementById('sb3'),
                document.getElementById('sb4')
            ];
            const label = document.getElementById('strength-label');

            // Reiniciar todas las barras
            bars.forEach(b => b.className = 'strength-bar');

            if (!val) {
                label.textContent = 'Ingresa una contraseña';
                return;
            }

            // Calcular puntaje según criterios
            let score = 0;
            if (val.length >= 8) score++; // longitud mínima
            if (/[A-Z]/.test(val)) score++; // tiene mayúsculas
            if (/[0-9]/.test(val)) score++; // tiene números
            if (/[^A-Za-z0-9]/.test(val)) score++; // tiene símbolos

            // Aplicar clase y texto según el puntaje
            const niveles = [{
                    cls: 'weak',
                    texto: '😬 Muy débil',
                    barras: 1
                },
                {
                    cls: 'weak',
                    texto: '🤔 Débil',
                    barras: 2
                },
                {
                    cls: 'medium',
                    texto: '😊 Aceptable',
                    barras: 3
                },
                {
                    cls: 'strong',
                    texto: '💪 Fuerte',
                    barras: 4
                },
            ];

            const nivel = niveles[Math.max(0, score - 1)];
            for (let i = 0; i < nivel.barras; i++) {
                bars[i].classList.add(nivel.cls);
            }
            label.textContent = nivel.texto;
        }
    </script>
@endpush
