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
class QuestionController extends Controller
{
    public function __construct(){
//         $this->middleware('auth');
    }
    public function get_all_questions(){
        $countries   = Country::all();
        $questions = DB::table("questions")
        ->join("categories" , "questions.category_id" , "categories.id")
        ->orderBy("questions.created_at" , "desc")
        ->select("questions.id"
            , "questions.title"
            , "questions.description"
            ,"categories.name AS category")
            ->paginate(6);

        $data = [
            'countries'    => $countries,
            'questions'    => $questions
        ];
        return view('site.question.all',$data);
    }
    
    public function get_certain_question($id){
        
        $countries  = Country::all();
        $question  = DB::table("questions")
                    ->join("categories" , "questions.category_id" , "categories.id")
                    ->orderBy("questions.created_at" , "desc")
                    ->join("users" , "users.id" , "questions.user_id")
                    ->where("questions.id" , $id)
                    ->select(
                        "questions.id AS id"
                        ,"questions.title"
                        ,"questions.description"
                        ,"categories.name AS category"
                        ,"users.id AS user_id"
                        ,DB::raw("CONCAT('". url('/') ."','/storage/app/public/question/', questions.image) AS image_url")
                        ,DB::raw("DATE(questions.created_at) AS created_at"))
                        ->first();
       
        $timeformate  = new \App\Http\Controllers\Site\ExperimentController();
        $que_create_time = $timeformate->get_time_params($question->created_at);
        $question->created_at = $que_create_time;
        
        $comments = DB::table("comments")
                    ->where("post_id" , $id)
                    ->join("users" , "users.id" , "comments.user_id")
                    ->where("comments.type" , "question")
                    ->select("comments.id AS comment_id"
                              ,"comments.comment"
                              ,DB::raw("DATE(comments.created_at) AS created_at")
                              ,"users.name")
                    ->get();
        
        foreach($comments as $k => $v){
            $comment_create_time = $timeformate->get_time_params($v->created_at);
            $v->created_at = $comment_create_time;
        }
        
       
        $data = [
            "question"   => $question,
            "countries"  => $countries,
            "comments"   => $comments
        ];
        return view('site.question.question',$data);
    }
    
    public function add_question_answer(Request $request){
        
    }
}
