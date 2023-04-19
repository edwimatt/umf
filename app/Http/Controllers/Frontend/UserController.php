<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Using for Web SignUp view
     * @param Request $request
     * @return mixed
     */
    public function hospitalRegister(Request $request)
    {

        $post_data = array();
        $price_error_message = "";
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

        return view('user.hospital.register',
            [
                "post_data" => $posting_data,
            ]
        );
    }

    /**
     * Using for Web SignUp Submit
     * @param Request $request
     * @return array
     */
    public function postHospitalRegister(Request $request)
    {
        $params = $request->all();
        $param_rules['first_name'] = 'required|string|max:100';
        $param_rules['last_name'] = 'required|string|max:100';
        $param_rules['hospital_name'] = 'required|string|max:225';
        $param_rules['email'] = 'required|unique:user|email|max:150|unique:user,deleted_at,NULL';
        $param_rules['password'] = 'required|string|min:6';

        $this->__is_redirect = true;
        $this->__view = 'hospital/register';
        $response = $this->__validateRequestParams($params, $param_rules);

        Session::put('posting_data', $_POST);

        if ($this->__is_error == true) {
            Session::put('posting_data', $_POST);
            return $response;
        }

        $plain_password = $params['password'];
        $params['password'] = $this->__encryptedPassword($params['password']);

        // update forgot password hash and update hash date
        $params['forgot_password_hash'] = $this->__generateUserHash($request->email);
        $params['forgot_password_hash_date'] = Carbon::now();


        if ($request->hasFile('hospital_image')) {
            // $obj is model

            $image = $this->__moveUploadFile(
                $request->file('hospital_image'),
                md5(rand(10, 100000)),
                Config::get('constants.USER_IMAGE_PATH')
            );
            $params['hospital_image'] = $image;
        }

        $user_id = User::createHospitalUser($params);
        $user = User::getUserByID($user_id);
        $Hospital = new Hospital();
        $Hospital->user_id = $user_id;
        $Hospital->name = $params['hospital_name'];
        $Hospital->employees_registration = $params['employees_registration'];
        if(!empty($params["hospital_image"])){
            $Hospital->hospital_image      = $params["hospital_image"];
        }
        $Hospital->save();
        //$params = $request->all();
        if(!empty($Hospital->id)){
            User::where("id",$user_id)->update(["hospital_id" => $Hospital->id]);
        }

        if ($request->session()->has('posting_data')) {
            $posting_data = Session::get('posting_data');
            Session::forget('posting_data');
            $request->session()->forget('posting_data');
        }
        //$mail_params['USER_NAME'] = $request['hospital_name'].' '.$request['last_name'];
        $mail_params['USER_NAME'] = $request['hospital_name'];
        $mail_params['LOGO'] = '<img style="width: 120px;" src="' . URL::to("image/logo.png") . '">';
        //$mail_params['LINK'] = env('APP_URL')."admin/hospital/detail/$user_id";
        $mail_params['LINK'] = env('APP_URL') . "admin/hospital";

        $IOS_APP_LINK = "";
        $ANDROID_APP_LINK = "";

        $mail_params['IOS_STORE_APP_LINK'] = "<a href='{$IOS_APP_LINK}'>$IOS_APP_LINK</a>";
        $mail_params['ANDROID_STORE_APP_LINK'] = "<a href='" . $ANDROID_APP_LINK . "'>$ANDROID_APP_LINK</a>";
        //$mail_params['USER_LINK'] = env('APP_URL').'/user/login';
        $mail_params['APP_NAME'] = env('APP_NAME');
        $mail_params['EMAIL'] = $request['email'];
        $mail_params['PASSWORD'] = $plain_password;


        // make forgot password url and implement its email configuration.
        $this->__sendMail('user_registration_email', $request->email, $mail_params);

        $params = $request->all();
        $mail_params = array();
        $mail_params['USER_NAME'] = $request['first_name'] . ' ' . $request['last_name'];


        $mail_params['LOGO'] = '<img style="width: 120px;" src="' . URL::to("image/logo.png") . '">';
        $mail_params['LINK'] = env('APP_URL') . "/admin/hospital";

        //$mail_params['USER_LINK'] = env('APP_URL').'/user/login';
        $mail_params['APP_NAME'] = env('APP_NAME');
        $mail_params['EMAIL'] = $request['email'];
        $mail_params['USER_NAME'] = $request['first_name'] . ' ' . $request['last_name'];

        // make forgot password url and implement its email configuration.
        $admin_email = 'understandingmyfacility@gmail.com';

        $receive_email = Setting::getByKey('receive_email');
        //dd($receive_email->value);
        $this->__sendMail('new_user_registration_email_admin', $admin_email, $mail_params);

        return Redirect::to('/hospial/register/thanks');
    }

    /**
     * Using for Web SignUp ThankYou Message
     * @param Request $request
     * @return mixed
     */
    public function hospitalRegisterThanks(Request $request)
    {
        return view('user.hospital.thankyou',
            [
                "post_data" => array(),
            ]
        );
    }

    public function loginIndex(Request $request)
    {
        $data = [];
        if ($request->hasSession('error')) {
            $data['error'] = $request->session()->pull('error');
        }

        return view('user.login.index', $data);
    }

    public function loginWeb(Request $request)
    {
        $param_rules['email'] = 'required|string|email|max:150';
        $param_rules['password'] = 'required|string';
        $this->__is_redirect = true;
        $this->__view = 'user/login';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;
        $user = User::loginWeb($request->email, $this->__encryptedPassword($request->password));

        if (empty($user)) {
            $errors['email'] = Lang::get('auth.failed');
            return $this->__sendErrorResponse('Validation Error.', $errors);
        }

        if (!empty($user) && $user->is_active == 0) {
            $errors['email'] = "Your credentials have been deactivated by the admin.";
            return $this->__sendErrorResponse('Validation Error.', $errors);
        }
        $value = "";
        if ($this->call_mode != 'api') {
            $this->__setSession('user', $user);
            $value = "physicians-listing";
        }

        $this->__is_paginate = false;
        //$this->__collection = false;
        $this->__view = 'user/' . $value;
        $user = User::find($user->id);

        $this->__is_paginate = false;
        $this->__collection = true;
        $this->__is_collection = false;
        return $this->__sendResponse('User', $user, 200, 'User has been logged in successfully.');
    }

    public function editProfile(Request $request)
    {
        $user = $this->__getSession('user');
        if ($user->id == null) {
            return redirect()->route('nameOfMyRoute', []);
        }
        $data = array();
        $user = $this->__getSession('user');
        $data['user'] = $user;


        $param['user_id'] = $user->id;
        $user = $this->__getSession('user');

        $sql = "SELECT * FROM hospital WHERE user_id = '" . $user->id . "'";
        $hospital_data = DB::select($sql);

        $sql = "SELECT * FROM user WHERE id = '" . $user->id . "'";
        $user_data = DB::select($sql);


        if ($request->session()->has('error')) {
            $error = Session::get('error');
            $request->session()->forget('error');
        }

        if ($request->session()->has('post_data')) {
            $request->session()->forget('post_data');
        }

        return view('user.editprofile', [
            'error' => $error,
            'user' => $user_data[0],
            'hospital' => $hospital_data[0]
        ]);
    }

    public function postEditProfile(Request $request)
    {
        $user = $this->__getSession('user');
        if ($user->id == null) {
            return redirect()->route('nameOfMyRoute', []);
        }
        $user = $this->__getSession('user');
        $param_rules['first_name'] = 'required';
        $param_rules['last_name'] = 'required';
        $param_rules['hospital_name'] = 'required';

        $this->__is_redirect = true;
        $this->__view = 'user/editprofile';
        $response = $this->__validateRequestParams($request->all(), $param_rules);


        if ($this->__is_error == true) {
            Session::put('post_data', $request->all());
            return $response;
        }

        User::where('id', $user->id)->Update(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]
        );
        Hospital::where('user_id', $user->id)->Update(
            [
                'name' => $request->hospital_name,
            ]
        );

        if ($request->hasFile('hospital_image')) {
            // $obj is model

            $image = $this->__moveUploadFile(
                $request->file('hospital_image'),
                md5(rand(10, 100000)),
                Config::get('constants.USER_IMAGE_PATH')
            );
            $request['hospital_image'] = $image;

            Hospital::where('user_id', $user->id)->Update(
                [
                    'name' => $request->hospital_name,
                    'hospital_image' => $image,
                ]
            );
        }

        return Redirect::to('/user/editprofile?s=c');
    }

    public function changeUserPassword(Request $request)
    {
        $user = $this->__getSession('user');
        if ($user->id == null) {
            return redirect()->route('nameOfMyRoute', []);
        }
        $data = array();
        if ($request->session()->has('error')) {
            $error = Session::get('error');
            $request->session()->forget('error');
        }

        if ($request->session()->has('post_data')) {
            $request->session()->forget('post_data');
        }
        return view('user.changeuserpassword', ['error' => $error]);
    }

    public function postChangeUserPassword(Request $request)
    {

        $user = $this->__getSession('user');
        if ($user->id == null) {
            return redirect()->route('nameOfMyRoute', []);
        }

        $user = $this->__getSession('user');
        $param_rules['current_password'] = 'required';
        $param_rules['password'] = 'required|min:6';
        $param_rules['confirm_password'] = 'required|min:6|same:password';

        $this->__is_redirect = true;
        $this->__view = 'user/changeuserpassword';
        $response = $this->__validateRequestParams($request->all(), $param_rules);


        if ($this->__is_error == true) {
            Session::put('post_data', $request->all());
            return $response;
        }

        // get data against email address
        $id = $user->id;
        //dd($id);

        $user = User::loginById($id, $this->__encryptedPassword($request->current_password));


        if (count($user) <= 0) {
            $errors['password'] = Lang::get('passwords.change_password');
            return $this->__sendError('Validation Error.', $errors);
        }
        // $user[0]->password = $this->__encryptedPassword($request->password);

        User::where('id', $id)->Update(
            [
                'password' => $this->__encryptedPassword($request->password),

            ]
        );

        //dd($user[0]->password);
        //$user[0]->save();
        return Redirect::to('/user/changeuserpassword?s=c');
    }

    public function userForgotPassword(Request $request)
    {


        $param_rules['email'] = 'required|string|email|max:150';
        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if ($this->__is_error == true)
            return $response;

        // get data against email address

        $user = User::getByEmail2($request->email);


        if (count($user) <= 0) {
            $errors['email'] = Lang::get('passwords.user');

            if ($this->__is_api_call) {
                return $this->__sendError('Validation Error.', $errors);
            } else {
                return Redirect::to('user/login/user_forget_password?v=e');
            }
        }

        $this->__view = 'user/login/user_forget_password';
        // update forgot password hash and update hash date
        $hash = $this->__generateUserHash($request->email);

        User::updateByEmail($request->email, [
            'forgot_password_hash' => $hash,
            'forgot_password_hash_date' => Carbon::now()
        ]);


        $mail_params['USER_NAME'] = $user[0]->first_name . ' ' . $user[0]->last_name;
        $mail_params['CONFIRMATION_LINK'] = env('APP_URL') . "/user/forgot/password/$hash";
        $mail_params['LOGO'] = '<img width="250" src="' . asset('image/logo.png') . '">';
        $mail_params['USER_LINK'] = env('APP_URL') . '/user/login';
        $mail_params['APP_NAME'] = env('APP_NAME');


        // make forgot password url and implement its email configuration.
        $this->__sendMail('user_forgot_password', $request->email, $mail_params);
        return Redirect::to('user/login/user_forget_password?v=s');

        // send email to user

        $this->__is_paginate = false;

        return $this->__sendResponse('User', $user, 200, $errors['email'] = Lang::get('passwords.sent'));
    }

    public function messages(Request $request)
    {
        $user = $this->__getSession('user');
        if ($user->id == null) {
            return redirect()->route('nameOfMyRoute', []);
        }

        $user = $this->__getSession('user');
        $param['user_id'] = $user->id;
        $hospital = DB::select("SELECT * FROM hospital WHERE user_id = '" . $user->id . "'");
        $physiciansListing = DB::select("SELECT hospital.name, user.*   FROM user, hospital WHERE hospital_id = '" . $hospital[0]->id . "'");
        $posting_data = array();
        if ($request->session()->has('posting_data')) {
            $posting_data = Session::get('posting_data');
            Session::forget('posting_data');
            $request->session()->forget('posting_data');
        }

        return view('user.messages.messages',
            [
                "post_data" => $posting_data,
                "physicians_listing" => $physiciansListing,
            ]
        );
    }


    public function logout(Request $request)
    {
        $this->__removeSession('user');
        $request->session()->flush();
        $this->__is_redirect = true;
        $this->__view = 'user/login';

        $this->__is_paginate = false;
        $this->__collection = false;
        return $this->__sendResponse('User', [], 200, 'User has been logged out successfully.');
    }


}


