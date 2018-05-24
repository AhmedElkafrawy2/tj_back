<ul class="skip-links list-unstyled m-0 p-0">
    <li><a href="#primary-navigation" class="sr-only">تخطي للقائمة الرئيسية</a></li>
    <li><a href="#page-content" class="sr-only">تخطي للمحتوى</a></li>
</ul>
<!-- Start coding... -->
<header class="site-header">
    <div class="top-bar bg-pink py-2">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 d-flex justify-content-md-start justify-content-center">
                    <div class="top-right">
                        <ul class="nav social pr-0">
                            <li class="nav-item">
                                <a href="https://facebook.com" class="nav-link text-white px-1">
                                    <i class="fa fa-facebook fa-fw"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="https://twitter.com" class="nav-link text-white px-1">
                                    <i class="fa fa-twitter fa-fw"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="https://google.com" class="nav-link text-white px-1">
                                    <i class="fa fa-google-plus fa-fw"></i>
                                </a>
                            </li>
                        </ul>
                    </div><!-- top-right -->
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-md-end justify-content-center">
                    <div class="top-left">
                        <!-- Button trigger modal -->
                        <ul class="nav pr-0">
                        	@if(auth()->user())
                                <li class="nav-item">
                                    <a href="{{ url('/add/experiment') }}"
                                       class="nav-link text-white">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        اضافة تجربة
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/add/question') }}"
                                       class="nav-link text-white">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        اضافة سؤال
                                    </a>
                                </li>
                                <li class="nav-item">	
                                    <div class="dropdown">
                                        <a href="experience.html"
                                           id="experience"
                                           class="menu-name nav-item nav-link  dropdown-toggle"
                                           aria-haspopup="true"
                                           aria-expanded="false"
                                           data-toggle="dropdown">{{ auth()->user()->name }}</a>
                                        <div class="dropdown-menu text-right" aria-labelledby="experience">
  											<a href="{{ url('/user/logout') }}" 
  											   class="dropdown-item">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                                تسجيل الخروج
                                    		</a>
                                        </div>
                                    </div>
                                </li>
                            @else    
                               <li class="nav-item">
                                    <a href="#"
                                       class="nav-link text-white"
                                       data-toggle="modal"
                                       data-target="#login-form">
                                        <i class="fa fa-user fa-fw" aria-hidden="true"></i>
                                        تسجيل الدخول
                                    </a>
                                </li>
    
                                <li class="nav-item">
                                    <a href="#"
                                       class="nav-link text-white"
                                       data-toggle="modal"
                                       data-target="#register-form">
                                        <i class="fa fa-lock fa-fw" aria-hidden="true"></i>
                                        حساب جديد
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div><!-- top-left -->
                </div>
            </div>
        </div><!-- container -->
    </div><!-- top-bar -->


    <nav id="primary-navigation" class="primary-navigation navbar navbar-expand-md font-weight-bold py-3">
        <div class="container">
            <a href="index.html" class="navbar-brand text-dark mr-0 pt-0">
                <h1 class="site-title mt-0 font-baloo">تجربتي</h1>
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbar-collapse"
                    aria-controls="navbar-collapse"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <i class="fa fa-bars fa-fw fa-lg"></i>
            </button>

            <div id="navbar-collapse" class="collapse navbar-collapse">
                <div class="navbar-nav mr-sm-auto position-relative">
                    <a href="index.html" class="nav-item nav-link text-pink active">الرئيسية</a>
                    <a href="page.html" class="nav-item nav-link">من نحن</a>

                    <div class="dropdown">
                        <a href="experience.html"
                           id="experience"
                           class="nav-item nav-link  dropdown-toggle"
                           aria-haspopup="true"
                           aria-expanded="false"
                           data-toggle="dropdown">أحدث التجارب</a>
                        <div class="dropdown-menu text-right" aria-labelledby="experience">
                            <a href="experience.html" class="dropdown-item active bg-pink">عنصر أول</a>
                            <a href="experience.html" class="dropdown-item">عنصر ثاني</a>
                            <a href="experience.html" class="dropdown-item">عنصر ثالث</a>
                        </div>
                    </div>

                    <a href="question.html" class="nav-item nav-link ">الأسئلة</a>
                    <a href="category.html" class="nav-item nav-link ">الأقسام</a>
                    <a href="contact.html" class="nav-item nav-link ">اتصل بنا</a>
                    <a href="#" id="search-trigger" class="nav-item nav-link  search-trigger">
                        <i class="fa fa-search fa-fw"></i>
                    </a>
                    <form id="search-form" class="form-inline search-form">
                        <div class="input-group">
                            <input type="text"
                                   class="form-control border-lighten"
                                   placeholder="بحث...">
                            <button class="btn btn-pink mr-1" type="submit">
                                <i class="fa fa-search fa-fw text-white" aria-label="Search"></i>
                            </button>
                        </div><!-- input-group -->
                    </form><!-- form-inline -->
                </div><!-- navbar-nav -->
            </div><!-- navbar-collapse -->
        </div><!-- container -->
    </nav><!-- primary-navigation -->
</header><!-- site-header -->