<?php namespace App\Http\Controllers;

use App\Libraries\Helper;
use App\Models\Course;
use App\Models\CourseCertificate;
use App\Models\LanguageToCourse;
use App\Models\LanguageToCourseContent;
use App\Models\Notification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Session;
use Request;
use DB;
use CRUDBooster;

class AdminCoursesController extends \crocodicstudio\crudbooster\controllers\CBController
{

    public function cbInit()
    {

        # START CONFIGURATION DO NOT REMOVE THIS LINE
        $this->title_field = "course_title";
        $this->limit = "20";
        $this->orderby = "id,desc";
        $this->global_privilege = false;
        $this->button_table_action = true;
        $this->button_bulk_action = true;
        $this->button_action_style = "button_icon";
        $this->button_add = false;
        $this->button_edit = true;
        $this->button_delete = false;
        $this->button_detail = true;
        $this->button_show = false;
        $this->button_filter = true;
        $this->button_import = false;
        $this->button_export = false;
        $this->table = "courses";
        # END CONFIGURATION DO NOT REMOVE THIS LINE

        # START COLUMNS DO NOT REMOVE THIS LINE
        $this->col = [];
        $this->col[] = ["label" => "Category Id", "name" => "category_id", "join" => "category,id"];
        $this->col[] = ["label" => "Passing Percentage", "name" => "passing_percentage"];
        $this->col[] = ["label" => "Course Title", "name" => "course_title"];
        # END COLUMNS DO NOT REMOVE THIS LINE

        # START FORM DO NOT REMOVE THIS LINE
        $this->form = [];
        $this->form[] = ['label' => 'Category Id', 'name' => 'category_id', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'category,id'];
        $this->form[] = ['label' => 'Passing Percentage', 'name' => 'passing_percentage', 'type' => 'number', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Course Title', 'name' => 'course_title', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
        # END FORM DO NOT REMOVE THIS LINE

        # OLD START FORM
        //$this->form = [];
        //$this->form[] = ["label"=>"Category Id","name"=>"category_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"category,id"];
        //$this->form[] = ["label"=>"Passing Percentage","name"=>"passing_percentage","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
        //$this->form[] = ["label"=>"Course Title","name"=>"course_title","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
        # OLD END FORM

        /*
        | ----------------------------------------------------------------------
        | Sub Module
        | ----------------------------------------------------------------------
        | @label          = Label of action
        | @path           = Path of sub module
        | @foreign_key 	  = foreign key of sub table/module
        | @button_color   = Bootstrap Class (primary,success,warning,danger)
        | @button_icon    = Font Awesome Class
        | @parent_columns = Sparate with comma, e.g : name,created_at
        |
        */
        $this->sub_module = array();


        /*
        | ----------------------------------------------------------------------
        | Add More Action Button / Menu
        | ----------------------------------------------------------------------
        | @label       = Label of action
        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
        | @icon        = Font awesome class icon. e.g : fa fa-bars
        | @color 	   = Default is primary. (primary, warning, succecss, info)
        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
        |
        */
        $this->addaction = array();


        /*
        | ----------------------------------------------------------------------
        | Add More Button Selected
        | ----------------------------------------------------------------------
        | @label       = Label of action
        | @icon 	   = Icon from fontawesome
        | @name 	   = Name of button
        | Then about the action, you should code at actionButtonSelected method
        |
        */
        $this->button_selected = array();


        /*
        | ----------------------------------------------------------------------
        | Add alert message to this module at overheader
        | ----------------------------------------------------------------------
        | @message = Text of message
        | @type    = warning,success,danger,info
        |
        */
        $this->alert = array();


        /*
        | ----------------------------------------------------------------------
        | Add more button to header button
        | ----------------------------------------------------------------------
        | @label = Name of button
        | @url   = URL Target
        | @icon  = Icon from Awesome.
        |
        */
        $this->index_button = array();


        /*
        | ----------------------------------------------------------------------
        | Customize Table Row Color
        | ----------------------------------------------------------------------
        | @condition = If condition. You may use field alias. E.g : [id] == 1
        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.
        |
        */
        $this->table_row_color = array();


        /*
        | ----------------------------------------------------------------------
        | You may use this bellow array to add statistic at dashboard
        | ----------------------------------------------------------------------
        | @label, @count, @icon, @color
        |
        */
        $this->index_statistic = array();


        /*
        | ----------------------------------------------------------------------
        | Add javascript at body
        | ----------------------------------------------------------------------
        | javascript code in the variable
        | $this->script_js = "function() { ... }";
        |
        */
        $this->script_js = "
        $(document).ready(function () {
            $('#textarea_content').summernote({focus: false,
                height: 300,
                codemirror: { 'theme': 'ambiance' },  
                toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['color', ['color']],
                        ['fontsize', ['fontsize']],
                        ['para', ['ul', 'ol', 'paragraph']]
                    ]
            });
            
            
            $('#category_id').change(function(){
                $('#course_type').val($('#category_id > option:selected').attr('data-type'));
            });
        });";


        /*
        | ----------------------------------------------------------------------
        | Include HTML Code before index table
        | ----------------------------------------------------------------------
        | html code to display it before index table
        | $this->pre_index_html = "<p>test</p>";
        |
        */
        $this->pre_index_html = null;


        /*
        | ----------------------------------------------------------------------
        | Include HTML Code after index table
        | ----------------------------------------------------------------------
        | html code to display it after index table
        | $this->post_index_html = "<p>test</p>";
        |
        */
        $this->post_index_html = null;


        /*
        | ----------------------------------------------------------------------
        | Include Javascript File
        | ----------------------------------------------------------------------
        | URL of your javascript each array
        | $this->load_js[] = asset("myfile.js");
        |
        */
        $this->load_js = array(
            asset("vendor/crudbooster/assets/summernote/summernote.min.js"),
            asset("assets/js/course_add.js")
        );


        /*
        | ----------------------------------------------------------------------
        | Add css style at body
        | ----------------------------------------------------------------------
        | css code in the variable
        | $this->style_css = ".style{....}";
        |
        */
        $this->style_css = NULL;


        /*
        | ----------------------------------------------------------------------
        | Include css File
        | ----------------------------------------------------------------------
        | URL of your css each array
        | $this->load_css[] = asset("myfile.css");
        |
        */
        $this->load_css = array(
            asset("vendor/crudbooster/assets/summernote/summernote.css")
        );


    }


    /*
    | ----------------------------------------------------------------------
    | Hook for button selected
    | ----------------------------------------------------------------------
    | @id_selected = the id selected
    | @button_name = the name of button
    |
    */
    public function actionButtonSelected($id_selected, $button_name)
    {
        //Your code here

    }


    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate query of index result
    | ----------------------------------------------------------------------
    | @query = current sql query
    |
    */
    public function hook_query_index(&$query)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate row of index table html
    | ----------------------------------------------------------------------
    |
    */
    public function hook_row_index($column_index, &$column_value)
    {
        //Your code here
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before add data is execute
    | ----------------------------------------------------------------------
    | @arr
    |
    */
    public function hook_before_add(&$postdata)
    {
        //Your code here
        if (!empty($postdata['category_type'])) {
            $postdata['passing_percentage'] = !empty($postdata['passing_percentage']) ? $postdata['passing_percentage'] : 0;
        }

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after add public static function called
    | ----------------------------------------------------------------------
    | @id = last insert id
    |
    */
    public function hook_after_add($id)
    {

        //CRUDBooster::redirect('admin/courses', "The course has been added!", "info");

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before update data is execute
    | ----------------------------------------------------------------------
    | @postdata = input post data
    | @id       = current id
    |
    */
    public function hook_before_edit(&$postdata, $id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after edit public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_after_edit($id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command before delete public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_before_delete($id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after delete public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_after_delete($id)
    {
        //Your code here

    }

    //By the way, you can still create your own method in here... :)

    public function getIndex()
    {
        if (!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        $data = array();
        //Create your own query
        $category_id = 0;
        $condition = '>';
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
        }
        $course_title = '';
        if (isset($_GET['course_title'])) {
            $course_title = $_GET['course_title'];
        }
        $query = \DB::TABLE('courses as c');
        $query->JOIN('categories as cc', 'c.category_id', '=', 'cc.id');
        $query->select('c.*', 'cc.category_name');
        if (isset($category_id) && $category_id > 0) {
            $query->whereRaw("c.category_id = '" . $category_id . "'");
        }
        if (isset($course_title) && $course_title != '') {
            $query->where(DB::raw('c.course_title'), 'like', '%' . $course_title . '%');
        }

        $query->orderBy('c.created_at', 'DESC');
        $data['result'] = $query->paginate(100);
        $data['categories'] = DB::select("SELECT * FROM categories ORDER BY category_name");
        $data['category_id'] = $category_id;
        $data['course_title'] = $course_title;
        $this->cbView('admin_courses_list', $data);
    }

    public function getAdd()
    {
        $data = array();
        $data['categories'] = DB::select("SELECT * FROM categories ORDER BY category_name");
        $this->cbView('admin_add_new_course', $data);
    }

    public function postAddSave()
    {
        //Create an Auth
        if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
        }

        $param_rules = [
            "category_id" => ["required"],
            "course_title" => ["required"]
        ];

        if(!empty($_POST['course_type']) && $_POST['course_type'] == 'quiz'){
            $param_rules["passing_percentage"] = ["required","numeric","min:0","not_in:0"];
        }

        $params = ["category_id" => $_POST['category_id'] , "course_title" =>$_POST['course_title'], "passing_percentage" => $_POST['passing_percentage']];
        $validator = \Validator::make($params, $param_rules);

        if($validator->fails()){
            return back()->withInput($params)->withErrors($validator->errors());
        }
        $Course = new Course();
        $Course->category_id = $_POST['category_id'];
        $Course->course_type = !empty($_POST['course_type']) ? $_POST['course_type'] : "video";
        $Course->passing_percentage = !empty($_POST['passing_percentage'])  ? $_POST['passing_percentage'] : 0;
        $Course->course_title = $_POST['course_title'];
        $Course->spanish_course_title = $_POST['spanish_course_title'];
        $Course->save();

        CRUDBooster::redirect('admin/courses', "The course has been added!", "info");
    }

    public function getEditCourse($id)
    {
        //Create an Auth
        if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }
        $param_rules['parent'] = 'required';
        $param_rules['category_name'] = 'required|string|min:3|max:70';
        $data = array();
        $data['categories'] = DB::select("SELECT * FROM categories order by category_name");
        $data['page_title'] = 'Edit Data';
        $res = DB::select("SELECT * FROM courses WHERE id = " . $id);
        $data['row'] = $res[0];
        $this->cbView('admin_edit_course', $data);
    }

    public function getPublishUnpublish($status, $id)
    {
        //Create an Auth
        if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }
        $data = [
            'is_publish' => $status
        ];
        $obj = Course::where(['id' => $id])->update($data);
        //CRUDBooster::redirect(CRUDBooster::mainpath("contractcategories"),"The data has been updated !","info");
        if ($status == 1) {
            $user = \Illuminate\Support\Facades\DB::select("SELECT * FROM user WHERE device_token != '' ");
            $course = \DB::table('courses')->where('id', $id)->first();
            if (isset($user) && count($user) > 0) {
                foreach ($user as $userData) {
                    //$notification_settings = DB::select("SELECT * FROM notification_settings WHERE user_id = '".$userData->id."'");
                    //if(isset($notification_settings[0])){
                    //if(isset($notification_settings[0]->is_notification_on) && $notification_settings[0]->is_notification_on == 1){

                    //$actor = \DB::table('user')->where('id', 1)->first();
                    $target = \DB::table('user')->where('id', $userData->id)->first();
                    if (isset($target->id)) {
                        $notification_data = [
                            //'actor' => $actor,
                            'target' => $target,
                            'title' => "New course added",
                            'message' => (!empty($target->language_id) && $target->language_id == 1) ? $course->course_title : $course->spanish_course_title,
                            'reference_id' => $id,
                            'reference_module' => 'New Course',
                            'redirect_link' => NULL,
                        ];
                        $custom_data = [
                            'course_id' => $id,
                            'target_id' => $target->id,
                            'actor_id' => 0,
                            'identifier' => 'new_course',
                            //'redirect_link' => NULL,
                            //'image' => !empty($actor->image_url) ? \URL::to($actor->image_url) : \URL::to('images/user-placeholder.png'),
                            //'lastMsg' => "chat_message",
                            //'name' => $actor->name,
                        ];

                        Notification::sendPushNotification('new_course', $notification_data, $custom_data);
                    }
                    //}

                    //}
                }
            }
        }
        if ($status == 0) {
            CRUDBooster::redirect('admin/courses', "The course has been Unpublished !", "info");
        } else {
            CRUDBooster::redirect('admin/courses', "A new course has been added successfully !", "info");

        }

    }

    public function postCourseEditSave($id, \Illuminate\Http\Request $request)
    {


//Create an Auth
        if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        $data = [
            'category_id' => $request['category_id'],
            'passing_percentage' => $request['passing_percentage'],
            'course_title' => $request['course_title'],
            'spanish_course_title' => $request['spanish_course_title'],
        ];
        $obj = Course::where(['id' => $request->id])->update($data);
        //CRUDBooster::redirect(CRUDBooster::mainpath("contractcategories"),"The data has been updated !","info");
        CRUDBooster::redirect('admin/courses', "The data course been updated !", "info");

    }

    public function getCourseContents($id)
    {

        if (!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        $data = array();
        //Create your own query
        $language_id = 0;
        $condition = '>';
        if (isset($_GET['language_id'])) {
            $language_id = $_GET['language_id'];
        }
        $course_title = '';
        if (isset($_GET['course_title'])) {
            $course_title = $_GET['course_title'];
        }
        $query = \DB::TABLE('language_to_courses as ltc');
        $query->JOIN('courses as c', 'ltc.course_id', '=', 'c.id');
        $query->JOIN('languages as l', 'ltc.language_id', '=', 'l.id');
        $query->select('ltc.*', 'l.language_name');
        if (isset($language_id) && $language_id > 0) {
            $query->whereRaw("ltc.language_id = '" . $language_id . "'");
        }
        if (isset($course_title) && $course_title != '') {
            $query->where(DB::raw('ltc.course_name'), 'like', '%' . $course_title . '%');
        }
        $query->whereRaw("ltc.course_id = '" . $id . "'");

        $query->orderBy('ltc.id', 'DESC');
        $data['result'] = $query->paginate(100);
        $data['languages'] = DB::select("SELECT * FROM languages ORDER BY language_name");
        $data['language_id'] = $language_id;
        $data['course_title'] = $course_title;
        $data['id'] = $id;
        $this->cbView('admin_course_contents', $data);
    }

    public function getAddCourseContents($course_id)
    {
        $data = array();
        $data['languages'] = DB::select("SELECT * FROM languages ORDER BY language_name");
        $data['course'] = Course::where("courses.id",$course_id)->first();
        $this->cbView('admin_add_course_contents', $data);
    }

    public function postAddSaveCourseContents(\Illuminate\Http\Request $request)
    {

        $param_rules = [
            "language_id" => ["required"],
            "course_name" => ["required"],
            "video_heading" => ["required"],
            "video_description" => ["required"],
            "course_id" => ["required"],
            "video_file" => ["required"]
        ];

        if (!empty($request->course_type) && in_array($request->course_type, ["quiz"])) {
            $param_rules["course_certificate_title"] = ["required"];
            $param_rules["course_certificate_file"] = ["required"];
        }

        $validator = \Validator::make($request->all(), $param_rules);

        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator->errors());
        }

        $LanguageToCourse = new LanguageToCourse();
        $LanguageToCourse->course_type = !empty($request->course_type) ? $request->course_type : "quiz";
        $LanguageToCourse->course_id = $request->course_id;
        $LanguageToCourse->language_id = $request->language_id;
        $LanguageToCourse->course_name = $request->course_name;
        $LanguageToCourse->video_heading = $request->video_heading;
        $LanguageToCourse->video_description = $request->video_description;
        $LanguageToCourse->save();


        if ($request->hasFile('video_file')) {
            $this->__uploadMedia($LanguageToCourse->id, $request->file('video_file'), $request['_parts']);
        }

        if ($request->hasFile('course_certificate_file')) {
            // $obj is model
            $random = substr(sha1(rand()), 0, 20);
            $course_certificate_file = $this->__moveUploadFile(
                $request->file('course_certificate_file'),
                $LanguageToCourse->id . $random,
                Config::get('constants.MEDIA_IMAGE_PATH')
            );

            $CourseCertificate = new CourseCertificate();
            $CourseCertificate->course_id = Input::get('course_id');
            $CourseCertificate->language_id = Input::get('language_id');
            $CourseCertificate->course_certificate_title = Input::get('course_certificate_title');
            $CourseCertificate->course_certificate_file = $course_certificate_file;
            $CourseCertificate->save();
        }

        CRUDBooster::redirect('admin/courses/course-contents/' . Input::get('course_id'), "The course Contents has been added!", "info");
    }

    public function getEditCourseContents($id)
    {
        //Create an Auth
        if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }
        $data['languages'] = DB::select("SELECT * FROM languages order by language_name");
        $data['page_title'] = 'Edit Course Contents';
        $res = DB::select("SELECT * FROM language_to_courses WHERE id = " . $id);
        $course_certificates = DB::select("SELECT * FROM course_certificates WHERE language_id = '" . $res[0]->language_id . "' AND course_id = '" . $res[0]->course_id . "'");
        $data['row'] = $res[0];
        $data['course_certificates'] = $course_certificates[0];
        $this->cbView('admin_edit_course_contents', $data);
    }

    public function postCourseContentsEditSave($id, \Illuminate\Http\Request $request)
    {


//Create an Auth
        if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }
        $data = [
            'language_id' => $request['language_id'],
            'course_name' => $request['course_name'],
            'video_heading' => $request['video_heading'],
            'video_description' => $request['video_description'],
        ];
        $obj = LanguageToCourse::where(['id' => $request->id])->update($data);
        if ($request->hasFile('video_file')) {
            $uploadedImagesIDs = $this->__uploadMedia($request->id, $request->file('video_file'), $request['_parts']);
        }

        \Illuminate\Support\Facades\DB::select("DELETE FROM course_certificates WHERE language_id =  " . $request['language_id'] . " AND course_id =  " . $request['course_id'] . "");
        $random = substr(sha1(rand()), 0, 20);

        if (isset($_FILES['course_certificate_file']) && $_FILES['course_certificate_file']['name'] != '') {
            if ($request->hasFile('course_certificate_file')) {
                // $obj is model
                $course_certificate_file = $this->__moveUploadFile(
                    $request->file('course_certificate_file'),
                    $request->id . $random,
                    Config::get('constants.MEDIA_IMAGE_PATH')
                );
            }
        }
        $CourseCertificate = new CourseCertificate();
        $CourseCertificate->course_id = Input::get('course_id');
        $CourseCertificate->language_id = Input::get('language_id');
        $CourseCertificate->course_certificate_title = Input::get('course_certificate_title');
        $CourseCertificate->course_certificate_file = $course_certificate_file;
        $CourseCertificate->save();
        //CRUDBooster::redirect(CRUDBooster::mainpath("contractcategories"),"The data has been updated !","info");
        CRUDBooster::redirect('admin/courses/course-contents/' . $request['course_id'], "The course contents been updated !", "info");

    }

    protected function __uploadMedia($source_id, $mediaData, $exif = null)
    {
        $uploadPathForVideo = Config::get('constants.MEDIA_IMAGE_PATH');
        $uploadPathForImages = Config::get('constants.MEDIA_IMAGE_PATH');
        $thumbnailsPath = Config::get('constants.MEDIA_IMAGE_PATH');
        $uploadPathForGeneral = '/uploads/';
        $mediaCount = 0;
        $mediaIDs = [];
        foreach ($mediaData as $media) {

            if (
                $media->getMimeType() == 'video/mp4' ||
                $media->getMimeType() == 'video/quicktime' ||
                $media->getMimeType() == 'video/x-flv' ||
                $media->getMimeType() == 'application/x-mpegURL' ||
                $media->getMimeType() == 'video/MP2T' ||
                $media->getMimeType() == 'video/x-msvideo'
            ) {

                $uploadedVideo = $this->__moveUploadFile(
                    $media,
                    md5('video' . $mediaCount . time()),
                    $uploadPathForVideo
                );
                $thumbGenerated = "";
                $mediaIDs[] = $source_id;
                $thumbGenerated = Helper::generateThumbnail($uploadedVideo);

                LanguageToCourse::where('id', $source_id)->update([
                    'video_file_thumb' => $thumbGenerated,
                    'video_file' => $uploadedVideo
                ]);

                /* if ($request->hasfile('images')) {
                     foreach ($request->file('images') as $file) {
                         $thumbGenerated = $this->__moveUploadPropertyFileNew(
                             $file,
                             md5(rand() . time() . md5($mediaAddedToDB->id)),
                             Config::get('constants.USER_PROPERTY_IMAGE_PATH')
                         );

                     }
                 }*/
            }
            $mediaCount++;
        }

        return $mediaIDs;
    }

    protected function __moveUploadFile($obj_image, $title, $image_path, $is_public_path = true)
    {
        //$extension = $obj_image->getClientOriginalExtension();
        $mineType = explode('/', $obj_image->getClientMimeType());
        $ext = $obj_image->getClientOriginalExtension();
        //fileLogData("rrrr---{$ext}------ $mineType[0]  $mineType[1]","upload_file_jister_{$mineType[1]}");
        $extension = (isset($ext) && !empty($ext)) ? $ext : $mineType[1];
        //$extension = $obj_image->getClientOriginalExtension();
        if ($extension == "quicktime") {

            $name = str_slug($title) . '.' . "qt";
        } else {
            $name = str_slug($title) . '.' . $extension;
        }
        //$name = str_slug($title) . '.' . $extension;
        //$name = str_slug($title) . '.' .$name;
        $destinationPath = ($is_public_path) ? public_path($image_path) : storage_path($image_path);
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath);
        }
        $imagePath = $destinationPath . $name;

        $obj_image->move($destinationPath, $name);
        return $name;
    }

    public function getCourseDescriptions($id)
    {

        if (!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        $data = array();
        //Create your own query
        $language_id = 0;
        $condition = '>';
        if (isset($_GET['language_id'])) {
            $language_id = $_GET['language_id'];
        }
        $course_title = '';
        if (isset($_GET['course_title'])) {
            $course_title = $_GET['course_title'];
        }
        $query = \DB::TABLE('language_to_course_contents as ltcc');
        $query->JOIN('courses as c', 'ltcc.course_id', '=', 'c.id');
        $query->JOIN('languages as l', 'ltcc.language_id', '=', 'l.id');
        $query->select('ltcc.*', 'l.language_name');
        if (isset($language_id) && $language_id > 0) {
            $query->whereRaw("ltcc.language_id = '" . $language_id . "'");
        }
        if (isset($course_title) && $course_title != '') {
            $query->where(DB::raw('ltc.course_name'), 'like', '%' . $course_title . '%');
        }

        $query->whereRaw("ltcc.course_id = '" . $id . "'");

        $query->orderBy('ltcc.language_id', 'ASC');
        $data['result'] = $query->paginate(100);
        $data['languages'] = DB::select("SELECT * FROM languages ORDER BY language_name");
        $data['language_id'] = $language_id;
        $data['course_title'] = $course_title;
        $data['id'] = $id;
        $this->cbView('admin_course_descriptions', $data);
    }

    public function getAddCourseDescription($course_id)
    {
        $data = array();
        $data['languages'] = DB::select("SELECT * FROM languages ORDER BY language_name");
        $data['course_id'] = $course_id;
        $this->cbView('admin_add_course_description', $data);
    }

    public function postAddSaveCourseDescription(\Illuminate\Http\Request $request)
    {
        $LanguageToCourseContent = new LanguageToCourseContent();
        $LanguageToCourseContent->course_id = Input::get('course_id');
        $LanguageToCourseContent->language_id = Input::get('language_id');
        $LanguageToCourseContent->lecture_number = Input::get('lecture_number');
        $LanguageToCourseContent->lecture_heading = Input::get('lecture_heading');
        $LanguageToCourseContent->lecture_content = Input::get('lecture_content');
        $LanguageToCourseContent->save();
        CRUDBooster::redirect('admin/courses/course-descriptions/' . Input::get('course_id'), "The course description has been added!", "info");
    }

    public function getEditCourseDescription($id)
    {
        //Create an Auth
        if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }
        $data['languages'] = DB::select("SELECT * FROM languages order by language_name");
        $data['page_title'] = 'Edit Course Description';
        $res = DB::select("SELECT * FROM language_to_course_contents WHERE id = " . $id);

        $data['row'] = $res[0];
        $this->cbView('admin_edit_course_description', $data);
    }

    public function postCourseDescriptionEditSave($id, \Illuminate\Http\Request $request)
    {


//Create an Auth
        if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }
        $data = [
            'language_id' => $request['language_id'],
            'lecture_number' => $request['lecture_number'],
            'lecture_heading' => $request['lecture_heading'],
            'lecture_content' => $request['lecture_content'],
        ];
        $obj = LanguageToCourseContent::where(['id' => $request->id])->update($data);
        CRUDBooster::redirect('admin/courses/course-descriptions/' . $request['course_id'], "The course description been updated !", "info");

    }

    public function getDeleteCourse($id)
    {

        $courses = DB::select("SELECT * FROM courses WHERE id = '" . $id . "'");

        if (isset($courses) && count($courses) > 0) {
            foreach ($courses as $courses_item) {

                $course_quizzes = DB::select("SELECT * FROM course_quizzes WHERE course_id = '" . $courses_item->id . "'");
                if (isset($course_quizzes) && count($course_quizzes) > 0) {
                    foreach ($course_quizzes as $course_quizzes_item) {
                        DB::select("DELETE FROM user_quizzes WHERE course_quiz_id = '" . $course_quizzes_item->id . "'");
                    }
                }
                if (isset($course_quizzes) && count($course_quizzes) > 0) {
                    $quiz_questions = DB::select("SELECT * FROM quiz_questions WHERE course_id = '" . $courses_item->id . "'");
                    if (isset($quiz_questions) && count($quiz_questions) > 0) {
                        foreach ($quiz_questions as $quiz_questions_item) {
                            DB::select("DELETE FROM quiz_answers WHERE quiz_question_id = '" . $quiz_questions_item->id . "'");
                            DB::select("DELETE FROM user_quiz_question_statuses WHERE quiz_question_id = '" . $quiz_questions_item->id . "'");
                            DB::select("DELETE FROM user_quiz_answers WHERE quiz_question_id = '" . $quiz_questions_item->id . "'");

                        }
                    }
                    DB::select("DELETE FROM course_quizzes WHERE course_id = '" . $courses_item->id . "'");
                    DB::select("DELETE FROM quiz_questions WHERE course_id = '" . $courses_item->id . "'");
                    DB::select("DELETE FROM notification WHERE reference_id = '" . $courses_item->id . "'");
                    DB::select("DELETE FROM language_to_course_contents WHERE course_id = '" . $courses_item->id . "'");
                    DB::select("DELETE FROM language_to_courses WHERE course_id = '" . $courses_item->id . "'");
                    DB::select("DELETE FROM course_certificates WHERE course_id = '" . $courses_item->id . "'");
                    DB::select("DELETE FROM hospital_courses WHERE course_id = '" . $courses_item->id . "'");

                }
            }
            DB::select("DELETE FROM courses WHERE id = '" . $id . "'");
        }

        //\Illuminate\Support\Facades\DB::select("DELETE FROM categories WHERE id = '".$id."'");

        CRUDBooster::redirect($_SERVER['HTTP_REFERER'], "The Category has been deleted !", "info");
        //This will redirect back and gives a message
        ///CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"The status product has been updated !","info");
    }



    public function deleteContent($course_id,$id)
    {
        if(!empty($id)){
            LanguageToCourse::where("course_id",$course_id)->where("id",$id)->forceDelete();
            CourseCertificate::where("course_id",$course_id)->forceDelete();
        }
        CRUDBooster::redirect(url("admin/courses/course-contents/$id"), "The Course content has been deleted !", "info");
    }
}
