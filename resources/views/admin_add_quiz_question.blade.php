<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Add New Question Form</div>
        <div class='panel-body'>
            <form method='post' action='{{CRUDBooster::mainpath('add-save-question')}}' enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class='form-group'>
                    <label>Language</label>
                    <select name="language_id" class='form-control'>
                        <?PHP
                        $sel= '';
                        foreach ($languages as $languages_item)    {
                        if($language_id > 0){
                            if($language_id == $languages_item->id){
                                $sel = ' selected';
                            }else{
                                $sel = '';
                            }
                        }
                        ?>
                        <option <?PHP echo $sel ?> value="<?PHP echo $languages_item->id?>"><?PHP echo $languages_item->language_name?></option>
                        <?PHP } ?>
                    </select>
                </div>
                <div class='form-group'>
                    <label>Question Option Title</label>
                    <input type='text' name='question_option_title' required class='form-control'/>
                    Example (Question1, Q1, 1,2,3)
                </div>
                <div class='form-group'>
                    <label>Question Title</label>
                    <input type='text' name='question_title' required class='form-control'/>
                    Example (What does EPS mean?)
                </div>
                <div class='form-group'>
                    <label>Is Multiple Choice Question?</label>
                    <input type="checkbox" name="is_multiple_choice_question" value="1">
                </div>

                <!-- etc .... -->
                <div class='panel-footer'>
                    <input type='hidden' name='course_quiz_id' value="<?PHP echo $course_quiz_id ?>" required class='form-control'/>
                    <input type='submit' class='btn btn-primary' value='Save changes'/>
                </div>
            </form>
        </div>
    </div>
@endsection