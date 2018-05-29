@extends('site.layouts.master')
@section('title')
- {{ $experiment->title }}
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

	<main class="site-content py-5">
        <h1 class="page-title h4 font-cairo-bold text-center">
            {{ $experiment->title }}
        </h1><!-- page-title -->
        <div class="page-content mt-5 py-5">
    
            <div class="container">
            	@if(Session::has('success'))
    			<div class="row">
    				<div class="alert alert-success">
    					<strong>{{ Session::get('success') }}</strong>
    				</div>
    			</div>
    			@endif
                <div class="row">
    				
                    <div class="col-12 col-md-9 d-md-flex align-content-between flex-wrap">
                        <div class="img-wrap">
                            <img src="{{ $images[0]->image_url }}"
                                 width="870"
                                 height="598"
                                 class="img-fluid d-block"
                                 alt="Experience image">
                        </div>
                    </div><!-- col -->
                    <div class="col-12 col-md-3 d-md-flex align-content-between flex-wrap">
    					@if( count($images) > 1)
        					@foreach($images as $image)
        						@if($image->image_url != $images[0]->image_url)
                                    <div class="img-wrap">
                                        <img src="{{ $image->image_url }}"
                                             width="270"
                                             height="186"
                                             class="img-fluid d-block mx-auto mt-md-0 mt-4"
                                             alt="Experience image">
                                    </div>
                                @endif
                            @endforeach
    					@endif
                    </div><!-- col -->
    
                </div><!-- row -->
    
                <div class="entry-header mt-5">
    
                    <h2 class="h4 entry-title font-cairo-bold line-height-lg">
                        {{ $experiment->title }}
                    </h2><!-- entry-title -->
    
                    <div class="entry-meta">
    
                        <span class="success d-md-inline d-block text-light h5 font-cairo-semi-bold line-height-lg">
                            <i class="fa fa-check-square-o fa-lg text-pink ml-2" aria-hidden="true"></i> {{ $experiment->status }}
                        </span>
    
                        <span class="price d-md-inline d-block text-light h5 font-cairo-semi-bold mr-auto mr-md-4 line-height-lg">
                            <i class="icon-cost-icon fa fa-lg ml-2 text-pink" aria-hidden="true"></i>{{ $experiment->cost }} ر.س
                        </span>
    
                        <span class="address d-md-inline d-block text-light h5 font-cairo-semi-bold mr-auto mr-md-4 line-height-lg">
                            <i class="fa fa-map-marker fa-lg ml-2 text-pink" aria-hidden="true"></i>{{ $experiment->city }} ، {{ $experiment->country }}
                        </span>
    
                    </div><!-- entry-meta -->
    
                </div><!-- entry-header -->
    
                <div class="entry-content py-5 border-bottom border-lighten">
    
                    <div class="content-aria pb-5 border-bottom border-lighten">
                        <h5 class="date font-cairo-bold line-height-lg">
                            {{ $experiment->created_at }}
                        </h5>
                        <p class="text-light font-cairo-semi-bold line-height-lg">
                        	{{ $experiment->description }}
                        </p>
    					
    					@foreach($replies as $reply)
                            <h5 class="date font-cairo-bold line-height-lg">
                                {{ $reply->created_at }}
                            </h5>
                            <p class="text-light font-cairo-semi-bold line-height-lg">
                            	{{ $reply->description }}
                            </p>
        					@if($reply->image_url != null)
                                <img src="{{ $reply->image_url }}"
                                     class="img-fluid d-block mt-5"
                                     width="670"
                                     height="352"
                                     alt="{{ $reply->description }}">
                            @endif
                        @endforeach
                    </div><!-- content-aria -->
    				@if($experiment->user_id == auth()->id())
                    <div class="update-aria mt-5">
                        <h5 class="font-cairo-bold line-height-lg">تحديث التجربة</h5>
                        <form action="{{ url('/experiment/add/reply') }}" method="POST" enctype="multipart/form-data">
                        	{{ csrf_field() }}
                        	<input type="hidden" name = "exp_id" value = "{{ $experiment->id }}" />
                            <div class="form-group">
                                <textarea name = "reply" class="form-control border-lighten rounded-0" id="update-content" placeholder="نص التحديث"></textarea>      
                    		    @if ($errors->has('reply'))
                                    <div class="add-reply-error-content alert alert-danger">
                                        <strong>{{ $errors->first('reply') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between flex-column flex-md-row">
                                <label class="btn btn-outline-pink line-height-lg radius mb-md-0 px-0 px-md-5 font-cairo-bold">
                                    إرفاق صورة <input name="replyImage" id = "replyImage" type="file" hidden>
                                </label>
                                <button type="submit" class="btn btn-secondary text-white line-height-lg radius px-0 px-md-5 font-cairo-bold">إرسال</button>
                            </div>
                            
                            @if ($errors->has('replyImage'))
                                <div class="add-reply-error-content alert alert-danger">
                                    <strong>{{ $errors->first('replyImage') }}</strong>
                                </div>
                            @endif
                        </form>
                    </div><!-- update-aria -->
    				@endif
                </div><!-- entry-content -->
    
                <div class="comments py-5 border-bottom border-lighten">
    
                    <h5 class="comments-title font-cairo-bold line-height-lg mb-5">التعليقات</h5><!-- comments-title -->
                    @foreach($comments as $comment)
                    <div class="media">
                        <img class="ml-2 ml-sm-5 rounded-circle"
                             src="{{ url('/storage/app/public/users/default.png') }}"
                             width="70"
                             height="70"
                             alt="Generic placeholder image">
                        <div class="media-body font-cairo-semi-bold text-light">
                            <div class="row">
                                <div class="col-12 col-sm-10">
                                    <span class="line-height-lg">{{ $comment->created_at }}</span>
                                    <h5 class="mt-0 font-cairo-bold text-pink line-height-lg">{{ $comment->name }}</h5>
                                    <p class="line-height-lg">
                                       {{ $comment->comment }}
                                    </p>
                                </div>
                                <div class="col-12 col-sm-2 text-left">
                                    <button comment_id = "{{ $comment->comment_id }}" class = "add-reply-btn btn btn-outline-pink px-5 line-height-lg radius font-cairo-bold">رد</button>
                                	<input type = "hidden" name="comment-id" value="{{ $comment->comment_id }}" />
                                </div>
                            </div>
                            @if(\App\Http\Controllers\Site\CommentController::get_comment_replies($comment->comment_id,'count') > 0)
                                @foreach(\App\Http\Controllers\Site\CommentController::get_comment_replies($comment->comment_id) as $reply)
                                    <div class="media mt-3">
                                        <a class="pl-2 pl-sm-5" href="#">
                                            <img class="rounded-circle"
                                                 src="{{ url('/storage/app/public/users/default.png') }}"
                                                 width="70"
                                                 height="70"
                                                 alt="Generic placeholder image">
                                        </a>
                                        <div class="media-body font-cairo-semi-bold text-light">
                                            <div class="row">
                                                <div class="col-12 col-sm-10">
                                                    <span class="line-height-lg">{{ $reply->created_at }}</span>
                                                    <h5 class="mt-0 font-cairo-bold text-pink line-height-lg">
                                                        {{ $reply->name }}
                                                    </h5>
                                                    <p class="line-height-lg">
														{{ $reply->reply }}            
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div><!-- media -->
    				@endforeach
                </div><!-- comments -->
    			@if(auth()->user())
                    <div class="reply py-5">
                        <h5 class="font-cairo-bold mb-5">إترك تعليق</h5>
        
                        <form action="{{ url('/comment/add') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="your-message" class="sr-only">الرسالة</label>
                                <input type = "hidden" name="id" value="{{ $experiment->id }}" />
                                <input type = "hidden" name="type" value="experiment" />
                                <textarea name = "comment" class="form-control border-lighten rounded-0" id="your-message" rows="5" placeholder="الرسالة"></textarea>
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
                		قم بالتسجيل لكى تتمكن من اضافة تعليق
                	</div>
    			@endif
    			
            </div><!-- container -->
    
        </div><!-- page-content -->
	</main><!-- site-content -->
</main><!-- site-content -->
@endsection