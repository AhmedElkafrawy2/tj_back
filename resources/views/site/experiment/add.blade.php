@extends('site.layouts.master')
@section('title')
- اضف تجربة
@endsection
@section('content')
<main class="site-content py-5">

    <div class="container">

        <h1 class="page-title h4 font-cairo-bold text-center">
            إضافة تجربة
        </h1><!-- page-title -->

        <div class="experience-form-wrap mt-5 py-5">

            <h5 class="font-cairo-bold mb-5">يرجى تعبئة الحقول التالية</h5>

            <form id = "exp-add-form" class="experience-form" action="{{ url('/add/experiment') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="alert alert-danger add-exp-errors">
                	<ul></ul>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <p class="font-cairo-bold">صورة التجربة</p>
                        <label class="btn btn-outline-lighten p-4" for="experience-image">
                            <i class="fa fa-plus fa-fw fa-lg" aria-hidden="true"></i>
                            <input name="images" type="file" id="experience-image" class="add-exp-img form-control" hidden>
                        </label>
                    </div>
                </div>
				<div class="add-exp-images row">
					
				</div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="experience-name" class="font-cairo-bold line-height-lg">اسم التجربة</label>
                        <input type="text" class="exp-name form-control border-lighten rounded-0" name="experience-name" id="experience-name" placeholder="عنوان التجربة">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="experience-name" class="font-cairo-bold line-height-lg">وصف التجربة</label>
                        <textarea class="exp_desc form-control border-lighten rounded-0" id="experience-name" placeholder="وصف التجربة"></textarea>      
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="experience-case" class="font-cairo-bold line-height-lg">تصنيف التجربة</label>
                        <select id="exp-cat experience-case" class="exp-cat custom-select border-lighten rounded-0 text-light">
                            <option value="" selected>يرجى تحديد تصنيف التجربة</option>
                            @foreach($categories as $c)
                            	<option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="experience-case" class="font-cairo-bold line-height-lg">الحالة</label>
                        <select id="exp-status experience-case" class="exp-status custom-select border-lighten rounded-0 text-light">
                            <option value="" selected>يرجى تحديد الحالة</option>
                            @foreach($status as $s)
                            	<option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="experience-date" class="font-cairo-bold line-height-lg">تاريخ التجربة</label>
                        <input type="date" class="exp-date form-control border-lighten rounded-0" id="experience-date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="experience-cost" class="font-cairo-bold line-height-lg">التكلفة (بالريال السعودي)</label>
                        <input type="text" class="exp-cost form-control border-lighten rounded-0" id="experience-cost" placeholder="التكلفة">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="experience-country" class="font-cairo-bold line-height-lg">الدولة</label>
                        <select id="experience-country" class="custom-select border-lighten rounded-0 text-light">
                            <option value="" selected>يرجى تحديد الدولة</option>
                            @foreach($countries as $country)
                            	<option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="experience-city" class="font-cairo-bold line-height-lg">المدينة</label>
                        <select id="experience-city" class="custom-select border-lighten rounded-0 text-light">
                        	<option value="">المدينة</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="add-exp-btn btn btn-secondary text-white radius px-5 line-height-lg mt-3">إضافة التجربة
                </button>
            </form>

        </div><!-- reply -->

    </div><!-- container -->

</main><!-- site-content -->

@endsection