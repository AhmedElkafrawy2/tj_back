<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Country;
use App\Status;
use App\Category;
use App\Experiment;
use App\Question;
use Validator;
use File;
use DB;
use Illuminate\Support\Facades\Storage;
class ExperimentController extends Controller
{
    public function __construct(){
//         $this->middleware('auth');
    }
    public function getAddExperiment(){
        
        $countries = Country::all();
        $status    = Status::all();
        $categories= Category::all();
        $data = [
            'countries' => $countries,
            'status'    => $status,
            'categories'=> $categories
        ];
        return view('site.experiment.add',$data);
    }
    public function postAddExperiment(Request $r){
        $messages = array(
            "name.required"     => "من فضلك قم بادخال عنوان التجربة",
            "desc.required"     => "من فضلك قم بادخال وصف التجربة",
            "cat.required"      => "من فضلك قم باختيار التصنيف الخاص بالتجربة",
            "cat.numeric"       => "التصنيف غير صحيح",
            "cat.exists"        => "التصنيف غير موجود",
            "status.required"   => "من فضلك قم باختيار حالة التجربة",
            "status.numeric"    => "حالة التجربة غير صحيحة",
            "status.exists"     => "حالة التجربة غير موجودة",
            "date.required"     => "من فضلك قم بادخال تاريخ التجربة",
            "cost.required"     => "تكلفة التجربة مطلوبة",
            "cost.numeric"      =>"التكلفة غير صحيحة",
            "country.required"  => "من فضلك قم باختيار الدولة",
            "country.numeric"   => "الدولة غير صحيحة",
            "country.exists"    => "الدولة غير موجودة",
            "city.required"     => "من فضلك قم باختيار المدينة",
            "city.numeric"      => "المدينة غير صحيحة",
            "city.exists"       => "المدينة غير موجودة",
            "number.required"   => "من فضلك قم بادخال صور التجربة",
            "success"           => "تمت العملية بنجاح"
            
        );
        $validator = Validator::make($r->all(), [
            'name'    => 'required',
            'desc'    => "required",
            'cat'     => 'required|numeric|exists:categories,id',
            'status'  => 'required|numeric|exists:status,id',
            'date'    => 'required',
            'cost'    => 'required|numeric',
            'country' => "required|numeric|exists:countries,id",
            'city'    => "required|numeric|exists:cities,id",
            'number'  => "required"
            
        ] , $messages);
        
        if ($validator->fails()){
            $error = $validator->errors();
            return response()->json(['status' => false ,'errors' => $error]);
        }
        $name    = $r->input("name");
        $desc    = $r->input("desc");
        $cat     = $r->input("cat");
        $status  = $r->input("status");
        $date    = $r->input("date");
        $cost    = $r->input("cost");
        $country = $r->input("country");
        $city    = $r->input("city");
        $number  = $r->input("number");
        $exp_id = Experiment::insertGetId([
            "title"       => $name,
            "description" => $desc,
            "status_id"   => $status,
            "cost"        => $cost,
            "country_id"  => $country,
            "city_id"     => $city,
            "category_id" => $cat,            
        ]);
        if($r->hasFile("0")){
            for($i = 0; $i <= $number ; $i++){
                $r->$i->store('experiment', 'public');
                $image_id = DB::table('images')->insertGetId([
                    "name" => $r->$i->hashName(),
                ]);
                DB::table("experiment_image")->insert([
                   "experiment_id" => $exp_id,
                    "image_id"     => $image_id
                ]);
           }
        }
        $successResponse = [
                    'status' => true,
                    'msg'    => $messages['success'],
                    'time'   => 3000
        ];
        return response()->json($successResponse);
    }
    
    public function get_all_experiments(){
        $countries   = Country::all();
        $experiments = DB::table("experiments")
        ->join("categories" , "experiments.category_id" , "categories.id")
        ->join("status" , "status.id" , "experiments.status_id")
        ->join("countries" , "countries.id" , "experiments.country_id")
        ->join("cities" , "cities.id" , "experiments.city_id")
        ->orderBy("experiments.created_at" , "desc")
        ->select("experiments.id"
            , "experiments.title"
            , "experiments.description"
            ,"experiments.cost"
            ,"status.name AS status"
            ,"categories.name AS category"
            ,"countries.name AS country"
            ,"cities.name AS city")
            ->get();
        $data = [
            'countries'    => $countries,
            'experiments'  => $experiments
        ];
        return view('site.experiment.all',$data);
    }
    
    public function get_certain_experiment($id){
        
        $countries  = Country::all();
        $experiment = DB::table("experiments")
                    ->join("categories" , "experiments.category_id" , "categories.id")
                    ->join("status" , "status.id" , "experiments.status_id")
                    ->join("countries" , "countries.id" , "experiments.country_id")
                    ->join("experiment_image" , "experiment_image.experiment_id" , "experiments.id")
                    ->join("images" , "images.id" , "experiment_image.image_id")
                    ->join("cities" , "cities.id" , "experiments.city_id")
                    ->orderBy("experiments.created_at" , "desc")
                    ->where("experiments.id" , $id)
                    ->select("experiments.id"
                        ,"experiments.title"
                        ,"experiments.description"
                        ,"experiments.cost"
                        ,"status.name AS status"
                        ,"categories.name AS category"
                        ,"countries.name AS country"
                        ,"cities.name AS city"
                        ,"images.name AS image_url"
                        ,DB::raw("DATE(experiments.created_at) AS created_at"))
                        ->first();
        return response()->json([$experiment]);
        $exp_create_time = $this->get_time_params($experiment->created_at);
        $experiment->created_at = $exp_create_time;
        
        $replies    = DB::table("experiment_replies")
                        ->leftjoin("images" , "images.id" , "experiment_replies.image_id")
                        ->where("experiment_replies.experiment_id" , $id)
                        ->select("experiment_replies.id"
                                , "experiment_replies.description"
                                , DB::raw("CONCAT('". url('/') ."','/storage/app/public/experiment/', images.name) AS image_url")
                                ,DB::raw("DATE(experiment_replies.created_at) AS created_at"))
                                ->get();
    
        foreach($replies as $k => $v){
            $rep_create_time = $this->get_time_params($v->created_at);
            $v->created_at = $rep_create_time;
        }
        
        $comments = DB::table("comments")
                    ->where("post_id" , $id)
                    ->join("users" , "users.id" , "comments.user_id")
                    ->where("comments.type" , "experiment")
                    ->select("comments.id AS comment_id"
                              ,"comments.comment"
                              ,DB::raw("DATE(comments.created_at) AS created_at")
                              , "users.name")
                    ->get();
        
        foreach($comments as $k => $v){
            $comment_create_time = $this->get_time_params($v->created_at);
            $v->created_at = $comment_create_time;
        }
        
        $data = [
            "experiment" => $experiment,
            "countries"  => $countries,
            "replies"    => $replies,
            "comments"   => $comments
        ];
        return view('site.experiment.experiment',$data);
    }
    
    public function postAddReply(Request $request){
        $messages = array(
            "reply.required"     => "من فضلك قم بادخال نص التحديث",
            "replyImage.mimes"   => "الصورة غير صحيحة"
        );
        $validator = Validator::make($request->all(), [
            'reply'       => 'required',
            'replyImage'  => 'mimes:jpeg,jpg,png'
            
        ] , $messages);
        
        if ($validator->fails()){
            $error = $validator->errors()->first();
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $reply  = $request->input("reply");
        $exp_id = $request->input("exp_id");
        $image_id = null;
        if($request->hasFile('replyImage')){
            
            $request->replyImage->store('experiment', 'public');
            $image_id = DB::table('images')->insertGetId([
                "name" => $request->replyImage->hashName(),
            ]);
        }
        
        DB::table("experiment_replies")
            ->insert([
                "description"   => $reply,
                "experiment_id" => $exp_id,
                "image_id"      => $image_id
            ]);
        
        $request->session()->flash('success', 'تم تحديث التجربة بنجاح');
        return redirect()->back()->withInput();
    }
    public function get_time_params($data){
        $time = strtotime($data);
        $newformat = date('d',$time);
        $postdate_d = date('d' , $time);
        $postdate_d2 = date('D', $time);
        $postdate_m = date('M' , $time);
        $postdate_y = date('Y' , $time);
        return $this->single_post_arabic_date($postdate_d,$postdate_d2, $postdate_m, $postdate_y);
    }
    public function single_post_arabic_date($postdate_d,$postdate_d2,$postdate_m,$postdate_y) {
        $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
        $en_month = $postdate_m;
        foreach ($months as $en => $ar) {
            if ($en == $en_month) { $ar_month = $ar; }
        }
        
        $find = array ("Sat", "Sun", "Mon", "Tue", "Wed" , "Thu", "Fri");
        $replace = array ("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        $ar_day_format = $postdate_d2;
        $ar_day = str_replace($find, $replace, $ar_day_format);
        
        header('Content-Type: text/html; charset=utf-8');
        $standard = array("0","1","2","3","4","5","6","7","8","9");
        $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
        $post_date = $postdate_d.' '.$ar_month.' '.$postdate_y;
        $arabic_date = str_replace($standard , $eastern_arabic_symbols , $post_date);
        
        return $arabic_date;
    }
}
