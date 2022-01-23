@if ($paginator->hasPages())

{{--    <ul class="pagination-box">--}}
{{--        <li><a class="Previous" href="#">Previous</a></li>--}}
{{--        <li class="active"><a href="#">1</a></li>--}}
{{--        <li><a href="#">2</a></li>--}}
{{--        <li><a href="#">3</a></li>--}}
{{--        <li><a class="Next" href="#"> Next </a></li>--}}
{{--    </ul>--}}
    <nav>
        <ul class="pagination-box">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="Previous disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="">
                    <a class="Previous" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class=" active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class=""><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="">
                    <a class=" Next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class=" Next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
