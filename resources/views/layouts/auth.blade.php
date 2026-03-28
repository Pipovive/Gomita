<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gomita')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    @stack('styles')
</head>

<body>

    {{-- Header minimal solo con logo y link de contacto --}}
    <header class="header-main" style="position:relative; box-shadow:none; border-bottom: 2px solid var(--pink-light)">
        <div class="header-inner" style="grid-template-columns: auto 1fr; justify-content: space-between;">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('Assets/Logo/GomitaLogoCompleto.png') }}" alt="Gomita"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <div class="logo-fallback" style="display:none">
                        <div class="logo-icon">🐻</div>
                        <span class="logo-text">GOMITA</span>
                    </div>
                </a>
            </div>
            <div
                style="font-size:13px; font-weight:700; color:var(--text-soft); display:flex; align-items:center; gap:6px;">
                ¿Necesitas ayuda?
                <a href="{{ route('contacto') }}" style="color:var(--pink)">Contáctanos 💬</a>
            </div>
        </div>
    </header>

    {{-- Contenido de cada vista --}}
    @yield('content')

    {{-- Footer minimal --}}
    <footer class="footer-min">
        <div class="footer-min-links">
            <a href="{{ route('home') }}">🏠 Inicio</a>
            <a href="{{ route('categorias.index') }}">Categorías</a>
            <a href="{{ route('contacto') }}">Contacto</a>
            <a href="#">Términos y condiciones</a>
        </div>
        <p>© 2025 Gomita – Plantillas Digitales 🎨 Hecho con cariño en Colombia</p>
    </footer>

    @stack('scripts')
</body>

</html>
```

---
