@if ($paginator->hasPages())

{{--    <ul class="pagination-box">--}}
{{--        <li><a class="Previous" href="#">Previous</a></li>--}}
{{--        <li class="active"><a href="#">1</a></li>--}}
{{--        <li><a href="#">2</a></li>--}}
{{--        <li><a href="#">3</a></li>--}}
{{--        <li><a class="Next" href="#"> Next </a></li>--}}
{{--    </ul>--}}
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="page-link page-link-prev" href="#">
                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev

                    </a>
                </li>
            @else
                <li class="">
                    <a class="page-link page-link-prev" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                    </a>
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
                            <li class=" page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-link-next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                    </a>
                </li>
            @else
                <li class="page-link page-link-next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
