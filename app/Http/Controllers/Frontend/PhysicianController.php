<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Middleware\LoginAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PhysicianController extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->middleware(LoginAuth::class, ['only' => ['physiciansListing']]);
    }
    public function physiciansListing(Request $request)
    {
        $user = $this->__getSession('user');
        if ($user->id == null) {
            return redirect()->route('nameOfMyRoute', []);
        }

        $user = $this->__getSession('user');
        $hospital = \DB::table("hospital")->where("user_id",$user->id)->first();
        $physiciansListing = DB::table("user")->select("hospital.name","user.*")
            ->leftJoin("hospital","hospital.user_id","=","user.id")
            ->where("user.hospital_id",$hospital->id)->paginate(20);
        $total_user = DB::table("user")->selectRaw("COUNT(*) as total_user")->where("hospital_id" ,$hospital->id)->groupBy("hospital_id")->first();

        $posting_data = array();
        if ($request->session()->has('posting_data')) {
            $posting_data = Session::get('posting_data');
            Session::forget('posting_data');
            $request->session()->forget('posting_data');
        }

        return view('user.physicians-listing.physicians-listing',
            [
                "total_user" => $total_user,
                "post_data" => $posting_data,
                "hospital" => $hospital,
                "records" => $physiciansListing,
            ]
        );
    }

    public function addPhysician(Request $request)
    {
        $user = $this->__getSession('user');
        if ($user->id == null) {
            return redirect()->route('nameOfMyRoute', []);
        }


        $user = $this->__getSession('user');
        $param['user_id'] = $user->id;
        $user = $this->__getSession('user');

        $hospital = DB::select("SELECT * FROM hospital WHERE user_id = '" . $user->id . "'");

        $total_user = DB::select("SELECT count(*) as total_user FROM user WHERE hospital_id = '" . $hospital[0]->id . "'");


        if ($total_user[0]->total_user >= $hospital[0]->employees_registration) {
            return Redirect::to('/user/physicians-listing?s=l');
        }

        $post_data = array();
        $error = array();
        if ($request->session()->has('error')) {
            $error = Session::get('error');

            //  $request->session()->forget('error');
        }

        $posting_data = array();
        if ($request->session()->has('posting_data')) {
            $posting_data = Session::get('posting_data');
            Session::forget('posting_data');
            $request->session()->forget('posting_data');
        }

        return view('user.physicians-listing.add-physician',
            [
                "post_data" => $posting_data
            ]
        );
    }

    public function editPhysician($id, Request $request)
    {
        $user = $this->__getSession('user');
        if ($user->id == null) {
            return redirect()->route('nameOfMyRoute', []);
        }
        $user = $this->__getSession('user');
        $param['user_id'] = $user->id;
        $user = DB::select("SELECT * FROM user WHERE id = '" . $id . "'");
        $post_data = array();
        $post_data = Session::get('post_data');
        if ($request->session()->has('post_data')) {

            //   $request->session()->forget('post_data');
        }
        $error = array();
        /* if ($request->session()->has('error')) {
             $error = Session::get('error');
             $request->session()->forget('error');
         }*/
        return view('user.physicians-listing.edit-physician',
            [
                "post_data" => (array)$user[0],
                "error" => $error,

            ]
        );
    }

    public function viewAttemptedTrainings($id, Request $request)
    {
        $user = $this->__getSession('user');
        if ($user->id == null) {
            return redirect()->route('nameOfMyRoute', []);
        }
        $user = $this->__getSession('user');
        $param['user_id'] = $user->id;
        $user = DB::select("SELECT * FROM user WHERE id = '" . $id . "'");

        $user_quizzes = DB::select(
            "SELECT 
              * 
            FROM
              `user_quizzes`,
              `course_quizzes`,
              `courses` 
            WHERE user_quizzes.`course_quiz_id` = course_quizzes.`id` 
            AND courses.`id` = course_quizzes.`course_id`
            AND user_quizzes.`user_id` = $id"
        );

        $post_data = array();
        $post_data = Session::get('post_data');
        if ($request->session()->has('post_data')) {

            //   $request->session()->forget('post_data');
        }
        $error = array();
        /* if ($request->session()->has('error')) {
             $error = Session::get('error');
             $request->session()->forget('error');
         }*/
        return view('user.physicians-listing.view-attempted-trainings',
            [
                "post_data" => (array)$user[0],
                "error" => $error,
                "user_quizzes" => $user_quizzes,

            ]
        );
    }
}


