<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LoginAuth;
use App\Models\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HospitalNewsController extends Controller
{

    function __construct(){

        parent::__construct();
        $this->middleware(LoginAuth::class, ['only' => ['index' , 'add' , 'delete']]);
    }

    /**
     * Add user Availablity
     * 
     */
    public function index(Request $request){

        $records = News::whereIn("hospital_id" ,[0,Session::get('user')->hospital_id])->whereNull("deleted_at")->orderBy("created_at","DESC")->paginate(20);
        $this->__is_paginate = false;
        $this->__is_collection = false;

        return view("user.news.index", compact("records"));

    }

    public function add (Request $request){
        if ($request->isMethod("post")) {
            $param_rules['news_title'] = 'required';
            $param_rules['news_description'] = 'required';
            $response = $this->__validateRequestParams($request->all(), $param_rules);

            if ($response['code'] != 200) {

                return back()->withInput($request->all())->withErrors($response);
            } else {
                $fileUrl = NULL;
                if($request->hasFile("news_image")){
                    $fileUrl = Storage::disk("public")->putFile("news_images",$request->news_image);
                }
                $id= News::insertGetId([
                    "hospital_id" => Session::get('user')->hospital_id, 
                    "news_title" => $request->news_title,
                    "news_description" => $request->news_description,
                    "news_image" => $fileUrl,
                ]);

                $users = User::where("hospital_id",Session::get('user')->hospital_id)->where("user_type","physician")->whereIn("device_type",["ios","android"])->whereNotNull("device_token")->whereNull("deleted_at")->orderBy("id","DESC")->get();
                if (!empty($users)) {
                    foreach($users as $target){
                        $notification_data = [
                            'target' => $target,
                            'title' => "News Alert",
                            'message' => $request->news_description,
                            'reference_id' => $id,
                            'reference_module' => "news",
                            'redirect_link' => NULL,
                        ];
                        $custom_data = [
                            'target_id' => $target->id,
                            'actor_id' => 0,
                            "news_id" => $id,
                            "hospital_id" => Session::get('user')->hospital_id,
                            'identifier' => 'news_alert'
                        ];
    
                        Notification::sendPushNotification('news_alert', $notification_data, $custom_data,false,$target->device_type);
                    }
                }

            return redirect(url('user/hospital-news'))->with(["success" => "Record has inserted.", "code" => 200, "message" => "Record has inserted."]);
            }
        }

        return view("user.news.add", []);

    }

    public function delete ($id){
        DB::table("news")->where("hospital_id" ,Session::get('user')->hospital_id)->where("id",$id)->delete();

        return response()->json(["success" => "Record has deleted.", "code" => 200, "message" => "Record has deleted."]);
    }


    public function getList(Request $request){
        $records = News::where("hospital_id" ,Session::get('user')->hospital_id)->whereNull("deleted_at")->orderBy("created_at","DESC")->paginate(20);
        $this->__is_paginate = true;
        $this->__is_collection = false;

        return $this->__sendResponse('News', $User, 200, 'User retrieved successfully.');
    }
}
