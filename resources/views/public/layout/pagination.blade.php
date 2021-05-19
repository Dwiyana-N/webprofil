@if($paginator->hasPages())

<nav class="pagination-area">
  <ul class="pagination justify-content-center mt-30 mb-30">
    {{-- Previous Page Link --}}
    @if($paginator->currentPage() > 5)
        <li class="">
            <a class="" href="<?php echo $paginator->url( $paginator->currentPage() - 5 ); ?>" rel="prev" aria-label="&lsaquo; Skip 5"> &lsaquo; Skip 5 </a>
        </li>
    @endif
    @if ($paginator->onFirstPage())
        <li class="">
            <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')" aria-hidden="true">&lsaquo;</a>
        </li>
    @else
        <li class="">
            <a class="" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="" aria-disabled="true"><a class="">{{ $element }}</a></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class=""><a class="current" aria-current="page">{{ $page }}</a></li>
                @else
                    <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li class="">
            <a class="" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
    @else
        <li class="" aria-disabled="true" aria-label="@lang('pagination.next')">
            <a class="" aria-hidden="true">&rsaquo;</a>
        </li>
    @endif
    @if($paginator->lastPage() >= $paginator->currentPage()+5)
        <li class="">
            <a class="" href="{{ $paginator->url( $paginator->currentPage() + 5 ) }}" rel="prev" aria-label="Skip 5  &rsaquo;">Skip 5 &rsaquo;</a>
        </li>
    @endif
  </ul>
</nav><!-- .pagination-area -->

@endif
