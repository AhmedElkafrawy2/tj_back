<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use Validator;
use App\City;
use App\Experiment;
use App\Question;
use DB;
class HomeController extends Controller
{
    public $sociallinks;
    public $pages;
    public $categories;
    public function __construct(){
        $this->sociallinks = DB::table("settings")->select("*")->get();
        $this->pages       = DB::table("pages")->select("*")->get();
        $this->categories  = DB::table('categories')->select("*")->get();
    }
    public function index(){
        $countries   = Country::all();
        $experiments = DB::table("experiments")
                        ->join("categories" , "experiments.category_id" , "categories.id")
                        ->join("status" , "status.id" , "experiments.status_id")
                        ->join("countries" , "countries.id" , "experiments.country_id")
                        ->join("cities" , "cities.id" , "experiments.city_id")
                        ->orderBy("experiments.created_at" , "desc")
                        ->take(6)
                        ->select("experiments.id" 
                                    , "experiments.title" 
                                    , "experiments.description"
                                    ,"experiments.cost"
                                    ,"status.name AS status"
                                    ,"categories.name AS category"
                                    ,"countries.name AS country"
                                    ,"cities.name AS city")
                        ->get();
        $questions = DB::table("questions")
                            ->orderBy("created_at" , "desc")
                            ->take(6)
                            ->get();
        
        $slider = DB::table('slider')
                    ->select("main_title" 
                             , "sub_title" 
                             , "link"
                             ,DB::raw("CONCAT('". url('/') ."','/storage/app/public/slider/', image) AS image_url"))
                    ->get();
        $data = [
             "countries"   => $countries,
             "experiments" => $experiments,
             "questions"   => $questions,
             "slider"      => $slider,
             "sociallinks" => $this->sociallinks,
             "pages"       => $this->pages,
             "categories"   => $this->categories
        ];
        return view('site.index' , $data);
    }
    
    public function requestCities(Request $r){
        $messages = array(
            "id.required"   => "برجاء ادخال رقم الدولة",
            "id.numeric"    => "رقم الدولة غير صحيح",
            "id.exists"     => "رقم الدولة الذى قمت بادخالة غير موجود",
        );
        $validator = Validator::make($r->all(), [
            'id'          => 'required|numeric|exists:countries,id',
        ] , $messages);
        
        if ($validator->fails()){
            $error = $validator->errors();
            return response()->json(['status' => false ,'errors' => $error]);
        }
        $id = $r->input("id");
        $cities = City::where("country_id",$id)->get();
        return response()->json(['status' => true ,'cities' => $cities]);
    }
    
    public static function get_Exp_Img($id){
        $img = DB::table("images")
                ->join("experiment_image" , "experiment_image.image_id" , "images.id")
                ->where("experiment_image.experiment_id" , $id)
                ->select("images.name")
                ->first();
       //return storage_path('app/public/experiment') . "/" . $img->name;
        return url("/storage/app/public/experiment/") . "/" . $img->name;
    }
    
    
    
    
    
    
    
    
    
    
    
    
}
