<head>
	@include('frontend.layouts.head')	
</head>

<div class="panel-block columns is-mobile">
  <div class="column is-6 is-offset-6">
    @if ($paginator->hasPages())
    <nav class="pagination is-centered is-small is-pulled-right" role="navigation" aria-label="pagination">
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
      <a class="pagination-previous" disabled>ย้อนกลับ</a>
      @else
      <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}">ย้อนกลับ</a>
      @endif

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
      <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}">ต่อไป</a>
      @else
      <a class="pagination-next" disabled>ต่อไป</a>
      @endif


      {{-- Pagination Elements --}}
      <ul class="pagination-list">
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li><span class="pagination-ellipsis">&hellip;</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li><a class="pagination-link is-current" style="color: red" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
        @else
        <li><a href="{{ $url }}" class="pagination-link" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach
      </ul>

    </nav>
    @endif
  </div>
</div>

<style>
.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 16px;
  text-decoration: none;
  /* margin: 15px ; */
}
</style>