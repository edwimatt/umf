<?php namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\MailTemplate;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Session;
use Request;
use DB;
use CRUDBooster;

class AdminHospitalController extends \crocodicstudio\crudbooster\controllers\CBController
{

    public function cbInit()
    {

        # START CONFIGURATION DO NOT REMOVE THIS LINE
        $this->title_field = "name";
        $this->limit = "20";
        $this->orderby = "name,ASC";
        $this->global_privilege = false;
        $this->button_table_action = false;
        $this->button_bulk_action = false;
        $this->button_action_style = "button_icon";
        $this->button_add = false;
        $this->button_edit = false;
        $this->button_delete = false;
        $this->button_detail = false;
        $this->button_show = false;
        $this->button_filter = true;
        $this->button_import = false;
        $this->button_export = false;
        $this->table = "hospital";
        # END CONFIGURATION DO NOT REMOVE THIS LINE

        # START COLUMNS DO NOT REMOVE THIS LINE
        $this->col = [];
        $this->col[] = ["label" => "Name", "name" => "name"];
        # END COLUMNS DO NOT REMOVE THIS LINE

        # START FORM DO NOT REMOVE THIS LINE
        $this->form = [];
        $this->form[] = ['label' => 'Name', 'name' => 'name', 'type' => 'text', 'validation' => 'required|string|min:3|max:70', 'width' => 'col-sm-10', 'placeholder' => 'You can only enter the letter only'];
        # END FORM DO NOT REMOVE THIS LINE

        # OLD START FORM
        //$this->form = [];
        //$this->form[] = ["label"=>"Name","name"=>"name","type"=>"text","required"=>TRUE,"validation"=>"required|string|min:3|max:70","placeholder"=>"You can only enter the letter only"];
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
        //Your code here

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
        try {
            Hospital::deleteHospitalById($id);
        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
        }
    }

    public function getIndex()
    {
        if (!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        //Create your own query

        $data = [];
        $data['page_title'] = 'Hospitals';
        try {
            $result = User::getHospitals();
            $data['result'] = $result;
            $this->cbView('admin_hospital_list', $data);
        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
        }

    }

    public function getUserApprove($id)
    {

        if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }
        try {

            $data = [
                'is_approved' => '1',
            ];
            $obj = User::where(['id' => $id])->update($data);

            $user_data = DB::table('user')->where('id', $id)->first();
            $hospital_data = DB::table('hospital')->where('user_id', $id)->first();


            //Your code here
            //$mail_params['USER_NAME'] = name . ' ' . $data['last_name'];

            $mail_params['USER_NAME'] = $hospital_data->name;
            $mail_params['EMAIL'] = $data['email'];
            $mail_params['PASSWORD'] = $_POST['password'];
            //$mail_params['LOGIN_LINK'] = env('APP_URL')."/user/registration/$hash";
            //$mail_params['USER_LINK'] = env('APP_URL').'/user/login';
            $mail_params['APP_NAME'] = 'Understanding My Facility';

            $template = MailTemplate::getByIdentifier('user_registration_approve_email');


            $mail_subject = $template->subject;
            $mail_body = $template->body;
            $mail_wildcards = explode(',', $template->wildcards);
            $to = trim($user_data->email);
            $from = trim($template->from);

            if (empty($from))
                $from = Setting::getByKey('send_email')->value;
            $mail_wildcard_values = [];
            foreach ($mail_wildcards as $value) {
                $value = str_replace(['[', ']'], '', $value);
                $mail_wildcard_values[] = $mail_params[$value];
            }
            $mail_body = str_replace($mail_wildcards, $mail_wildcard_values, $mail_body);

            $logo = '<img style="width: 120px;" src="' . URL::to("image/logo.png") . '">';


            $mail_body = "<p>$logo</p><br/ ><p>Hi " . $hospital_data->name . ",</p>

  

          
            
            <p>Your account has been approved. Please login with your credentials.</p>
            <p><a href='" . url("user/login") . "' target='_blank'>Click here for user admin section</a> .</p>
            <p>OR</p>
            <p>Copy and paste the URL: " . url("user/login") . "</p>
            <p>Email address: " . $user_data->email . "</p>
            <p>Regards,</p>
            
            Understanding My Facility Team";


            $headers = "From: $from" . "\r\n";
            //$headers .= "CC: $cc";
            $headers .= "Content-Type: text/html";
            //($mail_body);
            //mail($to, $mail_subject, $mail_body, $headers);
            try {
                $from = env('MAIL_USERNAME');
                Mail::send('emails.default_template', ['content' => $mail_body], function ($m) use ($to, $from, $mail_subject) {
                    $m->from($from, env('APP_NAME'));
                    $m->to($to)->subject($mail_subject);
                });
            } catch (\Exception $e) {
                $headers .= "Content-Type: text/html";
                mail($to, $mail_subject, $mail_body, $headers);
            }

            CRUDBooster::redirectBack("The data has been updated!", "success");

        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
        }
    }

    public function getHospitalStatus($id)
    {

        if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }
        try {

            $obj = User::where(['id' => $id])->first();
            if (!empty($obj) && $obj->is_active == 1) {
                $status = 0;
            }
            else{
                $status = 1;
            }

            User::where(['id' => $id])->update(['is_active' => $status]);
            $statusText = ($status == 1) ? "Active" : "Deactivate";
            CRUDBooster::redirectBack("Hospital has been {$statusText}!", "success");

        } catch (\Exception $e) {
            $logger = new Logger('Exception_Logger');
            $filename = sprintf('%s/logs/%s__%s__exception.log', storage_path(), date('Ymd'), '');
            $logger->pushHandler(new StreamHandler($filename, Logger::DEBUG));
            $logger->info($e->getMessage());
            return $e->getMessage();
        }
    }

    //By the way, you can still create your own method in here... :)


}