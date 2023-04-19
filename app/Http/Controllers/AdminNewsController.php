<?php namespace App\Http\Controllers;
	
	use App\Models\Notification;
	use App\Models\MailTemplate;
	use App\Models\Setting;
	use App\Models\User;
	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminNewsController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "news_title";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = false;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "news";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"News Title","name"=>"news_title"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'News Title','name'=>'news_title','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'News Description','name'=>'news_description','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'News Image','name'=>'news_image','type'=>'upload','validation'=>'required','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'News Title','name'=>'news_title','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'News Description','name'=>'news_description','type'=>'wysiwyg','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'News Image','name'=>'news_image','type'=>'upload','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
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
			
			$request = \Request::all();
			$users = User::where("user_type","physician")->whereIn("device_type",["ios","android"])->whereNotNull("device_token")->whereNull("deleted_at")->orderBy("id","DESC")->get();
                if (!empty($users)) {
                    foreach($users as $target){
                        $notification_data = [
                            'target' => $target,
                            'title' => !empty($request['news_title']) ? $request['news_title'] : "News Alert",
                            'message' => $request['news_description'],
                            'reference_id' => $id,
                            'reference_module' => "news",
                            'redirect_link' => NULL,
                        ];
                        $custom_data = [
                            'target_id' => $target->id,
                            'actor_id' => 0,
                            "news_id" => $id,
                            "hospital_id" => $target->hospital_id,
                            'identifier' => 'news_alert'
                        ];
    
                        Notification::sendPushNotification('news_alert', $notification_data, $custom_data,false,$target->device_type);
                    }
                }

			$hospitals = User::where("user_type","hospital")->whereNull("deleted_at")->orderBy("id","DESC")->get();
			if(!empty($hospitals)){
				foreach ($hospitals as $hospital){
					if(!empty($hospital->email)){
						$this->__sendMail("news_alert",$hospital->email,$request);
					}
				}
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
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :) 


		public function __sendMail($identifier, $to, $params)
        {

            $template = MailTemplate::getByIdentifier($identifier);

            $mail_subject = !empty($params["news_title"]) ? $params["news_title"] :$template->subject;
            $mail_body = !empty($params["news_description"]) ? $params["news_description"] : $template->body;
            $mail_wildcards = explode(',', $template->wildcards);
            $to = trim($to);
            $from = trim($template->from);
            if(empty($from))
                $from = Setting::getByKey('send_email')->value;


            $mail_wildcard_values = [];
            // foreach($mail_wildcards as $value) {
            //     $value = str_replace(['[',']'],'', $value);
            //     $mail_wildcard_values[] = $params[$value];
            // }

            // $mail_body = str_replace($mail_wildcards, $mail_wildcard_values, $mail_body);
            /*echo  "<pre>";
            print_r($mail_body);
            exit;*/

            $headers = "From: $from" . "\r\n" ;
            //$headers .= "CC: $cc";
            //mail($to, $mail_subject, $mail_body, $headers);
            try {
                //$from = env('MAIL_USERNAME');

                \Mail::send('emails.default_template', ['content' => $mail_body], function ($m) use ($to, $from, $mail_subject) {
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

	}