@extends('site.layouts.master')
@section('title')
- اضف سؤال
@endsection
@section('content')
<main class="site-content py-5">

    <div class="container">

        <h1 class="page-title h4 font-cairo-bold text-center">
            إضافة سؤال
        </h1><!-- page-title -->

        <div class="experience-form-wrap mt-5 py-5">

            <h5 class="font-cairo-bold mb-5">يرجى تعبئة الحقول التالية</h5>

            <form id = "add-question-form exp-add-form" class="experience-form" action="{{ url('/add/question') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="alert alert-danger add-exp-errors">
                	<ul></ul>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <p class="font-cairo-bold">صورة السؤال</p>
                        <label class="btn btn-outline-lighten p-4" for="experience-image">
                            <i class="fa fa-plus fa-fw fa-lg" aria-hidden="true"></i>
                            <input name="images" type="file" id="experience-image" class="add-question-img form-control" hidden>
                        </label>
                    </div>
                </div>
				<div class="add-exp-images row">
					
				</div>
				<div class="row">
                    <div class="form-group col-sm-6">
                        <label for="experience-case" class="font-cairo-bold line-height-lg">تصنيف التجربة</label>
                        <select id="exp-cat experience-case" class="exp-cat custom-select border-lighten rounded-0 text-light">
                            <option value="" selected>يرجى تحديد تصنيف السؤال</option>
                            @foreach($categories as $c)
                            	<option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="experience-name" class="font-cairo-bold line-height-lg">عنوان السؤال</label>
                        <input type="text" class="question-name exp-name form-control border-lighten rounded-0" name="experience-name" id="experience-name" placeholder="عنوان السؤال">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="experience-name" class="font-cairo-bold line-height-lg">وصف السؤال</label>
                        <textarea class="question-desc exp_desc form-control border-lighten rounded-0" id="experience-name" placeholder="وصف السؤال"></textarea>      
                    </div>
                </div>

                <button type="submit" class="add-question-btn btn btn-secondary text-white radius px-5 line-height-lg mt-3">إضافة السؤال
                </button>
            </form>

        </div><!-- reply -->

    </div><!-- container -->

</main><!-- site-content -->

@endsection