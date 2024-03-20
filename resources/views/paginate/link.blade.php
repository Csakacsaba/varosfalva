
@vite('resources/css/link-paginate.css')
@if ($paginator->hasPages())
    <ul class="pagination pagination">
        @if ($paginator->onFirstPage())
            <li ><a class="disabled" >x</a></li>
        @else
            <li><a class="jumping" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa-solid fa-circle-arrow-left fa-bounce"></i></a></li>
        @endif
        @if($paginator->currentPage() > 3)
            <li ><a  class="number" href="{{ $paginator->url(1) }}">1</a></li>
        @endif
        @if($paginator->currentPage() > 4)
            <li><span>...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="active"><span class="number">{{ $i }}</span></li>
                @else
                    <li><a class="number" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li><span>...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li><a class="number" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif


        @if ($paginator->hasMorePages())
            <li><a class="jumping" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa-solid fa-circle-arrow-right fa-bounce"></i></a></li>
        @else
            <li><span class="disabled">x</span></li>
        @endif
    </ul>
@endif
