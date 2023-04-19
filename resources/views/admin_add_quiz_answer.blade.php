<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Add New Answer Form</div>
        <div class='panel-body'>
            <form method='post' action='{{CRUDBooster::mainpath('add-save-answer')}}' enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class='form-group'>
                    <label>Language</label>

                        <?PHP
                    $l_name = "";
                        $sel= '';
                        foreach ($languages as $languages_item)    {
                        if($language_id > 0){
                            if($language_id == $languages_item->id){
                                $sel = ' selected';
                                $l_name = $languages_item->language_name;
                            }else{
                                $sel = '';
                            }
                        }
                        ?>

                        <?PHP } ?>
                        <?PHP echo $l_name ?>

                </div>
                <div class='form-group'>
                    <label>Answer Option Title</label>
                    <input type='text' name='answer_option_title' required class='form-control'/>
                    Example (Question1, Q1, 1,2,3)
                </div>
                <div class='form-group'>
                    <label>Answer Title</label>
                    <input type='text' name='answer_title' required class='form-control'/>
                    Example (What does EPS mean?)
                </div>
                <div class='form-group'>
                    <label>Is Correct Answer?</label>
                    <input type="checkbox" name="is_correct_answer" value="1">
                </div>

                <!-- etc .... -->
                <div class='panel-footer'>
                    <input type='hidden' name='quiz_question_id' value="<?PHP echo $quiz_question_id ?>" required class='form-control'/>
                    <input type='hidden' name='language_id' value="<?PHP echo $language_id ?>" required class='form-control'/>
                    <input type='submit' class='btn btn-primary' value='Save changes'/>
                </div>
            </form>
        </div>
    </div>
@endsection