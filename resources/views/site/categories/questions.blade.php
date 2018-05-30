@extends('site.layouts.master')
@section('title')
- التجارب
@endsection
@section('content')
<main class="site-content py-5">

    <header class="section-header mb-5">
        <h4 class="section-title font-cairo-bold text-center">
            صفحة اسئلة {{ $cat->name }}
            <img src="{{ asset('img/separator.png') }}"
                 width="281"
                 height="17"
                 alt="Separator"
                 class="mt-2 d-block mx-auto img-fluid">
        </h4><!-- section-title -->
    </header><!-- section-header -->

    <section class="section recent-questions py-5 mt-5">
        <div class="container">
            <div class="accordion" id="accordion">
				
				@foreach($questions as $question)
                <div class="card border-0 mb-3">
                    <div class="card-header border-0 p-0" id="accordion-header-1">
                        <h5 class="mb-0 text-truncate">
                            <a class="btn btn-link font-cairo-bold collapsed"
                               data-toggle="collapse"
                               data-target="#accordion-collaps-1"
                               aria-expanded="true" aria-controls="accordion-collaps-1">
                                <i class="fa p-2 text-white rounded ml-2"></i> {{ $question->title }}
                            </a>
                        </h5>
                    </div>

                    <div id="accordion-collaps-1" class="collapse" aria-labelledby="accordion-header-1" data-parent="#accordion">
                        <a href = "{{ url('/question/' . $question->id) }}">
                            <div class="card-body font-cairo-semi-bold text-light py-0 px-5">
    							{{ $question->description }}
                            </div>
                        </a>
                    </div>
                </div><!-- card -->
				@endforeach

            </div><!-- accordion -->
			{{ $questions->links('site.pagination.pagination') }}
        </div><!-- container -->
    </section><!-- section recent-questions -->

</main><!-- site-content -->
@endsection