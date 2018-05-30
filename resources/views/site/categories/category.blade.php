@extends('site.layouts.master')
@section('title')
- {{ $cat->name }}
@endsection
@section('content')
<main class="site-content pb-5">


	<h1 class="page-title h4 font-cairo-bold text-center">
        {{ $cat->name }}
    </h1><!-- page-title -->
    <section class="section recent-experience py-5 mt-5">
        <header class="section-header">
            <h4 class="section-title font-cairo-bold text-center">
                أحدث التجارب
                <img src="{{ asset('img/separator.png') }}"
                     width="281"
                     height="17"
                     alt="Separator"
                     class="mt-2 d-block mx-auto img-fluid">
            </h4><!-- section-title -->
        </header>
        <div class="container">
            <div class="row">
            	@foreach($experiments as $exp)
                    <article class="entry col-12 col-md-4 mt-5 py-2 d-flex flex-column text-md-right text-center">
                        <header class="entry-header px-2 mt-3 order-2">
                            <h2 class="entry-title h6 font-cairo-bold line-height-lg">
                                <a href="experience.html" class="no-decoration">
                                	{{ $exp->title }}
                                </a>
                            </h2>
                        </header><!-- entry-header -->
                        <div class="entry-content order-1">
                            <a href="experience.html">
                            	<a href="{{ url('/experiment/' . $exp->id) }}">
                                    <img src="{{ \App\Http\Controllers\Site\HomeController::get_Exp_Img($exp->id) }}"
                                         class="img-fluid rounded"
                                         width="370"
                                         height="250"
                                         alt="{{ $exp->title }}">
                                </a>
                            </a>
                        </div><!-- entry-content -->
                        <footer class="entry-footer order-3 px-2">
                            <span class="success text-light font-cairo-semi-bold">
                                <i class="fa fa-check-square-o text-pink ml-2" aria-hidden="true"></i> {{ $exp->status }}
                            </span>
                            <span class="price text-light font-cairo-semi-bold mr-4">
                                <i class="icon-cost-icon fa ml-2 text-pink" aria-hidden="true"></i>{{ $exp->cost }} ر.س
                            </span>
<!--                             <span class="price text-light font-cairo-semi-bold mr-4"> -->
<!--                                 <i class="fa fa-tag ml-2 text-pink" aria-hidden="true"></i>{{ $exp->cost }} ر.س -->
<!--                             </span> -->
                        </footer><!-- entry-footer -->
                    </article><!-- entry -->
				@endforeach
            </div><!-- row -->
            <div class="text-center mt-5">
                <a href="{{ url('/categories/experiment/') ."/" . $cat->name }}" class="more-link btn btn-outline-pink radius line-height-lg px-5 font-cairo-bold align-self-end">شاهد المزيد</a>
            </div>
        </div><!-- container -->
    </section><!-- section recent-experience -->

    <section class="section recent-questions py-5 mt-5">
        <header class="section-header mb-5">
            <h4 class="section-title font-cairo-bold text-center">
                أحدث الأسئلة
                <img src="{{ asset('img/separator.png') }}"
                     width="281"
                     height="17"
                     alt="Separator"
                     class="mt-2 d-block mx-auto img-fluid">
            </h4><!-- section-title -->
        </header><!-- section-header -->
        <div class="container">
            <div class="accordion" id="accordion">
				
				@foreach( $questions as $question )
                <div class="card border-0 mb-3">
                    <div class="card-header border-0 p-0" id="accordion-header-1">
                        <h5 class="mb-0 text-truncate">
                            <a class="btn btn-link font-cairo-bold collapsed"
                                data-toggle="collapse"
                                data-target="#accordion-collaps-1"
                                aria-expanded="true" aria-controls="accordion-collaps-1">
                                <i class="fa p-2 text-white rounded ml-2"></i>{{ $question->title }}
                            </a>
                        </h5>
                    </div>

                    <div id="accordion-collaps-1" class="collapse" aria-labelledby="accordion-header-1" data-parent="#accordion">
                        <a href="{{ url('/question/'. $question->id) }}"><div class="card-body font-cairo-semi-bold text-light py-0 px-5">{{ $question->description }}</div></a>
                    </div>
                </div><!-- card -->
				@endforeach
            </div><!-- accordion -->

            <div class="text-center mt-5">
                <a href="{{ url('/categories/questions/' . $cat->name) }}" class="more-link btn btn-outline-pink radius line-height-lg px-5 font-cairo-bold align-self-end">شاهد المزيد</a>
            </div>
        </div><!-- container -->
    </section><!-- section recent-questions -->

</main><!-- site-content -->
@endsection