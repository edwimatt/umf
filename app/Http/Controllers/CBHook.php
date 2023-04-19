<?php 
namespace App\Http\Controllers;

use crocodicstudio\crudbooster\helpers\CRUDBooster;
use DB;
use Session;
use Request;

class CBHook extends Controller {

	/*
	| --------------------------------------
	| Please note that you should re-login to see the session work
	| --------------------------------------
	|
	*/
	public function afterLogin() {
        if (CRUDBooster::isSuperadmin()) {
            return redirect('admin/statistic_builder/dashboard')->send();
        }

        $dashboard = CRUDBooster::sidebarDashboard();
        if ($dashboard && $dashboard->url) {
            return redirect('admin/statistic_builder/show/admin')->send();
            exit;
        }
	}
}