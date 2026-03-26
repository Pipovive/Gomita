<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gomita – Plantillas Digitales')</title>

    {{-- SEO --}}
    @yield('meta')

    {{-- CSS compartido --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- CSS específico de cada página --}}
    @stack('styles')

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    @include('partials.topbar')
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- JS específico de cada página --}}
    @stack('scripts')
</body>

</html>
