<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LoginAuth;
use App\Models\Category;
use App\Models\Course;
use App\Models\News;
use App\Models\Setting;
use App\Models\UserCourseAttempt;
use App\Models\UserQuiz;
use App\Models\UserQuizAnswer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class UserController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->middleware(LoginAuth::class, ['only' => ['show', 'updateUser', 'changePassword'
            , 'profile', 'dashboard']]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request)
    {

        $request['id'] = $user_id = $request['user_id'];
        $param_rules['id'] = 'required|exists:user';
        $param_rules['name'] = 'required|string|max:100';
        $param_rules['mobile_no'] = 'required';
        $param_rules['image_url'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg';

        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;

        try {
            $name = explode(' ', isset($request['name']) ? $request['name'] : '');
            $last_name = isset($name[1]) ? $name[1] : '';

            $data = [
                'first_name' => $name[0],
                'last_name' => $last_name,
                'mobile_no' => $request['mobile_no'],
            ];

            if ($request->hasFile('image_url')) {
                // $obj is model
                $data['image_url'] = $this->__moveUploadFile(
                    $request->file('image_url'),
                    $request['user_id'] . time(),
                    Config::get('constants.USER_IMAGE_PATH')
                );
                $data['image_url'] = $data['image_url'];
            }
            $obj = User::where(['id' => $user_id])->update($data);


            $user = User::getUserByUserId($user_id);


            $this->__is_collection = false;
            $this->__is_paginate = false;

            return $this->__sendResponse('User', $user, 200, 'Your profile has been updated successfully');
        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
        }


    }

    public function getAllCourseByCategoryId(Request $request)
    {
        $param_rules['hospital_id'] = 'required|exists:hospital,id';
        $param_rules['user_id'] = 'required|exists:user,id';
        $param_rules['category_id'] = 'required|exists:categories,id';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;
        //$user_data = DB::select("SELECT * FROM `user` WHERE id = '" . $request->user_id . "'");
        $category = Category::getCategories($request->all(),$request->category_id);

        $this->__is_paginate = false;
        $this->__is_collection = true;
        return $this->__sendResponse('CourseCategoryDetails', $category, 200, 'Course retrieved successfully.');
    }

    public function changePassword(Request $request)
    {

        $param_rules['old_password'] = 'required';
        $param_rules['password'] = 'required|confirmed|min:6';
        $param_rules['password_confirmation'] = '';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;

        try {
            // get data against email address
            $user = User::loginById($request->user_id, $this->__encryptedPassword($request->old_password));
            if (count($user) <= 0) {
                $errors['password'] = Lang::get('passwords.change_password');
                return $this->__sendError('Validation Error.', $errors);
            }
            $user[0]->password = $this->__encryptedPassword($request->password);
            $obj = User::where(['id' => $request->user_id])->update(['password' => $user[0]->password]);
            //$user[0]->save();
            $this->__is_paginate = false;
            return $this->__sendResponse('User', $user, 200, Lang::get('passwords.reset'));

        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
        }
    }

    public function categories(Request $request)
    {
        $Categories = Category::getCategories($request->all());

        $this->__is_paginate = false;
        return $this->__sendResponse('CourseCategory', $Categories, 200, 'Categories retrieved successfully.');
    }

    public function courseDetailsById(Request $request)
    {
        $param_rules['course_id'] = 'required|exists:courses,id';
        $param_rules['user_id'] = 'required|exists:user,id';
        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if ($this->__is_error == true)
            return $response;

        $user_data = DB::select("SELECT * FROM `user` WHERE id = '" . $request->user_id . "'");
        $language_id = !empty($user_data) ? $user_data[0]->language_id : NULL;
        $course = Course::getCourseDetailsById($request->course_id,$language_id);

        $this->__is_paginate = false;
        $this->__is_collection = false;

        return $this->__sendResponse('CourseDetail', !empty($course) ? $course : [], 200, 'Course retrieved successfully.');
    }

    public function getQuizQuestionsByCourseId(Request $request)
    {
        $param_rules['hospital_id'] = 'required|exists:hospital,id';
        $param_rules['user_id'] = 'required|exists:user,id';
        $param_rules['course_id'] = 'required|exists:courses,id';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;
        $user_data = User::where("id",$request->user_id)->first();
        //$user_data = DB::select("SELECT * FROM `user` WHERE id = '" . $request->user_id . "'");

        $course = Course::getCourseDetailsById($request->course_id,$user_data->language_id);

        $this->__is_paginate = false;
        $this->__is_collection = false;


        return $this->__sendResponse('CourseQuiz', !empty($course) ? $course : [], 200, 'Questions retrieved successfully.');
    }

    public function postQuizAnswer(Request $request)
    {
        $param_rules['user_id'] = 'required|exists:user,id';
        $param_rules['course_quiz_id'] = 'required|exists:course_quizzes,id';
        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if ($this->__is_error == true)
            return $response;

        $UserQuiz = new UserQuiz();
        $UserQuiz->user_id = $request->user_id;
        $UserQuiz->course_quiz_id = $request->course_quiz_id;
        $UserQuiz->quiz_percentage = 0;
        $UserQuiz->is_quiz_completed = 1;
        $UserQuiz->is_quiz_passed = 0;
        $UserQuiz->save();

        //dd($request->all());
        if (isset($request->quiz_question_id) && count($request->quiz_question_id) > 0) {
            for ($i = 0; $i < count($request->quiz_question_id); $i++) {
                for ($j = 0; $j < count($request->quiz_answer_id[$i]); $j++) {
                    $UserQuizAnswer = new UserQuizAnswer();
                    $UserQuizAnswer->user_id = $request->user_id;
                    $UserQuizAnswer->user_quiz_id = $UserQuiz->id;
                    $UserQuizAnswer->quiz_question_id = $request->quiz_question_id[$i];
                    $UserQuizAnswer->quiz_answer_id = $request->quiz_answer_id[$i][$j];
                    $UserQuizAnswer->save();
                }
            }
        }

        $courses = DB::table("courses")->select("courses.passing_percentage","courses.course_title")
            ->join("course_quizzes","course_quizzes.course_id","=","courses.id")
            ->where("course_quizzes.id",$request->course_quiz_id)
            ->first();

        $user = User::getUserByUserId($request->user_id);

        $quiz_answers = DB::table("quiz_answers")
            ->selectRaw("COUNT(quiz_answers.id) AS total")
            ->join("quiz_questions","quiz_questions.id","=","quiz_answers.quiz_question_id")
            ->where("quiz_questions.course_quiz_id",$request->course_quiz_id)
            ->where("quiz_questions.language_id",$user->language_id)
            ->where("quiz_answers.is_correct_answer",1)
            ->first();

        $user_quiz_answers = DB::table("user_quiz_answers")
            ->selectRaw("COUNT(user_quiz_answers.id) AS total")
            ->join("quiz_answers","quiz_answers.id","=","user_quiz_answers.quiz_answer_id")
            ->join("quiz_questions","quiz_questions.id","=","user_quiz_answers.quiz_question_id")
            ->where("quiz_answers.is_correct_answer",1)
            ->where("user_quiz_answers.user_id",$request->user_id)
            ->where("user_quiz_answers.user_quiz_id",$UserQuiz->id)
            ->where("quiz_questions.course_quiz_id",$request->course_quiz_id)
            ->first();

        if (!empty($user_quiz_answers->total)) {
            $quiz_percentage = round(($user_quiz_answers->total / $quiz_answers->total) * 100, 2);
        } else {
            $quiz_percentage = 0;
        }


        $is_quiz_passed = 0;
        if ($quiz_percentage >= $courses->passing_percentage) {
            $is_quiz_passed = 1;
            $toUsers = [];
            $hospital = NULL;
            if(!empty($user->hospital_id)){
                $hospital = User::where("id",$user->hospital_id)->first();
            }
            $toUsers[] = Setting::getByKey('receive_email')->value;
            if(!empty($hospital->email)){
                $toUsers[] = $hospital->email;
            }
            $hospitalEmails = DB::table("hospital_email")->where("hospital_id",$user->hospital_id)->get();
            if(!empty($hospitalEmails)){
                foreach ($hospitalEmails as $hospitalEmail){
                    $toUsers[] = $hospitalEmail->email;
                }
            }

            $mail_params['USER_NAME'] = trim("$user->first_name $user->last_name");
            $mail_params['attachment'] = public_path("uploads/media/19d34aca118d9efa4ea7f3.png");
            $mail_params['APP_NAME'] = env('APP_NAME');
            $mail_params['COURSE_NAME'] = !empty($courses->course_title) ? str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $courses->course_title) : "." ;
            // send email for contact us.
            $this->__sendMail('on_certificate_complete', $toUsers, $mail_params);


            $user_mail_params['USER_NAME'] = trim("$user->first_name $user->last_name");
            $user_mail_params['attachment'] = public_path("uploads/media/19d34aca118d9efa4ea7f3.png");
            $user_mail_params['APP_NAME'] = env('APP_NAME');
            $user_mail_params['COURSE_NAME'] = !empty($courses->course_title) ? str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $courses->course_title) : "." ;
            // send email for contact us.
            $this->__sendMail('on_certificate_complete_user', [$user->email], $user_mail_params);
        }
        UserQuiz::where('id', $UserQuiz->id)->Update(
            [
                'is_quiz_passed' => $is_quiz_passed,
                'quiz_percentage' => $quiz_percentage,
            ]
        );
        $UserQuiz = UserQuiz::getUserQuizDetailsById($UserQuiz->id);
        $this->__is_paginate = false;
        $this->__is_collection = false;

        return $this->__sendResponse('UserQuiz', $UserQuiz, 200, 'User Quiz retrieved successfully.');
    }

    public function getSearchCourse(Request $request)
    {
        $param_rules['user_id'] = 'required|exists:user,id';
        $param_rules['search_keyword'] = 'required';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;
        $user_data = DB::select("SELECT * FROM `user` WHERE id = '" . $request->user_id . "'");
        $data['language_id'] = $user_data[0]->language_id;
        $data['search_keyword'] = $request->search_keyword;
        $course = Course::getSearchCourse($data);
        $this->__is_paginate = false;
        $this->__collection = true;
        $this->__is_collection = true;
        return $this->__sendResponse('SearchCourse', $course, 200, 'Course retrieved successfully.');
    }


    public function getUserQuizzes(Request $request)
    {
        $param_rules['user_id'] = 'required|exists:user,id';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;
        $UserQuizzes = UserQuiz::getUserQuizzesByUserId($request->user_id);
        $this->__is_paginate = true;
        $this->__collection = true;
        $this->__is_collection = true;
        return $this->__sendResponse('UserQuizzes', $UserQuizzes, 200, 'Course retrieved successfully.');
    }

    public function languages(Request $request)
    {
        $languages = User::getLanguages();
        return $this->__sendResponse('Language', $languages, 200, 'Languages retrieved successfully.');
    }

    public function updateUserLanguage(Request $request)
    {

        $request['id'] = $user_id = $request['user_id'];
        $param_rules['id'] = 'required|exists:user';
        $param_rules['language_id'] = 'required';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;

        try {
            $data = [
                'language_id' => $request->language_id,
            ];

            $obj = User::where(['id' => $user_id])->update($data);

            $user = User::getUserByUserId($user_id);


            $this->__is_collection = false;
            $this->__is_paginate = false;

            return $this->__sendResponse('User', $user, 200, 'Your preferred language has been updated successfully');
        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
        }
    }

    public function getUserCertificates(Request $request)
    {
        $param_rules['user_id'] = 'required|exists:user,id';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;
        $UserCertificates = UserQuiz::getUserCertificatesByUserId($request->user_id, 1);
        $this->__is_paginate = false;
        $this->__collection = true;
        $this->__is_collection = true;
        return $this->__sendResponse('UserCertificates', $UserCertificates, 200, 'Certificates retrieved successfully.');
    }

    public function getUserCertificatesDetails(Request $request)
    {
        $param_rules['course_id'] = 'required|exists:courses,id';
        $param_rules['user_id'] = 'required|exists:user,id';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;

        $user_data = User::where("id",$request->user_id)->first();
        $CourseDetails = Course::getCourseDetailsById($request->course_id,$user_data->language_id);

        $this->__is_paginate = false;
        $this->__is_collection = false;
        return $this->__sendResponse('UserCertificatesDetails', $CourseDetails, 200, 'Certificate retrieved successfully.');
    }

    public function markCompleteCourse(Request $request)
    {
        $param_rules['user_id'] = 'required|exists:user,id';
        $param_rules['course_id'] = 'required|exists:courses,id';
        $param_rules['hospital_id'] = 'required|exists:hospital,id';
        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if ($this->__is_error == true)
            return $response;

        $user_course_attempt = UserCourseAttempt::where(["user_id" => $request->user_id , "course_id" => $request->course_id, "hospital_id" => $request->hospital_id])->first();
        if(empty($user_course_attempt)){
            \DB::table("user_course_attempt")->insert(["user_id" => $request->user_id , "course_id" => $request->course_id, "hospital_id" => $request->hospital_id]);
        }

        $Categories = Category::getCategories($request->all());
        $this->__is_paginate = false;
        return $this->__sendResponse('CourseCategory', $Categories, 200, 'Course has been completed.');
    }

    public function getNewsList(Request $request)
    {
        $param_rules['hospital_id'] = 'required';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;

        $this->__is_paginate = true;
        $this->__collection = true;
        $this->__is_collection = true;
        $News = News::getNews($request->all());

        return $this->__sendResponse('News', $News, 200, 'News retrieved successfully.');
    }


    public function getNewsDetails(Request $request)
    {
        $param_rules['news_id'] = 'required|exists:news,id';
        $param_rules['hospital_id'] = 'required';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;

        $NewsDetails = News::getById($request->news_id,$request->all());
        $this->__is_paginate = false;
        $this->__collection = true;
        $this->__is_collection = false;
        return $this->__sendResponse('News', $NewsDetails, 200, 'NEWS retrieved successfully.');
    }

    public function messageCount(Request $request)
    {
        $total_unread_count = DB::select("SELECT COUNT(user_id) AS total_count FROM `chat_message_status` WHERE user_id = " . $request['user_id'] . " AND is_read = 0 GROUP BY user_id");
        $data = [
            'total_unread_count' => (int)$total_unread_count[0]->total_count,

        ];
        $this->__is_paginate = false;
        $this->__collection = false;

        return $this->__sendResponse('', $data, 200, 'Unread count retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function mobileLogout(Request $request)
    {

        $param_rules['user_id'] = 'required|int';
        $this->__is_ajax = true;
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;
        $data = [
            'device_token' => NULL,
            'device_type' => NULL,
        ];


        $obj = User::where(['id' => $request['user_id']])->update($data);

        $this->__is_collection = false;
        $this->__is_paginate = false;
        $this->__collection = false;
        return $this->__sendResponse('User', [], 200, 'Logout successfully.');
        return response()->json([
            'code' => 200,
            'data' => [],
            'message' => 'User logout successfully.'
        ], 200);

    }


    /**
     * Login  the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $param_rules['email'] = ["required", "email", "max:150", "exists:user,email,deleted_at,NULL"];
        $param_rules['password'] = 'required|string';
        $param_rules['device_type'] = 'required|string';
        $param_rules['device_token'] = 'required|string';

        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if ($this->__is_error == true)
            return $response;

        $user = User::login($request->email, $this->__encryptedPassword($request->password));

        if (!in_array($user->user_type, ["physician"])) {
            $errors['email'] = "This user is not a physician.";
            return $this->__sendError('Validation Error.', $errors);
        }

        if ($user->password != $this->__encryptedPassword($request->password)) {
            $errors['email'] = Lang::get('crudbooster.alert_password_wrong');
            return $this->__sendError('Validation Error.', $errors);
        }elseif ($user->hospital_is_active == 0){
            $errors['email'] = "User has been deactivated.";
            return $this->__sendError("User has been deactivated.", $errors,401);
        }elseif ($user->is_active == 0){
            $errors['email'] = "Hospital has been deactivated.";
            return $this->__sendError("Hospital has been deactivated.", $errors,401);
        }

        User::where('id', $user->id)->update(
            [
                //'language_id' => !empty($request->current_language_id) ? $request->current_language_id : NULL,
                'device_type' => !empty($request->device_type) ? $request->device_type : NULL,
                'device_token' => !empty($request->device_token) ? $request->device_token : NULL,
            ]
        );

        $user = User::login($request->email, $this->__encryptedPassword($request->password));

        $this->__is_collection = false;
        $this->__is_paginate = false;

        return $this->__sendResponse('User', $user, 200, 'Logged in successfully.');
    }


    public function storeUser(Request $request)
    {
        if ($request['social_type'] != '') {
            $param_rules['full_name'] = 'required|string|max:100';
            $param_rules['device_type'] = 'required|string';
            $param_rules['device_token'] = 'required|string';
            $param_rules['social_id'] = 'required|string';
            $param_rules['social_type'] = 'required|string';
        } else {
            $param_rules['first_name'] = 'required|string|max:100';
            $param_rules['last_name'] = 'required|string|max:100';
            $param_rules['email'] = 'required|unique:user|email|max:150|unique:user,deleted_at,NULL';
            $param_rules['password'] = 'required|string|min:6';
            $param_rules['password_confirmation'] = 'required_with:password|same:password|min:6';
            $param_rules['department_id'] = 'required';
            $param_rules['hospital_id'] = 'required';
            $param_rules['device_type'] = 'required|string';
            $param_rules['device_token'] = 'required|string';
            $param_rules['image_url'] = 'nullable|mimes:png,jpeg,jpg,gif|max:2048';
        }
        $this->__is_ajax = true;
        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if ($this->__is_error == true)
            return $response;

        if ($request['social_type'] == '') {

            if ($request->hasFile('image_url')) {
                // $obj is model
                $request['image_url_path'] = $this->__moveUploadFile(
                    $request->file('image_url'),
                    md5($request['email'] . $request['device_token']),
                    Config::get('constants.USER_IMAGE_PATH')
                );

                //$obj_user->image_url = $request['system_image_url'];
            }

            $plain_password = $request['password'];
            $request['password'] = $this->__encryptedPassword($request['password']);
            // update forgot password hash and update hash date
            $request['forgot_password_hash'] = $this->__generateUserHash($request->email);
            $request['forgot_password_hash_date'] = Carbon::now();
            $user_id = User::createUser($request->all());

            $hash = $request['forgot_password_hash'];
            $this->__is_paginate = false;
            $this->__is_collection = false;
            //$this->__collection = false;

            $user = User::getById($user_id);

            $params = $request->all();

            $mail_params['USER_NAME'] = $request['first_name'] . ' ' . $request['last_name'];
            $mail_params['LOGO'] = '<img width="250" src="' . asset('image/logo.png') . '">';
            $mail_params['LINK'] = env('APP_URL') . "/admin/physicians/detail/$user->user_user_id";
            $mail_params['APP_NAME'] = env('APP_NAME');
            $mail_params['EMAIL'] = $request['email'];
            $mail_params['PASSWORD'] = $plain_password;

            // make forgot password url and implement its email configuration.
            $this->__sendMail('user_registration_email', $request->email, $mail_params);

            $params = $request->all();
            $mail_params['USER_NAME'] = $request['first_name'] . ' ' . $request['last_name'];


            $mail_params['LOGO'] = '<img width="250" src="' . asset('image/logo.png') . '">';
            $mail_params['CONFIRMATION_LINK'] = env('APP_URL') . "/user/registration/$hash";

            //$mail_params['USER_LINK'] = env('APP_URL').'/user/login';
            $mail_params['APP_NAME'] = env('APP_NAME');
            $mail_params['EMAIL'] = $request['email'];
            $mail_params['USER_NAME'] = $request['first_name'] . ' ' . $request['last_name'];

            // make forgot password url and implement its email configuration.
            $this->__sendMail('new_user_registration_email_admin', $request->email, $mail_params);

            // send email to user
            return response()->json([
                'code' => 200,
                'data' => [],
                'message' => 'Thank you for registration an account. Your account is currently in pending approval by the administrator.'
            ], 200);

            $this->__is_paginate = false;
            return $this->__sendResponse('User', [], 200, 'Thank you for registration an account. Your account is currently in pending approval by the administrator.');
        } else {

            $request['password'] = $this->__encryptedPassword($request['password']);
            // update forgot password hash and update hash date
            $request['forgot_password_hash'] = $this->__generateUserHash($request->email);
            $request['forgot_password_hash_date'] = Carbon::now();
            $user_id = User::createUser($request->all());

            $params = $request->all();
            $stripCustomer = $this->_stripe->createCustomer($params['email']);

            if ($stripCustomer['code'] != 200) {
                User::where('id', $user_id)->forceDelete();
                $errorMessages['error'] = $stripCustomer['message'];
                return $this->__sendError('Error', $errorMessages, 400);
            }

            $createConnectAccount = $this->_stripe->createConnectAccount($params['email']);
            if ($createConnectAccount['code'] != 200) {
                $errorMessages['error'] = $createConnectAccount['message'];
                return $this->__sendError('Error', $errorMessages, 400);
            }
            $request['stripe_account_id'] = $createConnectAccount['data']['connect_account']['id'];

            User::where('id', $user_id)->update([
                'stripe_customer_id' => $stripCustomer['data']['customer_id'],
                'stripe_account_id' => $createConnectAccount['data']['connect_account']['id']
            ]);


            $hash = $request['forgot_password_hash'];

            $user = User::getById($user_id);

            $PersonnelFileRequirement = new PersonnelFileRequirement();
            $PersonnelFileRequirement->contractor_id = $user_id;
            $PersonnelFileRequirement->is_approved = 0;
            $PersonnelFileRequirement->save();

            $mail_params['USER_NAME'] = $request['full_name'];
            $mail_params['CONFIRMATION_LINK'] = env('APP_URL') . "/user/registration/$hash";

            //$mail_params['USER_LINK'] = env('APP_URL').'/user/login';
            $mail_params['APP_NAME'] = env('APP_NAME');

            // make forgot password url and implement its email configuration.
            $this->__sendMail('user_registration_email', $request->email, $mail_params);
            // send email to user
            $this->__is_paginate = false;
            $this->__is_collection = false;
            //$this->__collection = false;
            return $this->__sendResponse('ContractorLogin', $user, 200, 'User has been added successfully.');
        }
    }


    public function forgotPassword(Request $request)
    {
        $param_rules['email'] = 'required|string|email|max:150';
        $response = $this->__validateRequestParams($request->all(), $param_rules);
        if ($this->__is_error == true)
            return $response;
        // get data against email address
        try {
            $user = User::getByEmail($request->email);

            if (count($user) <= 0) {
                $errors['email'] = Lang::get('passwords.user');
                return $this->__sendError('Validation Error.', $errors);
            }
            // update forgot password hash and update hash date
            $hash = $this->__generateUserHash($request->email);

            User::updateByEmail($request->email, [
                'forgot_password_hash' => $hash,
                'forgot_password_hash_date' => Carbon::now()
            ]);


            $mail_params['USER_NAME'] = $user[0]->first_name . ' ' . $user[0]->last_name;
            $mail_params['CONFIRMATION_LINK'] = env('APP_URL') . "/user/forgot/password/$hash";
            $mail_params['USER_LINK'] = env('APP_URL') . '/user/login';
            $mail_params['APP_NAME'] = env('APP_NAME');
            $mail_params['LOGO'] = '<img style="width: 120px;" src="' . URL::to("image/logo.png") . '">';

            // make forgot password url and implement its email configuration.
            $this->__sendMail('user_forgot_password', $request->email, $mail_params);
            // send email to user
            $this->__is_paginate = false;

            $this->__is_collection = false;
            return $this->__sendResponse('User', $user[0], 200, $errors['email'] = "We have emailed you the password reset link.");

        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
        }

    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        try {
            $param_rules['target_id'] = 'required|exists:user,id';
            $response = $this->__validateRequestParams(['target_id' => $request['target_id']], $param_rules);
            if ($this->__is_error == true)
                return $response;
            $this->__is_paginate = false;
            $this->__is_collection = false;
            return $this->__sendResponse('User', User::getById($request['target_id']), 200, 'User retrieved successfully.');
        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function social(Request $request)
    {
        try {
            $this->__is_paginate = false;
            $this->__collection = false;
            $param_rules['social_id'] = 'required';
            $param_rules['social_type'] = 'required|in:facebook,google,google_plus,twitter';


            $response = $this->__validateRequestParams($request->all(), $param_rules);

            if ($this->__is_error == true)
                return $response;

            $user_response = User::getBySocial($request->all());

            if (count($user_response)) {
                return $this->__sendResponse('User', $user_response[0], 200, 'User already exists.');
            }

            $param_rules['device_type'] = 'required|string';
            $param_rules['device_token'] = 'required|string';
            $param_rules['device'] = 'required|string';
            //$param_rules['user_group_id']   = 'required|string';

            $response = $this->__validateRequestParams($request->all(), $param_rules);

            if ($this->__is_error == true)
                return $response;

            $obj_user = new User();

            $name = explode(' ', isset($request['name']) ? $request['name'] : '');

            $obj_user->first_name = $name[0];
            $obj_user->first_name = $name[0];
            $obj_user->last_name = isset($name[1]) ? $name[1] : '';

            $obj_user->email = isset($request['email']) ? $request['email'] : '';
            $obj_user->image_url = isset($request['image_url']) ? $request['image_url'] : '';

            $obj_user->social_id = $request['social_id'];
            $obj_user->social_type = $request['social_type'];
            $obj_user->user_group_id = 1;
            $obj_user->token = User::getToken();

            $obj_user->save();
            User::createUserSetting($obj_user->id);

            $user = User::getById($obj_user->id);
            $this->_btAddCustomer($request, $user[0]);

            return $this->__sendResponse('User', $user, 201, 'Social user has been added successfully.');

        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
        }

    }


    public function changePasswordWeb(Request $request)
    {
        try {
            $data = [
                'request' => $request
            ];
            if (isset($request->hash)) {

                $this->__call_mode = 'web';
                $this->__is_ajax = true;
                $response = $this->changePasswordByHash($request);
                if ($response->original['code'] == 200) {
                    return view('thankyou', $data);
                } else {
                    $data['error'] = $response->original['data'];
                }
                //echo "<pre>";print_r($data['error']);die();
            }
            return view('forgotpassword', $data);

        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
        }


    }

    public function dashboard(Request $request)
    {
        $user = $this->__getSession('user');
        if ($user->id == null) {
            return redirect()->route('nameOfMyRoute', []);
        }
        Session::forget('posting_data');
        $user = $this->__getSession('user');
        $param['user_id'] = $user->id;
        //dd($Deals);
        return view('user.dashboard.dashboard',
            []
        );
    }
    public function changePasswordByHash(Request $request)
    {
        $param_rules['hash'] = 'required';
        $param_rules['password'] = 'required|confirmed|min:6';
        $param_rules['password_confirmation'] = '';
        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if ($this->__is_error == true)
            return $response;

        try {
            // get data against email address
            $user = User::getByPasswordHash($request->hash);

            if (count($user) <= 0) {
                $errors['email'] = Lang::get('passwords.hash');

                return $this->__sendError('Validation Error.', $errors);
            }

            $user[0]->password = $this->__encryptedPassword($request->password);

            $user[0]->forgot_password_hash = '';

            $user[0]->save();

            $this->__is_paginate = false;
            return $this->__sendResponse('User', $user, 200, Lang::get('passwords.reset'));
        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
        }
    }


    public static function getUserData($id)
    {

        $sql = "SELECT * FROM user WHERE id = '" . $id . "'";
        $user_data = DB::select($sql);
        return $user_data[0];
    }
}


