@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">
                    <span class="d-none d-md-block">&lsaquo;</span>
                    <span class="d-block d-md-none">@lang('pagination.previous')</span>
                </span>
            </li>
        @else
            <li class="page-item">
                <button type="button" class="page-link" wire:click="previousPage" rel="prev"
                        aria-label="@lang('pagination.previous')">
                    <span class="d-none d-md-block" wire:click="gotoPage(1)">&lsaquo;</span>
                    <span class="d-block d-md-none">@lang('pagination.previous')</span>
                </button>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)

                    @if ($paginator->currentPage() > 4 && $page === 2)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif

                <!--  Show active page else show the first and last two pages from current page.  -->
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1)
                        <li class="page-item">
                            <button type="button" class="page-link web-pagination-btn"
                                    wire:click="gotoPage({{ $page }})">{{ $page }}</button>
                        </li>
                    @endif

                <!--  Use three dots when current page is away from end.  -->
                    @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        {{--        {{ dd($paginator) }}--}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <button type="button" class="page-link" wire:click="nextPage({{$paginator->lastPage()}})" rel="next"
                        aria-label="@lang('pagination.next')">
                    <span class="d-block d-md-none">@lang('pagination.next')</span>
                    <span class="d-none d-md-block" wire:click="gotoPage({{$paginator->lastPage()}})">&rsaquo;</span>
                </button>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">
                    <span class="d-block d-md-none">@lang('pagination.next')</span>
                    <span class="d-none d-md-block">&rsaquo;</span>
                </span>
            </li>
        @endif
    </ul>
@endif
