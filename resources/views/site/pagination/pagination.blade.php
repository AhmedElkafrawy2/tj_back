{{-- Pagination Elements --}}
@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())		
		    <li class="page-item mx-1">
                <a class="page-link rounded border-lighten bg-white text-light" href="{{ $paginator->previousPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">السابق</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
		@endif


@foreach ($elements as $element)
	{{-- "Three Dots" Separator --}}
    @if (is_string($element))
    
            <li class="page-item mx-1">
                <a class="page-link rounded border-lighten bg-white text-light" href="#">&hellip;</a>
            </li>
   
    @endif
    {{-- Array Of Links --}}
    @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item mx-1 active">
                            <a class="page-link rounded border-pink bg-pink" href="#">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item mx-1">
                            <a href= "{{ $url }}" class="page-link rounded border-lighten bg-white text-light" href="#">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
    @endif
@endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        
                <li class="page-item mx-1">
                    <a class="page-link rounded border-lighten bg-white text-light" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">التالي</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>        
        @endif
    </ul>
@endif
    
    
    
    
    
    