<?php namespace App\Http\Controllers;

    use App\Models\Hospital;
    use App\Models\MailTemplate;
    use App\Models\Setting;
    use App\Models\User;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Config;

    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\URL;
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;
    use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminPhysiciansController extends \crocodicstudio\crudbooster\controllers\CBController {
        public $__baseController;
        public function cbInit() {

            $this->__baseController = new Controller();

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "first_name";
			$this->limit = "20";
			$this->orderby = "first_name,ASC";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "user";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"First Name","name"=>"first_name"];
			$this->col[] = ["label"=>"Email","name"=>"email"];
			$this->col[] = ["label"=>"Hospital","name"=>"hospital_id","join"=>"hospital,name"];
			$this->col[] = ["label"=>"Approve Status","name"=>"is_approved"];
			$this->col[] = ["label"=>"Created At","name"=>"created_at","callback_php"=>'date("d/m/Y",strtotime($row->created_at))'];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'First Name','name'=>'first_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Last Name','name'=>'last_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:255|email|unique:user','width'=>'col-sm-10','placeholder'=>'Please enter a valid email address'];
			$this->form[] = ['label'=>'Password','name'=>'password','type'=>'password','validation'=>'required|min:6|max:32','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Image Url','name'=>'image_url','type'=>'upload','validation'=>'nullable|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Mobile No','name'=>'mobile_no','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Hospital','name'=>'hospital_id','type'=>'select2','validation'=>'required|integer','width'=>'col-sm-9','datatable'=>'hospital,name'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'First Name','name'=>'first_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Last Name','name'=>'last_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:255|email|unique:user','width'=>'col-sm-10','placeholder'=>'Please enter a valid email address'];
			//$this->form[] = ['label'=>'Password','name'=>'password','type'=>'password','validation'=>'required|min:6|max:32','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Image Url','name'=>'image_url','type'=>'upload','validation'=>'nullable|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Mobile No','name'=>'mobile_no','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Hospital','name'=>'hospital_id','type'=>'select2','validation'=>'required|integer','width'=>'col-sm-9','datatable'=>'hospital,name'];
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
	        $this->alert        = array();
	                

	        
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
	        $this->script_js = NULL;


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
	        $this->load_js = array();
	        
	        
	        
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
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
            $query->where('user.user_type','=','physician');
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here
            if (isset($postdata['password'])) {
                $obj_controller = new \App\Http\Controllers\Controller();
                $postdata['password'] = $obj_controller->__encryptedPassword($_POST['password']);
                $postdata['user_group_id'] = 1;
                $postdata['token'] = User::getToken();
            }

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here
            $data = $this->arr;
            $obj_controller = new \App\Http\Controllers\Controller();
            $hash = $obj_controller->__generateUserHash($data['email']);

            if (isset($_FILES['image_url'])  && $_FILES['image_url']['name'] != "" ){
                $image_url=$_FILES['image_url']['name'];
                $expbanner=explode('.',$image_url);
                $bannerexptype=$expbanner[1];
                //date_default_timezone_set('Australia/Melbourne');
                $date = date('m/d/Yh:i:sa', time());
                $rand=rand(10000,99999);
                $encname=$date.$rand;
                $image_url=md5($encname).'.'.$bannerexptype;
                $image_name='uploads/user/'.$image_url;
                $image_url=public_path(Config::get('constants.USER_IMAGE_PATH')).$image_url;
                move_uploaded_file($_FILES["image_url"]["tmp_name"],$image_url);
                $postdata['image_url'] =$image_name;

            }else{
                //$image_name = 'uploads/default_user.png';
            }

            // update forgot password hash and update hash date
            User::where('id', $id)->Update([
                'forgot_password_hash' => $hash,
                'image_url' => $image_name,
                'forgot_password_hash_date' => Carbon::now()]);
            //Your code here
            $mail_params['USER_NAME'] = $data['first_name'] . ' ' . $data['last_name'];
            $mail_params['EMAIL'] = $data['email'];
            $mail_params['PASSWORD'] = $_POST['password'];
            //$mail_params['LOGIN_LINK'] = env('APP_URL')."/user/registration/$hash";
            //$mail_params['USER_LINK'] = env('APP_URL').'/user/login';
            $mail_params['APP_NAME'] = 'Physician Scheduling';

            $template = MailTemplate::getByIdentifier('user_registration_email');

            $mail_subject = $template->subject;
            $mail_body = $template->body;
            $mail_wildcards = explode(',', $template->wildcards);
            $to = trim($data['email']);
            $from = trim($template->from);
            if(empty($from))
                $from = Setting::getByKey('send_email')->value;
            $mail_wildcard_values = [];
            foreach($mail_wildcards as $value) {
                $value = str_replace(['[',']'],'', $value);
                $mail_wildcard_values[] = $mail_params[$value];
            }
            $mail_body = str_replace($mail_wildcards, $mail_wildcard_values, $mail_body);
            $logo = '<img width="250" src="'.URL::to("image/logo.png").'">';
            $mail_body = "<p>$logo</p><br/ ><p>Hey ".$mail_params['USER_NAME'].",</p>            
            <p>Your account has been created successfully at Physician Scheduling.</p>
            <p>Below are the login credentials.</p>
            <p>Email address: ".$mail_params['EMAIL']."</p>
            <p>Password: ".$mail_params['PASSWORD']."</p>
            
            <p>Thanks,</p>
            Physician Scheduling";
            /*print_r($mail_body);
            exit;*/
            $headers = "From: $from" . "\r\n" ;
            //$headers .= "CC: $cc";

            try {
                $from = env('MAIL_USERNAME');
                Mail::send('emails.default_template', ['content' => $mail_body], function ($m) use ($to, $from, $mail_subject) {
                    $m->from($from, env('APP_NAME'));
                    $m->to($to)->subject($mail_subject);
                });
            }catch (\Exception $e){
                $headers .= "Content-Type: text/html";
                mail($to, $mail_subject, $mail_body, $headers);
            }
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

            try {
                if (isset($_FILES['image_url'])  && $_FILES['image_url']['name'] != "" ){
                    $obj_controller = new \App\Http\Controllers\Controller();
                    $postdata['password'] = $obj_controller->__encryptedPassword($_POST['password']);
                    $postdata['user_group_id'] = 1;
                    $postdata['token'] = User::getToken();

                    if (isset($_FILES['image_url'])  && $_FILES['image_url']['name'] != "" ){
                        $image_url=$_FILES['image_url']['name'];
                        $expbanner=explode('.',$image_url);
                        $bannerexptype=$expbanner[1];
                        //date_default_timezone_set('Australia/Melbourne');
                        $date = date('m/d/Yh:i:sa', time());
                        $rand=rand(10000,99999);
                        $encname=$date.$rand;
                        $image_url=md5($encname).'.'.$bannerexptype;
                        $image_name='uploads/user/'.$image_url;
                        $image_url=public_path(Config::get('constants.USER_IMAGE_PATH')).$image_url;
                        move_uploaded_file($_FILES["image_url"]["tmp_name"],$image_url);
                        $postdata['image_url'] =$image_name;

                    }else{
                        $image_name='uploads/default_user.png';
                    }
                }
            } catch (\Exception $e) {
                $logger = new Logger('Exception_Logger');
                $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
                $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
                $logger->info($e->getMessage());
                return $e->getMessage();
            }
           }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
            try {
                User::deletePhysicianData($id);
            } catch (\Exception $e) {
                $logger = new Logger('Exception_Logger');
                $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
                $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
                $logger->info($e->getMessage());
                return $e->getMessage();
            }
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
            try {
                User::deletePhysicianDataAfter($id);
            } catch (\Exception $e) {
                $logger = new Logger('Exception_Logger');
                $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
                $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
                $logger->info($e->getMessage());
                return $e->getMessage();
            }
	    }

        public function getEdit($id) {
            //Create an Auth
            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            try {
                $data['hospital'] = Hospital::getHospitalList();
                $data['page_title'] = 'Edit Physician';
                $data['row'] = DB::table('user')->where('id',$id)->first();
                $this->cbView('custom_edit_view',$data);
            } catch (\Exception $e) {
                $logger = new Logger('Exception_Logger');
                $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
                $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
                $logger->info($e->getMessage());
                return $e->getMessage();
            }


        }
	    //By the way, you can still create your own method in here... :)

        public function postEditSavee($id, \Illuminate\Http\Request $request) {
            //Create an Auth
            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }
            try {

                $data = [
                    'first_name'    => $request['first_name'],
                    'last_name'     => $request['last_name'],
                    'mobile_no'     => $request['mobile_no'],
                ];
                $obj = User::where(['id' => $request->id])->update($data);
                CRUDBooster::redirect('admin/physicians',"The user has been updated !","info");

            } catch (\Exception $e) {
                $logger = new Logger('Exception_Logger');
                $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
                $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
                $logger->info($e->getMessage());
                return $e->getMessage();
            }

        }

        public function getUserApprove($id){

            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }
            try {


                $data = [
                    'is_approved'     => '1',
                ];
                $obj = User::where(['id' => $id])->update($data);



                //Your code here
                $mail_params['USER_NAME'] = $data['first_name'] . ' ' . $data['last_name'];
                $mail_params['EMAIL'] = $data['email'];
                $mail_params['PASSWORD'] = $_POST['password'];
                //$mail_params['LOGIN_LINK'] = env('APP_URL')."/user/registration/$hash";
                //$mail_params['USER_LINK'] = env('APP_URL').'/user/login';
                $mail_params['APP_NAME'] = 'Physician Scheduling';

                $template = MailTemplate::getByIdentifier('user_registration_approve_email');

                $user_data = DB::table('user')->where('id',$id)->first();

                $mail_subject = $template->subject;
                $mail_body = $template->body;
                $mail_wildcards = explode(',', $template->wildcards);
                $to = trim($user_data->email);
                $from = trim($template->from);

                if(empty($from))
                    $from = Setting::getByKey('send_email')->value;
                $mail_wildcard_values = [];
                foreach($mail_wildcards as $value) {
                    $value = str_replace(['[',']'],'', $value);
                    $mail_wildcard_values[] = $mail_params[$value];
                }
                $mail_body = str_replace($mail_wildcards, $mail_wildcard_values, $mail_body);
                $logo = '<img width="250" src="'.URL::to("image/logo.png").'">';


                $mail_body = "<p>$logo</p><br/ ><p>Hi ".$user_data->first_name.",</p>
  

          
            
            <p>Your account has been approved and created successfully. Please login with your credentials.</p>
            <p>Email address: ".$user_data->email."</p>
            <p>Regards,</p>
            
            Physician Scheduling Team";

                $headers = "From: $from" . "\r\n" ;
                //$headers .= "CC: $cc";
                $headers .= "Content-Type: text/html";
                //mail($to, $mail_subject, $mail_body, $headers);
                try {
                    $from = env('MAIL_USERNAME');
                    Mail::send('emails.default_template', ['content' => $mail_body], function ($m) use ($to, $from, $mail_subject) {
                        $m->from($from, env('APP_NAME'));
                        $m->to($to)->subject($mail_subject);
                    });
                }catch (\Exception $e){
                    $headers .= "Content-Type: text/html";
                    mail($to, $mail_subject, $mail_body, $headers);
                }

                CRUDBooster::redirectBack("The data has been updated!", "success");

                CRUDBooster::redirectBack('admin/physicians',"The user has been updated !","info");

            } catch (\Exception $e) {
                $logger = new Logger('Exception_Logger');
                $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
                $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
                $logger->info($e->getMessage());
                return $e->getMessage();
            }
        }
        public function getDetail($id){

            try {
                $data['page_title'] = 'Edit Physician';
                $data = [];
                $data['result'] = [];
                $data['user_id'] = $id;
                $this->cbView('admin_user_show',$data);
            } catch (\Exception $e) {
                $logger = new Logger('Exception_Logger');
                $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
                $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
                $logger->info($e->getMessage());
                return $e->getMessage();
            }
        }

        public function __sendMail($identifier, $to, $params)
        {

            $template = MailTemplate::getByIdentifier($identifier);

            $mail_subject = $template->subject;
            $mail_body = $template->body;
            $mail_wildcards = explode(',', $template->wildcards);
            $to = trim($to);
            $from = trim($template->from);
            if(empty($from))
                $from = Setting::getByKey('send_email')->value;


            $mail_wildcard_values = [];
            foreach($mail_wildcards as $value) {
                $value = str_replace(['[',']'],'', $value);
                $mail_wildcard_values[] = $params[$value];
            }

            $mail_body = str_replace($mail_wildcards, $mail_wildcard_values, $mail_body);
            /*echo  "<pre>";
            print_r($mail_body);
            exit;*/

            $headers = "From: $from" . "\r\n" ;
            //$headers .= "CC: $cc";
            mail($to, $mail_subject, $mail_body, $headers);
            try {
                //$from = env('MAIL_USERNAME');

                Mail::send('emails.default_template', ['content' => $mail_body], function ($m) use ($to, $from, $mail_subject) {
                    $m->from($from, env('APP_NAME'));
                    $m->to($to)->subject($mail_subject);
                });
            }catch (\Exception $e){
                //print $e->getMessage();
                $headers .= "Content-Type: text/html";
                mail($to, $mail_subject, $mail_body, $headers);
            }

            return true;
        }
        public function getIndex() {
            if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            //Create your own query
            $department_id = 0;
            $hospital_id = 0;
            $condition = '>';
            if(isset($_GET['hospital_id']))
            {
                $hospital_id = $_GET['hospital_id'];

            }
            if(isset($_GET['department_id ']))
            {
                $department_id = $_GET['department_id'];

            }
            $name = '';
            $from_date = '';
            $to_date = '';
            $leave_status = '';
            $status = '';

            if(isset($_GET['name']))
            {
                $name = $_GET['name'];
            }
            if(isset($_GET['from_date']))
            {
                $from_date = $_GET['from_date'];
            }
            if(isset($_GET['from_date']))
            {
                $to_date = $_GET['to_date'];
            }

            if(isset($_GET['leave_status']))
            {
                $leave_status = $_GET['leave_status'];
            }

            if(isset($_GET['status']))
            {
                $status = $_GET['status'];

            }
            $data = [];
            $data['page_title'] = 'Users';
            try {
                $result = User::getPhysicianList2();
                $data['result'] = $result;
                $data['from_date'] = $from_date;
                $data['to_date'] = $to_date;
                $data['leave_status'] = $leave_status;
                $data['name'] = $name;

                $data['hospital_id'] = $hospital_id;
                $data['status'] = $status;
                $this->cbView('admin_user_list',$data);
            } catch (\Exception $e) {
                $logger = new Logger('Exception_Logger');
                $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
                $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
                $logger->info($e->getMessage());
                return $e->getMessage();
            }

        }
	}