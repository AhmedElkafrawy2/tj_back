@extends('site.layouts.master')
@section('title')
- التجارب
@endsection
@section('content')
<main class="site-content py-5">

    <h1 class="page-title h4 font-cairo-bold text-center">
        صفحة التجارب
    </h1><!-- page-title -->

    <section class="section recent-experience py-5">
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
                        <a href="{{ url('/experiment/' . $exp->id) }}">
                            <img src="{{ \App\Http\Controllers\Site\HomeController::get_Exp_Img($exp->id) }}"
                                 class="img-fluid rounded"
                                 width="370"
                                 height="250"
                                 alt="{{ $exp->title }}">
                        </a>
                    </div><!-- entry-content -->
                    <footer class="entry-footer order-3 px-2">
                        <span class="success text-light font-cairo-semi-bold">
                            <i class="fa fa-check-square-o text-pink ml-2" aria-hidden="true"></i> {{ $exp->status }}
                        </span>
                        <span class="price text-light font-cairo-semi-bold mr-4">
                            <i class="icon-cost-icon fa ml-2 text-pink" aria-hidden="true"></i>{{ $exp->cost }} ر.س
                        </span>
                    </footer><!-- entry-footer -->
                </article><!-- entry -->
				@endforeach
            </div><!-- row -->
			
				{{ $experiments->links('site.pagination.pagination') }} 
			</nav>           
            
        </div><!-- container -->
    </section><!-- section recent-experience -->

</main><!-- site-content -->
@endsection