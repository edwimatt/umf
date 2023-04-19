<?php namespace App\Http\Controllers;

	use App\Http\Resources\CourseQuiz;
    use App\Models\QuizAnswer;
    use App\Models\QuizQuestion;
    use Illuminate\Support\Facades\Input;
	use DB;
	use CRUDBooster;

	class AdminCourseQuizzesController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "course_quiz_title";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = false;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = false;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "course_quizzes";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Course Id","name"=>"course_id","join"=>"course,id"];
			$this->col[] = ["label"=>"Course Quiz Title","name"=>"course_quiz_title"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Course Id','name'=>'course_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'course,id'];
			$this->form[] = ['label'=>'Course Quiz Title','name'=>'course_quiz_title','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Course Id","name"=>"course_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"course,id"];
			//$this->form[] = ["label"=>"Course Quiz Title","name"=>"course_quiz_title","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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


            CRUDBooster::redirect('admin/course_quizzes',"The course quiz has been added!","info");

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
        //
        //
        public function getIndex() {
            if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));

            $data = array();
            //Create your own query
            $course_id = 0;
            $condition = '>';
            if(isset($_GET['course_id'])) {
                $course_id = $_GET['course_id'];
            }
            $course_quiz_title = '';
            if(isset($_GET['course_quiz_title'])) {
                $course_quiz_title = $_GET['course_quiz_title'];
            }
            $query = \DB::table('course_quizzes as cq');
            $query ->leftJoin('courses as c', 'cq.course_id', '=', 'c.id');
            $query ->leftJoin('categories as cat', 'cat.id', '=', 'c.category_id');
            $query->select('cq.*','c.course_title');
            if(isset($course_id) && $course_id > 0){
                $query->whereRaw("cq.course_id = '".$course_id. "'");
            }
            if(isset($course_quiz_title) && $course_quiz_title != ''){
                $query->where(DB::raw('cq.course_quiz_title'), 'like', '%'.$course_quiz_title.'%');
            }
            $query->where('cat.category_type', 'quiz');
            $query->orderBy('cq.id', 'DESC');
            $data['result'] = $query->paginate(100);
            $data['courses'] = DB::select("SELECT * FROM courses WHERE course_type = 'quiz' ORDER BY course_title");
            $data['course_id'] = $course_id;
            $data['course_quiz_title'] = $course_quiz_title;
            $this->cbView('admin_course_quizzes',$data);
        }

        public function getAdd(){
            $data = array();
            $data['courses'] = DB::select("SELECT * FROM courses WHERE course_type = 'quiz' ORDER BY course_title");
            $this->cbView('admin_add_new_quiz',$data);
        }

        public function postSaveData(\Illuminate\Http\Request $request){
            $CourseQuiz = new CourseQuiz();
            $CourseQuiz->category_id = $_POST['category_id'];
            $CourseQuiz->passing_percentage = $_POST['passing_percentage'];
            $CourseQuiz->course_title = $_POST['course_title'];
            $CourseQuiz->save();
        }

        public function getEditQuiz($id) {
            //Create an Auth
            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }
            $param_rules['parent']         = 'required';
            $param_rules['category_name'] = 'required|string|min:3|max:70';
            $data = array();
            $data['courses'] = DB::select("SELECT * FROM courses WHERE course_type = 'quiz' ORDER BY course_title");
            $data['page_title'] = 'Edit Data';
            $res = DB::select("SELECT * FROM course_quizzes WHERE id = ".$id);
            $data['row'] = $res[0];
            $this->cbView('admin_edit_quiz',$data);
        }

        public function postQuizEditSave($id, \Illuminate\Http\Request $request) {


//Create an Auth
            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $data = [
                'course_id'    => $request['course_id'],
                'course_quiz_title'     => $request['course_quiz_title'],
            ];
            $obj = \App\Models\CourseQuiz::where(['id' => $request->id])->update($data);
            //CRUDBooster::redirect(CRUDBooster::mainpath("contractcategories"),"The data has been updated !","info");
            CRUDBooster::redirect('admin/course_quizzes',"The course quiz been updated !","info");

        }

        public function getQuizQuestions($id) {

            if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            $data = array();
            //Create your own query
            $language_id = 0;
            $condition = '>';
            if(isset($_GET['language_id'])) {
                $language_id = $_GET['language_id'];
            }
            $question_title = '';
            if(isset($_GET['question_title'])) {
                $question_title = $_GET['question_title'];
            }
            $query = \DB::TABLE('quiz_questions as qq');
            $query ->JOIN('course_quizzes as cq', 'qq.course_quiz_id', '=', 'cq.id');
            $query ->JOIN('languages as l', 'qq.language_id', '=', 'l.id');
            $query->select('qq.*','l.language_name');
            if(isset($language_id) && $language_id > 0){
                $query->whereRaw("qq.language_id = '".$language_id. "'");
            }
            if(isset($course_title) && $course_title != ''){
                $query->where(DB::raw('qq.course_name'), 'like', '%'.$course_title.'%');
            }

            $query->whereRaw("qq.course_quiz_id = '".$id. "'");

            $query->orderBy('qq.language_id', 'DESC');
            $data['result'] = $query->paginate(100);
            $data['languages'] = DB::select("SELECT * FROM languages ORDER BY language_name");
            $data['language_id'] = $language_id;
            $data['question_title'] = $question_title;
            $data['id'] = $id;
            $this->cbView('admin_quiz_questions',$data);
        }

        public function getAddQuizQuestion($course_quiz_id){
            $data = array();
            $data['languages'] = DB::select("SELECT * FROM languages ORDER BY language_name");
            $data['course_quiz_id'] = $course_quiz_id;
            $this->cbView('admin_add_quiz_question',$data);
        }

        public function postAddSaveQuestion(\Illuminate\Http\Request $request){

            $QuizQuestion = new QuizQuestion();

            $course_quizzes = DB::select("SELECT * FROM course_quizzes WHERE id = '".Input::get('course_quiz_id')."'");
            $QuizQuestion->course_quiz_id = Input::get('course_quiz_id');
            $QuizQuestion->language_id = Input::get('language_id');
            $QuizQuestion->course_id = $course_quizzes[0]->course_id;
            $QuizQuestion->question_option_title = Input::get('question_option_title');
            $QuizQuestion->question_title = Input::get('question_title');
            if(isset($_POST['is_multiple_choice_question']) && $_POST['is_multiple_choice_question'] == 1){
                $QuizQuestion->is_multiple_choice_question = Input::get('is_multiple_choice_question');
            }else{
                $QuizQuestion->is_multiple_choice_question = 0;
            }
            $QuizQuestion->save();
            CRUDBooster::redirect('admin/course_quizzes/quiz-questions/'.Input::get('course_quiz_id'),"The quiz question has been added!","info");
        }

        public function getEditQuizQuestion($id) {
            //Create an Auth
            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }
            $data = array();
            $data['languages'] = DB::select("SELECT * FROM languages order by language_name");
            $data['page_title'] = 'Edit Data';
            $res = DB::select("SELECT * FROM quiz_questions WHERE id = ".$id);
            $data['row'] = $res[0];
            $this->cbView('admin_edit_quiz_question',$data);
        }

        public function postQuestionEditSave($id, \Illuminate\Http\Request $request) {

//Create an Auth
            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $data = [
                'language_id'    => $request['language_id'],
                'question_option_title'     => $request['question_option_title'],
                'question_title'     => $request['question_title'],
                'is_multiple_choice_question'     => $request['is_multiple_choice_question'],
            ];
            $obj = QuizQuestion::where(['id' => $request->id])->update($data);
            //CRUDBooster::redirect(CRUDBooster::mainpath("contractcategories"),"The data has been updated !","info");
            CRUDBooster::redirect('admin/course_quizzes/quiz-questions/'.$request['course_quiz_id'],"The question been updated !","info");

        }

        public function getQuizAnswers($id,$language_id_value) {



            if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            $data = array();
            //Create your own query
            $language_id = 0;
            $condition = '>';
            if(isset($_GET['language_id'])) {

                $language_id = $_GET['language_id'];
            }
            $answer_title = '';
            if(isset($_GET['answer_title'])) {
                $answer_title = $_GET['answer_title'];
            }
            $query = \DB::TABLE('quiz_answers as qa');
            $query ->JOIN('quiz_questions as qq', 'qa.quiz_question_id', '=', 'qq.id');
            $query ->JOIN('languages as l', 'qa.language_id', '=', 'l.id');
            $query->select('qa.*','l.language_name');
            if(isset($language_id_value) && $language_id_value > 0){
                $query->whereRaw("qa.language_id = '".$language_id_value. "'");
            }
            if(isset($answer_title) && $answer_title != ''){
                $query->where(DB::raw('qa.answer_title'), 'like', '%'.$answer_title  .'%');
            }

            $query->whereRaw("qa.quiz_question_id = '".$id. "'");

            $query->orderBy('qa.language_id', 'DESC');
            $data['result'] = $query->paginate(100);
            $data['languages'] = DB::select("SELECT * FROM languages ORDER BY language_name");
            $data['language_id'] = $language_id_value;
            $data['answer_title'] = $answer_title;
            $data['id'] = $id;

            $this->cbView('admin_quiz_answers',$data);
        }

        public function getAddQuizAnswer($quiz_question_id,$language_id){
            $data = array();
            $data['languages'] = DB::select("SELECT * FROM languages ORDER BY language_name");
            $data['quiz_question_id'] = $quiz_question_id;
            $data['language_id'] = $language_id;
            $this->cbView('admin_add_quiz_answer',$data);
        }

        public function postAddSaveAnswer(\Illuminate\Http\Request $request){


            $QuizQuestion = new QuizAnswer();
            $QuizQuestion->quiz_question_id = Input::get('quiz_question_id');
            $QuizQuestion->language_id = Input::get('language_id');
            $QuizQuestion->answer_option_title = Input::get('answer_option_title');
            $QuizQuestion->answer_title = Input::get('answer_title');
            if(isset($_POST['is_correct_answer']) && $_POST['is_correct_answer'] == 1){
                $QuizQuestion->is_correct_answer = Input::get('is_correct_answer');
            }else{
                $QuizQuestion->is_correct_answer = 0;
            }
            $QuizQuestion->save();

            CRUDBooster::redirect('admin/course_quizzes/quiz-answers/'.Input::get('quiz_question_id')."/".Input::get('language_id'),"The quiz question has been added!","info");
        }

        public function getEditQuizAnswer($id,$language_id) {
            //Create an Auth
            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }
            $data = array();
            $data['languages'] = DB::select("SELECT * FROM languages order by language_name");
            $data['page_title'] = 'Edit Data';
            $res = DB::select("SELECT * FROM quiz_answers WHERE id = ".$id);
            $data['row'] = $res[0];
            $data['language_id'] = $language_id;
            $this->cbView('admin_edit_quiz_answer',$data);
        }

        public function postAnswerEditSave($id, \Illuminate\Http\Request $request) {

//Create an Auth
            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $data = [
                'language_id'    => $request['language_id'],
                'answer_option_title'     => $request['answer_option_title'],
                'answer_title'     => $request['answer_title'],
                'is_correct_answer'     => $request['is_correct_answer'],
            ];
            $obj = QuizAnswer::where(['id' => $request->id])->update($data);
            //CRUDBooster::redirect(CRUDBooster::mainpath("contractcategories"),"The data has been updated !","info");
            CRUDBooster::redirect('admin/course_quizzes/quiz-answers/'.$request['quiz_question_id']."/".$request['language_id'],"The Answer been updated !","info");

        }

        public function getDeleteQuestion($id, \Illuminate\Http\Request $request) {
//Create an Auth
            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }
            DB::select("DELETE FROM quiz_questions WHERE id = '".$id."'");
            DB::select("DELETE FROM quiz_answers WHERE quiz_question_id = '".$id."'");
            //CRUDBooster::redirect('admin/course_quizzes/quiz-questions/'.$id,"The question been deleted !","info");
            return back()->with(['message' => "The answer been deleted !", 'message_type' => "info"]);
        }
        public function getDeleteQuizAnswers($rid,$id,$lid, \Illuminate\Http\Request $request) {
            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }
            DB::select("DELETE FROM quiz_answers WHERE id = '".$rid."'");
            //CRUDBooster::redirect('admin/course_quizzes/quiz-answers/'.$id."/".$lid,"The answer been deleted !","info");
            return back()->with(['message' => "The answer been deleted !", 'message_type' => "info"]);
        }

        public function getDeleteCourseQuiz($id, \Illuminate\Http\Request $request) {
            if(!CRUDBooster::isUpdate() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }
            DB::select("DELETE FROM course_quizzes WHERE id = '".$id."'");
            $quiz_questions = DB::select("SELECT * FROM quiz_questions WHERE course_quiz_id = '".$id."'");
            if(isset($quiz_questions) && count($quiz_questions) > 0){
                foreach ($quiz_questions as $quiz_question){
                    DB::select("DELETE FROM quiz_answers WHERE quiz_question_id = '".$quiz_question->id."'");
                    DB::select("DELETE FROM user_quiz_answers WHERE quiz_question_id = '".$quiz_question->id."'");
                    DB::select("DELETE FROM user_quiz_answers WHERE quiz_question_id = '".$quiz_question->id."'");
                }
            }
            DB::select("DELETE FROM quiz_questions WHERE course_quiz_id = '".$id."'");
            DB::select("DELETE FROM notification WHERE reference_id = '".$id."'");
            CRUDBooster::redirect('admin/course_quizzes',"The course been deleted !","info");
        }
	}