@extends('site.layouts.master')
@section('title')
- {{ $page->title }}
@endsection
@section('content')
<main class="site-content py-5">

    <h1 class="page-title h4 font-cairo-bold text-center">
		{{ $page->title }}
    </h1><!-- page-title -->
    <div class="page-content mt-5 py-5">
    
        <div class="container">
			{{ $page->content }}
        </div>
	
    </div><!-- page-content -->
</main><!-- site-content -->
@endsection