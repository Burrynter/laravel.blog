<ul class="pagination">
    @if (PaginateRoute::hasPreviousPage())
        <li style="padding: 0 0.1em;">
            <a href="{{ PaginateRoute::previousPageUrl() }}" rel="prev" class="btn btn-secondary">«</a>
        </li>
    @else
        <li style="padding: 0 0.1em;">
            <li class="disabled"><a href="#" aria-label="Previous" class="btn btn-outline-secondary"><span aria-hidden="true">«</span>
        </a>
    @endif

    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}" style="padding: 0 0.1em;">
            <a href="{{ PaginateRoute::pageUrl($i) }}" class="btn btn-secondary">{{ $i }}</a>
        </li>
    @endfor

    @if (PaginateRoute::hasNextPage($paginator))
        <li style="padding: 0 0.1em;">
            <a href="{{ PaginateRoute::nextPageUrl($paginator) }}" rel="next" class="btn btn-secondary">»</a>
        </li>
    @else 
        <li style="padding: 0 0.1em;">
            <li class="disabled"><a href="#" aria-label="Next" class="btn btn-outline-secondary"><span aria-hidden="true">»</span>
        </a>
    @endif

</ul>