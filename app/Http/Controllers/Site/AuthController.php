<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use Auth;
use Hash;
class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest', ['except' => 'Logout']);
    }
    public function register(Request $request){

        $messages = array(
            "name.required"           => "برجاء ادخال الاسم بالكامل",
            "phone.required"          => "برجاء ادخال رقم الهاتف",
            "phone.numeric"           => "رقم الهاتف غير صحيح",
            "phone.unique"            => "رقم الهاتف مستخدم من قبل برجاء اختيار رقم اخر",
            "gender.required"         => "برجاء اختيار النوع",
            "gender.in"               => "خطأ فى اختيار النوع برجاء المحاولة مرة اخرى",
            "age.required"            => "برجاء ادخال العمر",
            "age.numeric"             => "خطأ فى ادخال العمر برجاء المحاولة مرة اخرى",
            "country.required"        => "برجاء اختيار الدولة",
            "country.exists"          => "خطأ فى اختيار الدولة برجاء المحاولة مرة اخرى",
            "city.required"           => "برجاء اختيار المدينة",
            "city.exists"             => "خطأ فى اختيار المدينة برجاء الاختيار مرة اخرى",
            "password.required"       => "برجاء ادخال الرقم السرى",
            "password.min"            => "الحد الادنى للرقم السرى ستة رموز",
            "password.confirmed"      => "لم يتم تأكيد الرقم السرى",
            "success"                 => "تم تسجيل الدخول بنجاح برجاء الانتظار وسوف يتم تحويلك الان",
            "error"                   => "حدث خطأ برجاء المحاولة لاحقا"
        );
        $validator = Validator::make($request->all(), [
            'name'           => 'required',
            'phone'          => 'required|numeric|unique:users,phone',
            'gender'         => 'required|in:male,female',
            'age'            => 'required|numeric',
            "country"        => 'required|exists:countries,id',
            "city"           => 'required|exists:cities,id',
            'password'       => 'required|min:6|confirmed',
        ] , $messages);
        
        if ($validator->fails()){
            $error = $validator->errors();
            return response()->json(['status' => false ,'errors' => $error]);
        }
        
        // INSERT USER DATA
        $name           = $request->input("name");
        $phone          = $request->input("phone");
        $password       = bcrypt($request->input("password"));
        $gender         = $request->input("gender");
        $age            = $request->input("age");
        $country        = $request->input("country");
        $city           = $request->input("city");
        try {
            $user = User::create([
                "name"          => $name,
                "phone"         => $phone,
                "password"      => $password,
                'gender'        => $gender,
                'age'           => $age,
                'country_id'    => $country,
                'city_id'       => $city
            ]);
            Auth::login($user);
            $messagesArr = ['status' => true, 
                            'msg'    => $messages['success'],
                            'time'   => 3000       
                            ];
            return response()->json($messagesArr);
        } catch (Exception $ex) {
            return response()->json($messagesArr);
        }
    }
    
    // login user function
    public function login(Request $request){
        $messages = array(
            "phone.required"          => "برجاء ادخال رقم الهاتف",
            "phone.numeric"           => "رقم الهاتف غير صحيح",
            "phone.exists"            => "رقم الهاتف الذى قمت بادخالة غير موجود",
            "password.required"       => "برجاء ادخال الرقم السرى",
            "success"                 => "تم تسجيل الدخول بنجاح برجاء الانتظار وسوف يتم تحويلك الان",
            "error"                   => "خطأ فى رقم الهاتف او كلمة المرور"   
        );
        $validator = Validator::make($request->all(), [
            'phone'          => 'required|numeric|exists:users,phone',
            'password'       => 'required',
        ] , $messages);
        
        if ($validator->fails()){
            $error = $validator->errors();
            return response()->json(['status' => false ,'errors' => $error]);
        }
        
        $phone    = $request->input('phone');
        $password = $request->input('password');
        $user= User::where('phone' , $phone)->first();
        if(Hash::check($password, $user->password) ){
            Auth::login($user);
            $messagesArr = [
                    'status' => true,
                    'msg'    => $messages['success'],
                    'time'   => 3000
            ];
            return response()->json($messagesArr);
        }else{
            return response()->json(['status' => false ,'msg' => $messages['error']]);
        }
    }
    public function Logout(){
        Auth::logout();
        return redirect('/');
    }   
}

