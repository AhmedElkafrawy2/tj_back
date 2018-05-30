<footer class="site-footer bg-darkest pt-5">
    <div class="container py-5">
        <div class="row">
            <div class="widget col-12 col-md-4">
                <h1 class="site-title text-center text-md-right">
                    <a href="index.html" class="font-baloo text-white nav-link p-0">تجربتي</a>
                </h1>
                <ul class="nav social pr-0 mt-5 justify-content-center justify-content-md-start">
                	@foreach($sociallinks as $social)
                    <li class="nav-item ml-3">
                        <a href="{{ $social->value }}" class="nav-link text-white bg-pink rounded-circle p-0 text-center">
                            <i class="fa fa-{{ $social->name }}" aria-label="Facebook icon"></i>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div><!-- widget -->
            <div class="widget col-12 col-md-4 mt-md-0 mt-5"><!-- widget -->
                <h6 class="widget-title text-white">روابط سريعة</h6><!-- widget-title -->
                <ul class="hot-links list-unstyled mt-3 pr-0">
                    @foreach($pages as $page)
                    <li>
                        <a href="{{ url('/pages/' . $page->title) }}" class="text-light nav-link pr-0">
                            <i class="fa fa-chevron-left text-pink ml-2"></i>
                            {{ $page->title }}
                        </a>
                    </li>
					@endforeach
                    <li>
                        <a href="category.html" class="text-light nav-link pr-0">
                            <i class="fa fa-chevron-left text-pink ml-2"></i>
                            الأقسام
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/contact-us') }}" class="text-light nav-link pr-0">
                            <i class="fa fa-chevron-left text-pink ml-2"></i>
                            اتصل بنا
                        </a>
                    </li>
                </ul><!-- hot-links -->
            </div><!-- widget -->
            <div class="widget col-12 col-md-4 mt-md-0 mt-5">
                <h6 class="widget-title text-white">القائمة البريدية</h6>
                <form class="form-inline subscribe-form mt-4 pt-1">
                    <div class="input-group w-100">
                        <div class="input-group-prepend order-1">
                            <button class="submit-button btn btn-pink text-white px-4 py-2 border-trans border-right-0"
                                    type="button">إرسال</button>
                        </div>
                        <input type="email"
                               class="form-control border-trans text-right submit-field py-2"
                               placeholder="البريد الإليكتروني"
                               aria-label="البريد الإليكتروني"
                               aria-describedby="basic-addon1">

                    </div>
                    <p class="text-light mt-3 form-notice line-height-lg">
                        نخن لا نقوم بإرسال رسائل ترويجية ولا نقوم بتسليم البيانات لجهة أخرى
                    </p>
                </form>
            </div><!-- widget -->
        </div><!-- row -->
    </div><!-- container -->
    <div class="bottom-bar bg-darken py-1">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 d-flex justify-content-md-start justify-content-center align-items-center">
                    <p class="copyright text-light m-0">
                        جميع الحقوق محفوظة لموقع تجربتي <i class="fa fa-copyright fa-fw"></i> 2018
                    </p>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-md-end justify-content-center">
                    <ul class="nav pr-0 mt-3 mt-md-auto">
                        <li class="nav-item">
                            <a href="index.html"
                               class="nav-link text-light">
                                سياسة الخصوصية
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="experience.html"
                               class="nav-link text-light position-relative">
                                الشروط والأحكام
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.html"
                               class="nav-link text-light">
                                اتصل بنا
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- bottom-bar -->
</footer><!-- site-footer -->