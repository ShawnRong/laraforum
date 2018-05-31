@if ($paginator->hasPages())

  <nav class="pagination">
    <a href="{{ $paginator->previousPageUrl() }}"
      class="pagination-previous {{ $paginator->onFirstPage() ? 'is-disabled': '' }}">
      Previous
    </a>
    <a href="{{ $paginator->nextPageUrl() }}"
      class="pagination-next {{ !$paginator->hasMorePages() ? 'is-disabled': '' }}">
      Next
    </a>
    <ul class="pagination-list">
      @foreach ($elements as $element)

        @if (is_string($element))
          <li><span class="pagination-ellipsis">&hellip;</span></li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            <li>
              <a href="{{ $url }}"
                class="pagination-link {{ $page == $paginator->currentPage() ? 'is-current' : '' }}">
                {{ $page }}
              </a>
            </li>
          @endforeach
        @endif
      @endforeach
    </ul>
  </nav>

@endif