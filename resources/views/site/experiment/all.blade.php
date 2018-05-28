@extends('site.layouts.master')
@section('title')
- التجارب
@endsection
@section('content')
<main class="site-content pb-5">

    <section class="section carousel-wrap">
        <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img src="http://placehold.it/1920x650/d4dadd"
                         width="1920"
                         height="650"
                         alt="Carousel image"
                         class="d-block w-100 h-auto">
                    <div class="container">
                        <div class="carousel-caption d-none d-md-block text-right">
                            <h2 class="text-indigo font-cairo-bold">التجارب الأفضل في مكان واحد بين يديك</h2>
                            <p class="lead text-gray font-cairo-semi-bold mt-3">
                                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                            </p>
                            <a href="experience.html" class="btn btn-outline-pink line-height-lg radius px-5 mt-3">اقرأ المزيد</a>
                        </div>
                    </div>
                </div><!-- carousel-item active -->

                <div class="carousel-item">
                    <img src="http://placehold.it/1920x650/c2ccd0"
                         width="1920"
                         height="650"
                         alt="Carousel image"
                         class="d-block w-100 h-auto">
                    <div class="container">
                        <div class="carousel-caption d-none d-md-block text-right">
                            <h2 class="text-indigo font-cairo-bold">التجارب الأفضل في مكان واحد بين يديك</h2>
                            <p class="lead text-gray font-cairo-semi-bold mt-3">
                                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                            </p>
                            <a href="experience.html" class="btn btn-outline-pink line-height-lg radius px-5 mt-3">اقرأ المزيد</a>
                        </div>
                    </div>
                </div><!-- carousel-item active -->

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

    <section class="section recent-experience py-5 mt-5">
        <header class="section-header">
            <h4 class="section-title font-cairo-bold text-center">
                قائمة التجارب
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
                <a href="{{ url('/experiment/all') }}" class="more-link btn btn-outline-pink radius line-height-lg px-5 font-cairo-bold align-self-end">شاهد المزيد</a>
            </div>
        </div><!-- container -->
    </section><!-- section recent-experience -->
</main><!-- site-content -->
@endsection