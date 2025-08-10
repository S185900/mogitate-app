@if ($paginator->hasPages())
<nav>
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <div class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span aria-hidden="true">&lsaquo;</span>
        </div>
        @else
        <div>
            <a class="pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </div>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <div class="disabled" aria-disabled="true"><span>{{ $element }}</span></div>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))

        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <div class="active" aria-current="page"><span>{{ $page }}</span></div>
        @else
        <div><a href="{{ $url }}">{{ $page }}</a></div>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <div>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </div>
        @else
        <div class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span aria-hidden="true">&rsaquo;</span>
        </div>
        @endif
    </div>
</nav>
@endif