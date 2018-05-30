<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use App\Status;
use App\Category;
use App\Experiment;
use App\Question;
use Validator;
use File;
use DB;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public $sociallinks;
    public $pages;
    public $categories;
    public function __construct(){

        $this->sociallinks = DB::table("settings")->select("*")->get();
        $this->pages       = DB::table("pages")->select("*")->get();
        $this->categories  = DB::table('categories')->select("*")->get();
    }

    public function get_category($name){
        $countries = Country::all();
        $cat       = DB::table("categories")
                        ->where("name" , $name)
                        ->select("*")
                        ->first();
        
        if(!$cat){
            return redirect()->url("/");
        }
        
        $experiments = DB::table("experiments")
        ->join("categories" , "experiments.category_id" , "categories.id")
        ->join("status" , "status.id" , "experiments.status_id")
        ->join("countries" , "countries.id" , "experiments.country_id")
        ->join("cities" , "cities.id" , "experiments.city_id")
        ->where("categories.id" , $cat->id)
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
                    ->join("categories" , "categories.id" , "questions.category_id")
                    ->where("categories.id" , $cat->id)
                    ->orderBy("questions.created_at" , "desc")
                    ->take(6)
                    ->get();
        
        $data = [
            "countries"   => $countries,
            "cat"         => $cat,
            "experiments" => $experiments,
            "questions"   => $questions,
            "sociallinks" => $this->sociallinks,
            "pages"       => $this->pages,
            "categories"  => $this->categories
        ];
        return view("site.categories.category" , $data);
    }
    
    public function get_page($title){
        
        $countries = Country::all();
        $page = DB::table("pages")
                    ->where("pages.title" , $title)
                    ->select("*")
                    ->first();

        if(!$page){
            return redirect()->url("/");
        }
        $data = [
            "countries"   => $countries,
            "page"        => $page,
            "sociallinks" => $this->sociallinks,
            "pages"       => $this->pages,       
            "categories"  => $this->categories
        ];
        return view("site.pages.page" , $data);
    }
    
    public function get_contact_us(){
        $countries = Country::all();
        $data = [
            "countries"   => $countries,
            "sociallinks" => $this->sociallinks,
            "pages"       => $this->pages,
            "categories"  => $this->categories
        ];
        return view('site.pages.contact',$data);
    }
    
    public function get_all_categories_exp($name){
        $countries = Country::all();
        $cat       = DB::table("categories")
        ->where("name" , $name)
        ->select("*")
        ->first();
        
        if(!$cat){
            return redirect()->url("/");
        }
        
        $experiments = DB::table("experiments")
        ->join("categories" , "experiments.category_id" , "categories.id")
        ->join("status" , "status.id" , "experiments.status_id")
        ->join("countries" , "countries.id" , "experiments.country_id")
        ->join("cities" , "cities.id" , "experiments.city_id")
        ->where("experiments.category_id" , $cat->id)
        ->orderBy("experiments.created_at" , "desc")
        ->select("experiments.id"
            , "experiments.title"
            , "experiments.description"
            ,"experiments.cost"
            ,"status.name AS status"
            ,"categories.name AS category"
            ,"countries.name AS country"
            ,"cities.name AS city")
            ->paginate(6);
            
            $data = [
                'countries'    => $countries,
                'experiments'  => $experiments,
                'cat'          => $cat,
                "sociallinks"  => $this->sociallinks,
                "pages"        => $this->pages,
                "categories"   => $this->categories
            ];
            return view('site.categories.experiment',$data);
        
    }
    
    public function get_all_categories_questions($name){
        $countries = Country::all();
        $cat       = DB::table("categories")
        ->where("name" , $name)
        ->select("*")
        ->first();
        
        if(!$cat){
            return redirect()->url("/");
        }
        
        $questions = DB::table("questions")
        ->join("categories" , "questions.category_id" , "categories.id")
        ->where("categories.id" , $cat->id)
        ->orderBy("questions.created_at" , "desc")
        ->select("questions.id"
            , "questions.title"
            , "questions.description"
            ,"categories.name AS category")
            ->paginate(6);
            
        $data = [
                'countries'    => $countries,
                'questions'    => $questions,
                'cat'          => $cat,
                'sociallinks'  => $this->sociallinks,
                'pages'        => $this->pages,
                "categories"   => $this->categories
               ];
        return view('site.categories.questions',$data);
    }
    public function post_contact_us(Request $request){
        
    }
}









