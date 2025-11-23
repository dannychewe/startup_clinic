@if ($paginator->hasPages())
    <div class="col-lg-12">
        <div class="mil-pagination">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="mil-pagination-btn disabled" aria-disabled="true">&lsaquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="mil-pagination-btn" rel="prev">&lsaquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)

                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="mil-pagination-btn disabled">{{ $element }}</span>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="mil-pagination-btn mil-active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="mil-pagination-btn">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="mil-pagination-btn" rel="next">&rsaquo;</a>
            @else
                <span class="mil-pagination-btn disabled" aria-disabled="true">&rsaquo;</span>
            @endif

        </div>
    </div>
@endif
