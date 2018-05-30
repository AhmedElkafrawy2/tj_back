<section class="section carousel-wrap">
    <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
			
			@foreach($slider as $key => $s)
			    
            <div class="carousel-item @if ( $key == 0) active @endif">
                <img src="http://placehold.it/1920x650/d4dadd"
                     width="1920"
                     height="650"
                     alt="Carousel image"
                     class="d-block w-100 h-auto">
                <div class="container">
                    <div class="carousel-caption d-none d-md-block text-right">
                        <h2 class="text-indigo font-cairo-bold">{{ $s->main_title }}</h2>
                        <p class="lead text-gray font-cairo-semi-bold mt-3">
                            {{ $s->sub_title }}
                        </p>
                        <a href="{{ $s->link }}" class="btn btn-outline-pink line-height-lg radius px-5 mt-3">اقرأ المزيد</a>
                    </div>
                </div>
            </div><!-- carousel-item active -->
			@endforeach
  	  	</div><!-- carousel-inner -->
        <a class="carousel-control-prev rounded-circle"
           href="#carousel"
           role="button"
           data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next rounded-circle"
           href="#carousel"
           role="button"
           data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
	</div>
</section><!-- section carousel-wrap -->