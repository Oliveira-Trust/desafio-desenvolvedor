<nav aria-label="Page navigation">
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl()}}">Previous</a></li>
      @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="page-item 
        @if ($paginator->currentPage() === $i)
            active
        @endif
        "><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
      @endfor
      <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl()}}">Next</a></li>
    </ul>
  </nav>