<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use Auth;
class CommentController extends Controller
{
    public static function get_comment_replies($id,$count = null){
        $replies = DB::table("comment_replies")
                    ->where("comment_id" , $id)
                    ->join("users" , "users.id" , "comment_replies.user_id")
                    ->select("comment_replies.id AS reply_id"
                             ,"comment_replies.reply AS reply"
                             , "users.name"
                             , "comment_replies.created_at")
                    ->get();
        if($count != null){
            return count($replies);
        }else{
            $date = new \App\Http\Controllers\Site\ExperimentController();
            foreach($replies as $k => $v){
                $reply_create_time = $date->get_time_params($v->created_at);
                $v->created_at     = $reply_create_time;
            }
            return $replies;
        }
    }
    
    public function add_comment(Request $request){
        $messages = array(
            "comment.required"     => "برجاء ادخال نص التعليق",
        );
        $validator = Validator::make($request->all(), [
            'comment'    => 'required',            
        ] , $messages);
        
        if ($validator->fails()){
            $error = $validator->errors();
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $comment = $request->input('comment');
        $id      = $request->input('id');
        $type    = $request->input('type');
        DB::table("comments")
                 ->insert([
                    "comment" => $comment,
                    "user_id" => Auth::id(),
                    "post_id" => $id,
                    "type"    => $type
                 ]);
        if($type == "experiment"){
            $request->session()->flash('success', 'تم اضافة التعليق بنجاح');
        }else{
            $request->session()->flash('success', 'تم اضافة الرد بنجاح');
        }
        
        return redirect()->back()->withInput();
    }
    
    public function add_reply(Request $request){
        $comment = $request->input('comment');
        $id = $request->input('parent_id');
        DB::table("comment_replies")
                ->insert([
                    "reply" => $comment,
                    "user_id" => Auth::id(),
                    "comment_id" => $id
                ]);
        return response()->json(["status" => true , "msg" => "تم اضافة الرد بنجاح"]);
    }
        
    
    
    
}
