<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Middleware\LoginAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HospitalEmailController extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->middleware(LoginAuth::class, ['only' => ['hospitalEmail', 'addHospitalEmail']]);
    }
    public function deleteHospitalEmail(Request $request, $id)
    {
        DB::table("hospital_email")->where("hospital_id" ,Session::get('user')->id)->where("id",$id)->delete();

        return response()->json(["success" => "Record has deleted.", "code" => 200, "message" => "Record has deleted."]);
    }


    public function addHospitalEmail(Request $request)
    {
        if ($request->isMethod("post")) {
            $param_rules['email'] = 'required|email|unique:hospital_email,email';
            $response = $this->__validateRequestParams($request->all(), $param_rules);

            if ($response['code'] != 200) {

                return back()->withInput($request->all())->withErrors($response);
            } else {
                DB::table("hospital_email")->insert(["hospital_id" => Session::get('user')->id, "email" => $request->email]);
            }

            return redirect(url('user/hospital-email'))->with(["success" => "Record has inserted.", "code" => 200, "message" => "Record has inserted."]);

        }


        return view("user.hospital_email.add", []);
    }


    public function hospitalEmail(Request $request)
    {
        $records = DB::table("hospital_email")->where("hospital_id" ,Session::get('user')->id)->paginate(20);
        return view("user.hospital_email.index", compact("records"));
    }
}


