<!-- Modal -->
<div class="modal fade"
     id="login-form"
     tabindex="-1"
     role="dialog"
     aria-labelledby="login-form"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-bottom-0 bg-pink text-white px-4">
                <h5 class="modal-title" id="login-form-title">الدخول</h5>
            </div>
            <div class="modal-body px-4">
                <form method="POST" data-action = "{{ url('/user/login') }}" class="pt-3 login-form">
                    {{ csrf_field() }}
                    <div class="alert alert-danger login-errors">
                    	<ul></ul>
                    </div>
                    <div class="form-group">
                        <label for="login-tel" class="sr-only">رقم الهاتف</label>
                        <input type="tel"
                               class="form-control h-auto rounded-0 border-lighten"
                               id="login-tel"
                               name="phone"
                               placeholder="رقم الهاتف">
                    </div>
                    <div class="form-group">
                        <label for="login-password" class="sr-only">كلمة السر</label>
                        <input type="password"
                               class="form-control h-auto rounded-0 border-lighten"
                               id="login-password"
                               name="password"
                               placeholder="كلمة السر">
                    </div>
                </form>
            </div>
            <div class="modal-footer flex-column border-top-0 px-4">
                <button type="submit"
                        class="login-btn btn btn-outline-pink radius btn-block line-height-lg">تسجيل الدخول</button>
                <ul class="nav justify-content-between px-0 mx-0 w-100 mt-3">
                    <li class="nav-item">
                        <a href="#"
                           class="nav-link"
                           data-toggle="modal"
                           data-dismiss="modal"
                           data-target="#recover-form">نسيت كلمة السر؟</a>
                    </li>
                    <li class="nav-item">
                        <a href="#"
                           class="nav-link"
                           data-toggle="modal"
                           data-dismiss="modal"
                           data-target="#register-form">ليس لدي حساب</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><!-- modal -->
<div class="modal fade"
     id="recover-form"
     tabindex="-1"
     role="dialog"
     aria-labelledby="recover-form"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-bottom-0 bg-pink text-white px-4">
                <h5 class="modal-title" id="recover-form-title">إستعادة كلمة المرور</h5>
            </div>
            <div class="modal-body px-4">
                <form class="pt-3">
                    <div class="form-group">
                        <label for="login-tel" class="sr-only">رقم الهاتف</label>
                        <input type="tel"
                               class="form-control h-auto rounded-0 border-lighten"
                               id="recover-tel"
                               placeholder="رقم الهاتف">
                    </div>
                </form>
            </div>
            <div class="modal-footer flex-column border-top-0 px-4">
                <button type="submit"
                        class="btn btn-outline-pink radius btn-block line-height-lg"
                        data-dismiss="modal">إرسال</button>
            </div>
        </div>
    </div>
</div><!-- modal -->
<div class="modal fade"
     id="register-form"
     tabindex="-1"
     role="dialog"
     aria-labelledby="register-form"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-bottom-0 bg-pink text-white px-4">
                <h5 class="modal-title" id="register-form-title">التسجيل</h5>
            </div>
            <div class="modal-body px-4">
                <form   method="POST" 
                		data-action = "{{ url('/user/register') }}" 
                		class="register-form pt-3">
                	{{ csrf_field() }}
                	<div class="alert alert-danger register-errors">
                		<ul></ul>
                	</div>
                    <div class="form-group">
                        <label for="name" class="sr-only">الاسم بالكامل</label>
                        <input type="text"
                               class="form-control h-auto rounded-0 border-lighten"
                               id="name"
                               name="name"
                               placeholder="الاسم بالكامل">
                    </div>
                    <div class="form-group">
                        <label for="tel" class="sr-only">رقم الهاتف</label>
                        <input type="tel"
                               class="form-control h-auto rounded-0 border-lighten"
                               id="tel"
                               name="tel"
                               placeholder="رقم الهاتف">
                    </div>
                    <div class="form-group">
                        <label for="gender" class="sr-only">الجنس</label>
                        <select class="custom-select rounded-0 border-lighten py-0 text-light" 
                        		id="gender"
                        		name="gender">
                            <option value="" selected>الجنس</option>
                            <option value="male">ذكر</option>
                            <option value="female">انثى</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="age" class="sr-only">العمر</label>
                        <input type="text"
                               class="custom-select form-control h-auto rounded-0 border-lighten"
                               id="age"
                               name="age"
                               placeholder="العمر">
                    </div>
                    <div class="form-group">
                        <label for="country" class="sr-only">الدولة</label>
                        <select class="custom-select rounded-0 border-lighten py-0 text-light" 
                        		id="country"
                        		data-action = "{{ url('/request/getcities') }}"
                        		name="country">
                            <option value="" selected>الدولة</option>
                                @foreach($countries as $country )
                                	<option value={{ $country->id }}>{{ $country->name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city" class="sr-only">المدينة</label>
                        <select class="custom-select rounded-0 border-lighten py-0 text-light" 
                        		id="city"
                        		name="city">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">كلمة السر</label>
                        <input type="password"
                               class="form-control h-auto rounded-0 border-lighten"
                               id="password"
                               name="password"
                               placeholder="كلمة السر">
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="sr-only">تأكيد كلمة السر</label>
                        <input type="password"
                               class="form-control h-auto rounded-0 border-lighten"
                               id="password-confirm"
                               name="password_confirmation"
                               placeholder="تأكيد كلمة السر">
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0 px-4">
                <button type="submit"
                        class="register-btn-ajax btn btn-outline-pink radius btn-block line-height-lg"
                        >تسجيل</button>
            </div>
        </div>
    </div>
</div><!-- modal -->

<!-- Notify Modal -->
<div class="modal fade"
     id="notify-form"
     tabindex="-1"
     role="dialog"
     aria-labelledby="notify-form"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div id="notify-modal-section" class="modal-content border-0">
            <div class="modal-body px-4">
            </div>
            <div class="notify-modal-content modal-footer flex-column border-top-0 px-4">
            	
            </div>
        </div>
    </div>
</div><!-- End Notify modal -->

<!-- Info Modal -->
<div class="modal fade"
     id="info-form"
     tabindex="-1"
     role="dialog"
     aria-labelledby="notify-form"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div id="info-modal-section" class="modal-content border-0">
            <div class="modal-body px-4">
            </div>
            <div class="info-modal-content modal-footer flex-column border-top-0 px-4">
            	
            </div>
            <div class="info-modal-footer">
            	<Button data-dismiss="modal" class="btn btn-default">رجوع</Button>
            </div>
        </div>
    </div>
</div><!-- End Notify modal -->



