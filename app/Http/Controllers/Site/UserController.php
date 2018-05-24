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
    public function getExperiment(){
        
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
    public function postExperiment(Request $r){
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
    public function getQuestion(){
        $countries  = Country::all();
        $categories = Category::all();
        $data = [
            'countries'  => $countries,
            'categories' => $categories
        ];
        return view("site.question.add" , $data);
    }
    public function postQuestion(Request $r){
        $messages = array(
            "name.required"     => "من فضلك قم بادخال عنوان التجربة",
            "desc.required"     => "من فضلك قم بادخال وصف التجربة",
            "success"           => "تمت العملية بنجاح",
            "cat.required"      => "من فضلك قم باختيار التصنيف الخاص بالتجربة",
            "cat.numeric"       => "التصنيف غير صحيح",
            "cat.exists"        => "التصنيف غير موجود",
        );
        $validator = Validator::make($r->all(), [
            'name'    => 'required',
            'desc'    => "required",
            'cat'     => 'required|numeric|exists:categories,id',
        ] , $messages);
        
        if ($validator->fails()){
            $error = $validator->errors();
            return response()->json(['status' => false ,'errors' => $error]);
        }
        $name    = $r->input("name");
        $desc    = $r->input("desc");
        $cat     = $r->input("cat");
        $question_id = Question::insertGetId([
                    "title"        => $name,
                    "description" => $desc,
                    "category_id" => $cat,  
        ]);
        if($r->hasFile("image")){

            $r->image->store('question', 'public');
            $image_id = DB::table('images')->insertGetId([
                "name" => $r->image->hashName(),
            ]);
            DB::table("question_image")->insert([
                "question_id"  => $question_id,
                "image_id"     => $image_id
            ]);
        }
        $successResponse = [
            'status' => true,
            'msg'    => $messages['success'],
            'time'   => 3000
        ];
        return response()->json($successResponse);
    }
}
