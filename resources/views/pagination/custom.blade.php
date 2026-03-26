@if ($paginator->hasPages())
    <div class="paginacion-inner">

        {{-- Anterior --}}
        @if ($paginator->onFirstPage())
            <span class="pag-btn disabled">‹</span>
        @else
            <a class="pag-btn" href="{{ $paginator->previousPageUrl() }}">‹</a>
        @endif

        {{-- Números --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pag-btn dots">…</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pag-btn active">{{ $page }}</span>
                    @else
                        <a class="pag-btn" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Siguiente --}}
        @if ($paginator->hasMorePages())
            <a class="pag-btn" href="{{ $paginator->nextPageUrl() }}">›</a>
        @else
            <span class="pag-btn disabled">›</span>
        @endif

    </div>
@endif
