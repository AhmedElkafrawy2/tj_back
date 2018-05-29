@extends('site.layouts.master')
@section('title')
- {{ $question->title }}
@endsection
@section('content')
<main class="site-content py-5">

    @if(Session::has('success'))
    <div class="container">
    	<div class="row">
    		<div class="alert alert-success">
    			<strong>{{ Session::get('success') }}</strong>
    		</div>
    	</div>
	</div>
	@endif
    <h1 class="page-title h4 font-cairo-bold text-center">
        {{ $question->title }}
    </h1><!-- page-title -->

    <div class="page-content mt-5 py-5">

        <div class="container">
			@if($question->image_url != null)
            <div class="img-wrap">
                <img src="{{ $question->image_url }}"
                     width="1170"
                     height="600"
                     class="img-fluid d-block w-100"
                     alt="Experience image">
            </div><!-- img-wrap -->
            @endif
            <div class="entry-header mt-4">

                <h2 class="h4 entry-title font-cairo-bold line-height-lg">
					{{ $question->title }}
                </h2><!-- entry-title -->

            </div><!-- entry-header -->

            <div class="entry-content mt-4">

                <p class="text-light font-cairo-semi-bold line-height-lg">
					{{ $question->description }}
                </p>

            </div><!-- entry-content -->

            <div class="comments py-5 border-bottom border-top border-lighten mt-5">

                <h5 class="comments-title font-cairo-bold line-height-lg mb-5">الأجوبة</h5><!-- comments-title -->
				
				@foreach($comments as $comment)
                    <div class="media">
                        <img class="ml-2 ml-sm-5 rounded-circle"
                             src="{{ url('/storage./app/public/users/default.png') }}"
                             width="70"
                             height="70"
                             alt="Generic placeholder image">
                        <div class="media-body font-cairo-semi-bold text-light">
                            <div class="answer">
                                <span class="line-height-lg">{{ $comment->created_at }}</span>
                                <h5 class="mt-0 font-cairo-bold text-pink line-height-lg">{{ $comment->name }}</h5>
                                <p class="line-height-lg">
									{{ $comment->comment }}    
                                </p>
                            </div>
                        </div>
                    </div><!-- media -->
				@endforeach

            </div><!-- comments -->
			@if(auth()->user())
                <div class="reply py-5">
                    <h5 class="font-cairo-bold mb-5">إضافة جواب</h5>
    
                    <form action="{{ url('/comment/add') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="your-message" class="sr-only">الجواب</label>
                            <input type = "hidden" name="id" value="{{ $question->id }}" />
                            <input type = "hidden" name="type" value="question" />
                            <textarea name="comment" class="form-control border-lighten rounded-0" id="your-message" rows="5" placeholder="الجواب"></textarea>
                	        @if ($errors->has('comment'))
                                <div class="add-reply-error-content alert alert-danger">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-secondary text-white radius px-5 line-height-lg">إرسال</button>
                    </form>
                </div><!-- reply -->
            @else
            	<div class="alert alert-info">
            		قم بالتسجيل حتى تتمكن من اضافة جواب
            	</div>
			@endif
        </div><!-- container -->

    </div><!-- page-content -->

</main><!-- site-content -->
@endsection