<?php namespace App\Http\Controllers;

use App\Models\Category;
use Session;
use Request;
use DB;
use CRUDBooster;

class AdminCategoriesController extends \crocodicstudio\crudbooster\controllers\CBController
{

    public function cbInit()
    {

        # START CONFIGURATION DO NOT REMOVE THIS LINE
        $this->title_field = "category_name";
        $this->limit = "20";
        $this->orderby = "id,desc";
        $this->global_privilege = false;
        $this->button_table_action = true;
        $this->button_bulk_action = true;
        $this->button_action_style = "button_icon";
        $this->button_add = true;
        $this->button_edit = true;
        $this->button_delete = false;
        $this->button_detail = true;
        $this->button_show = true;
        $this->button_filter = true;
        $this->button_import = false;
        $this->button_export = false;
        $this->table = "categories";
        # END CONFIGURATION DO NOT REMOVE THIS LINE

        # START COLUMNS DO NOT REMOVE THIS LINE
        $this->col = [];
        $this->col[] = ["label" => "Parent Id", "name" => "parent_id", "join" => "parent,id"];
        $this->col[] = ["label" => "Category Name", "name" => "category_name"];
        $this->col[] = ["label" => "Short Name", "name" => "short_name"];
        $this->col[] = ["label" => "Display Order", "name" => "display_order"];
        # END COLUMNS DO NOT REMOVE THIS LINE

        # START FORM DO NOT REMOVE THIS LINE
        $this->form = [];
        $this->form[] = ['label' => 'Parent Id', 'name' => 'parent_id', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'parent,id'];
        $this->form[] = ['label' => 'Category Name', 'name' => 'category_name', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Short Name', 'name' => 'short_name', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Display Order', 'name' => 'display_order', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
        # END FORM DO NOT REMOVE THIS LINE

        # OLD START FORM
        //$this->form = [];
        //$this->form[] = ["label"=>"Parent Id","name"=>"parent_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"parent,id"];
        //$this->form[] = ["label"=>"Category Name","name"=>"category_name","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
        //$this->form[] = ["label"=>"Short Name","name"=>"short_name","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
        //$this->form[] = ["label"=>"Display Order","name"=>"display_order","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
            $('.textarea_content').summernote({focus: false,
                height: 300,
                codemirror: { 'theme': 'ambiance' },  
                toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['color', ['color']],
                        ['fontsize', ['fontsize']],
                        ['para', ['ul', 'ol', 'paragraph']]
                    ]
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
        $postdata['category_name'] = ucfirst($postdata['category_name']);
        $postdata['spanish_category_name'] = ucfirst($postdata['spanish_category_name']);
        $postdata['spanish_description'] = $postdata['spanish_description'];


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


        $data = [
            'parent_id' => 0,
            'category_name' => addslashes($_POST['category_name']),
            'passing_percentage' => addslashes($_POST['passing_percentage']),
            'course_title' => addslashes($_POST['course_title']),
        ];
        $obj = Category::where(['id' => $id])->update($data);
        //CRUDBooster::redirect(CRUDBooster::mainpath("contractcategories"),"The data has been updated !","info");
        CRUDBooster::redirect('admin/categories', "The course has been added !", "info");

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
        $postdata['category_name'] = ucfirst($postdata['category_name']);
        $postdata['spanish_category_name'] = ucfirst($postdata['spanish_category_name']);
        $postdata['spanish_description'] = $postdata['spanish_description'];

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
        {
            //$categories = BusinessCategory::getBusinessCategories();

            $query = \Illuminate\Support\Facades\DB::table('categories as C');
            $query->select('C.id', 'C.category_name', 'C.short_name', DB::raw('(SELECT P.category_name FROM categories as P WHERE P.id = C.parent_id) AS parent_name'));
            //$query->orderBy('C.category_name', 'asc');
            $categories = $query->paginate(200);
            $data = array();
            $data['page_title'] = 'Categories';
            $data['categories'] = $categories;

            $this->cbView('admin_categories_list', $data);
        }
    }

    //By the way, you can still create your own method in here... :)
    public function getAdd()
    {
        //$param_rules['parent']         = 'required';
        $param_rules['category_name'] = 'required|string|min:3|max:70';
        $data = array();

        $data['categories'] = DB::select("SELECT * FROM categories order by category_name");
        $this->cbView('custom_add_view', $data);

    }


    public function getEditCategory($id)
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
        $res = DB::select("SELECT * FROM categories WHERE 1 = 1 AND id = " . $id);
        $data['row'] = $res[0];
        //$data['row'] = DB::table('categories')->where('id',$id)->first();
        //Please use cbView method instead view method from laravel
        $this->cbView('custom_edit_view', $data);
    }

    public function postCustomEditSave($id, \Illuminate\Http\Request $request)
    {


        //Create an Auth
        if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        $data = [
            //'parent_id'    => $request['parent_id'],
            'category_name' => $request['category_name'],
            'spanish_category_name' => $request['spanish_category_name'],
            'spanish_description' => $request['spanish_description'],
            'description' => $request['description'],
            //'certificate_requirement'     => $request['certificate_requirement'],
            //'certificate_confirmation'     => $request['certificate_confirmation'],
        ];
        $obj = Category::where(['id' => $request->id])->update($data);
        //CRUDBooster::redirect(CRUDBooster::mainpath("contractcategories"),"The data has been updated !","info");
        CRUDBooster::redirect('admin/categories', "The data has been updated !", "info");

        $param_rules['parent'] = 'required';
        $param_rules['category_name'] = 'required|string|min:3|max:70';
        $data = array();
        $data['categories'] = DB::select("SELECT * FROM categories order by category_name");
        $data['page_title'] = 'Edit Data';
        $data['row'] = DB::table('categories')->where('id', $id)->first();
        //Please use cbView method instead view method from laravel
        $this->cbView('custom_edit_view', $data);
    }

    public function postSaveData(\Illuminate\Http\Request $request)
    {
        //Create an Auth
        if (!CRUDBooster::isUpdate() && $this->global_privilege == FALSE || $this->button_edit == FALSE) {
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        $param_rules = [
            "category_type" => ["required"],
            "category_name" => ["required"]
        ];

        $validator = \Validator::make($request->all(), $param_rules);

        if ($validator->fails()) {
            return back()->withInput($request->all())->withErrors($validator->errors());
        }

        $data = [
            'parent_id' => $request['parent_id'],
            'category_name' => $request['category_name'],
            'spanish_category_name' => $request['spanish_category_name'],
            'spanish_description' => $request['spanish_description'],
            'short_name' => $request['short_name'],
            'description' => $request['description'],
            'certificate_requirement' => $request['certificate_requirement'],
            'certificate_confirmation' => $request['certificate_confirmation'],
        ];
        $Category = new Category();
        $Category->category_type = !empty($request['category_type']) ? $request['category_type'] : NULL;
        $Category->parent_id = 0;
        $Category->category_name = $request['category_name'];
        $Category->short_name = $request['short_name'];
        $Category->description = $request['description'];
        $Category->certificate_requirement = $request['certificate_requirement'];
        $Category->certificate_confirmation = $request['certificate_confirmation'];
        $Category->save();
        //$obj = Category::where(['id' => $request->id])->update($data);
        //CRUDBooster::redirect(CRUDBooster::mainpath("contractcategories"),"The data has been updated !","info");
        CRUDBooster::redirect('admin/categories', "The data has been addedd !", "info");

        $param_rules['parent'] = 'required';
        $param_rules['category_name'] = 'required|string|min:3|max:70';
        $data = array();
        $data['categories'] = DB::select("SELECT * FROM categories order by category_name");
        $data['page_title'] = 'Edit Data';
        $data['row'] = DB::table('categories')->where('id', $id)->first();
        //Please use cbView method instead view method from laravel
        $this->cbView('custom_edit_view', $data);
    }

    public function getDeleteCategory($id)
    {

        $courses = DB::select("SELECT * FROM courses WHERE category_id = '" . $id . "'");
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
        }

        \Illuminate\Support\Facades\DB::select("DELETE FROM categories WHERE id = '" . $id . "'");

        CRUDBooster::redirect($_SERVER['HTTP_REFERER'], "The Category has been deleted !", "info");
        //This will redirect back and gives a message
        ///CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"The status product has been updated !","info");
    }

}
