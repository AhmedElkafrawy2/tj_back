@extends('site.layouts.master')
@section('title')
- تواصل معنا
@endsection
@section('content')
<main class="site-content py-5">

    <div class="container">

        <h1 class="page-title h4 font-cairo-bold text-center">
            اتصل بنا
        </h1><!-- page-title -->

        <div class="contact-form-wrap mt-5 py-5">
            <h5 class="font-cairo-bold mb-5">أرسل رسالة</h5>

            <form>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="your-name" class="sr-only">الاسم بالكامل</label>
                        <input type="text" class="form-control border-lighten rounded-0" id="your-name" placeholder="الاسم بالكامل">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="your-email" class="sr-only">البريد الإليكتروني</label>
                        <input type="email" class="form-control border-lighten rounded-0" id="your-email" placeholder="البريد الإليكتروني">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="your-location" class="sr-only">الموقع</label>
                        <input type="text" class="form-control border-lighten rounded-0" id="your-location" placeholder="الموقع">
                    </div>
                </div>
                <div class="form-group">
                    <label for="your-message" class="sr-only">الرسالة</label>
                    <textarea class="form-control border-lighten rounded-0" id="your-message" rows="5" placeholder="الرسالة"></textarea>
                </div>
                <button type="submit" class="btn btn-secondary text-white radius px-5 line-height-lg">إرسال</button>
            </form>

        </div><!-- reply -->

    </div><!-- container -->

</main><!-- site-content -->
@endsection