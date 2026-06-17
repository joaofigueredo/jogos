@if ($paginator->hasPages())
<nav class="d-flex justify-content-between align-items-center bg-white border rounded-3 shadow-sm p-3" role="navigation"
    aria-label="{!! __('Pagination Navigation') !!}">

    {{-- LAYOUT MOBILE (Apenas Botões Anterior / Próximo) --}}
    <div class="d-flex justify-content-between flex-fill d-sm-none">
        <ul class="pagination mb-0 w-100 justify-content-between">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="page-item disabled flex-fill text-center" aria-disabled="true">
                <span class="page-link rounded-2 py-2">@lang('pagination.previous')</span>
            </li>
            @else
            <li class="page-item flex-fill text-center">
                <a class="page-link rounded-2 py-2" href="{{ $paginator->previousPageUrl() }}"
                    rel="prev">@lang('pagination.previous')</a>
            </li>
            @endif

            <div class="mx-2"></div> {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="page-item flex-fill text-center">
                <a class="page-link rounded-2 py-2" href="{{ $paginator->nextPageUrl() }}"
                    rel="next">@lang('pagination.next')</a>
            </li>
            @else
            <li class="page-item disabled flex-fill text-center" aria-disabled="true">
                <span class="page-link rounded-2 py-2">@lang('pagination.next')</span>
            </li>
            @endif
        </ul>
    </div>

    {{-- LAYOUT DESKTOP (Contador + Números das Páginas) --}}
    <div class="d-none flex-sm-fill d-sm-flex align-items-center justify-content-between">
        <div>
            <p class="small text-secondary mb-0">
                {!! __('Mostrando') !!}
                <span class="fw-bold text-dark">{{ $paginator->firstItem() }}</span>
                {!! __('a') !!}
                <span class="fw-bold text-dark">{{ $paginator->lastItem() }}</span>
                {!! __('de') !!}
                <span class="fw-bold text-dark">{{ $paginator->total() }}</span>
                {!! __('resultados') !!}
            </p>
        </div>

        <div>
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li class="page-item active" aria-current="page"><span class="page-link fw-semibold">{{ $page }}</span>
                </li>
                @endif
                @endforeach
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
                @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@endif