@if ($paginator->hasPages())
    <div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a class="flex-c-m how-pagination1 trans-04 m-all-7" href="{{ $paginator->previousPageUrl() }}" >&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="flex-c-m how-pagination1 trans-04 m-all-7 hahaclass disabled">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">{{ $page }}</span>
                    @else
                        <a class="flex-c-m how-pagination1 trans-04 m-all-7" href="{{ $url }}" title="">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="flex-c-m how-pagination1 trans-04 m-all-7" href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
        @endif
    </div>
@endif
