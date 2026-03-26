@extends('layouts.app')

@section('title', 'Categorías - Gomitas')

@section('content')

    {{-- == PAGE HERO== --}}
    <div class="page-hero">
        <div class="pager-hero-inner">
            <div class="bradcrumb">
                <a href="{{ route('home') }}">Inicio</a>
                <span class="breadcrumb-sep">›</span>
                <span>Categorías</span>
            </div>
            <h1>Todas las <span>Categorías</span></h1>
            <p>Explora más de 500 plantillas digitales organizadas</p>
        </div>
    </div>

    {{-- == GRID DE CATEGORIAS== --}}
    <section class="categorias-section">
        <div class="categorias-count">
            Mostrando <strong> {{ $categorias->count() }} categorías</strong> disponibles
        </div>

        <div class="categorias-grid">
            @forelse ($categorias as $categoria)
                <a href="{{ route('categorias.show', $categoria->slug) }}" class="categoria-card">
                    <div class="cat-img-wrap">
                        <img src="{{ $categoria->imagen_url }}" alt="{{ $categoria->nombre }}"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                        <div class="cat-emoji-fallback", style="display:none">
                            {{ $categoria->emoji }}
                        </div>
                        <div class="cat-overlay"><span>Ver productos</span></div>
                    </div>
                    <div class="cat-body">
                        <div class="cat-name">{{ $categoria->nombre }}</div>
                        <div class="cat-desc">{{ $categoria->descripcion }}</div>
                        <div class="cat-footer">
                            <span>
                                🎁 {{ $categoria->productos_activos_count ?? 0 }} ➕ Productos
                            </span>
                            <span class="cat-arrow">→</span>
                        </div>
                    </div>
                </a>
            @empty
                <p>No hay categorías disponibles.</p>
            @endforelse
        </div>
    </section>
    {{-- == BANNER PROMO== --}}
    <div class="promo-banner">
        <div class="promo-inner">
            <h2>¿No encuentras lo que buscas?</h2>
            <p>Tenemos más de 500 plantillas. Usa el buscador o contáctanos y te ayudaremos a encontrar el diseño perfecto
            </p>
            <a href="{{ route('contacto') }}" class="btn-white">💬 Escríbenos</a>
        </div>
    </div>
@endsection
