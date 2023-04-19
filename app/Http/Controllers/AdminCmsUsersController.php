<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDbooster;

class AdminCmsUsersController extends \crocodicstudio\crudbooster\controllers\CBController {


	public function cbInit() {
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->table               = 'cms_users';
		$this->primary_key         = 'id';
		$this->title_field         = "name";
		$this->button_action_style = 'button_icon';	
		$this->button_import 	   = FALSE;	
		$this->button_export 	   = FALSE;	
		# END CONFIGURATION DO NOT REMOVE THIS LINE
	
		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = array();
		$this->col[] = array("label"=>"Name","name"=>"name");
		$this->col[] = array("label"=>"Email","name"=>"email");
		$this->col[] = array("label"=>"Privilege","name"=>"id_cms_privileges","join"=>"cms_privileges,name");
		$this->col[] = array("label"=>"Photo","name"=>"photo","image"=>1);		
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = array(); 		
		$this->form[] = array("label"=>"Name","name"=>"name",'required'=>true,'validation'=>'required|alpha_spaces|min:3');
		$this->form[] = array("label"=>"Email","name"=>"email",'required'=>true,'type'=>'email','validation'=>'required|email|unique:cms_users,email,'.CRUDBooster::getCurrentId());		
		$this->form[] = array("label"=>"Photo","name"=>"photo","type"=>"upload","help"=>"Recommended resolution is 200x200px",'required'=>true,'validation'=>'required|image|max:1000','resize_width'=>90,'resize_height'=>90);											
		$this->form[] = array("label"=>"Privilege","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name",'required'=>true);						
		$this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Please leave empty if not change");



        # END FORM DO NOT REMOVE THIS LINE
				
	}

	public function getProfile() {			

		$this->button_addmore = FALSE;
		$this->button_cancel  = FALSE;
		$this->button_show    = FALSE;			
		$this->button_add     = FALSE;
		$this->button_delete  = FALSE;	
		$this->hide_form 	  = ['id_cms_privileges'];

		$data['page_title'] = trans("crudbooster.label_button_profile");
		$data['row']        = CRUDBooster::first('cms_users',CRUDBooster::myId());		
		//echo '<pre>'; print_r($data['row']); exit;
        $this->cbView('crudbooster::default.form',$data);
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


    /*
        | ----------------------------------------------------------------------
        | Hook for execute command after edit public static function called
        | ----------------------------------------------------------------------
        | @id       = current id
        |
        */
    public function hook_after_edit($id) {
        //Your code here
        $file_path = 'uploads/'.\CB::myId().'/'.date('Y-m');
        $params = Request::all();
        //echo '<pre>'; print_r($params); exit;
        session()->put('admin_name',$params['name']);
        if(Request::hasFile('photo')){
            $filename = str_replace('-','_',$params['photo']->getClientOriginalName());
            session()->put('admin_photo',\URL::to($file_path . '/' . $filename ));
        }else{
            session()->put('admin_photo',\URL::to($params['_photo']));
        }

    }

    public function getDeleteImage()
    {
        $this->cbLoader();
        $id = Request::get('id');
		$column = Request::get('column');

		$this->global_privilege = true;

        $row = DB::table($this->table)->where($this->primary_key, $id)->first();


        if (! CRUDBooster::isDelete() && $this->global_privilege == false) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_delete_image", [
                'name' => $row->{$this->title_field},
                'module' => CRUDBooster::getCurrentModule()->name,
            ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

        $row = DB::table($this->table)->where($this->primary_key, $id)->first();

        $file = str_replace('uploads/', '', $row->{$column});
        if (\Storage::exists($file)) {
            \Storage::delete($file);
		}
		
		

        \DB::table($this->table)->where($this->primary_key, $id)->update([$column => null]);
		
        CRUDBooster::insertLog(trans("crudbooster.log_delete_image", [
            'name' => $row->{$this->title_field},
            'module' => CRUDBooster::getCurrentModule()->name,
		]));
		
		

        session()->forget('admin_photo');
		
        CRUDBooster::redirect(Request::server('HTTP_REFERER'), trans('crudbooster.alert_delete_data_success'), 'success');
		die();
	}
}