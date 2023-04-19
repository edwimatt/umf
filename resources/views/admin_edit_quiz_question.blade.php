<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Edit Form</div>
        <div class='panel-body'>
            <form method='post' action='{{CRUDBooster::mainpath('question-edit-save/'.$row->id)}}' enctype="multipart/form-data">
            {{ csrf_field() }}

            <select name="language_id" class='form-control'>
                <?PHP
                $sel= '';
                foreach ($languages as $languages_item)    {
                    if($row->language_id > 0){
                        if($row->language_id == $languages_item->id){
                            $sel = ' selected';
                        }else{
                            $sel = '';
                        }
                    }
                    ?>
                    <option <?PHP echo $sel ?> value="<?PHP echo $languages_item->id?>"><?PHP echo $languages_item->language_name?></option>
                <?PHP } ?>
            </select>

            <div class='form-group'>
                <label>Question Option Title</label>
                <input type='text' name='question_option_title' value="<?PHP echo $row->question_option_title ?>" required class='form-control'/>
            </div>

            <div class='form-group'>
                <label>Question Title</label>
                <input type='text' name='question_title' value="<?PHP echo $row->question_title ?>" required class='form-control'/>
            </div>

            <div class='form-group'>
                <label>Is Multiple Choice Question?</label>
                <?PHP
                if($row->is_multiple_choice_question == 1 ){
                    $chk = ' checked="checked"';
                }   else{
                    $chk = '';
                }
                ?>
                <input <?PHP echo $chk?> type="checkbox" name="is_multiple_choice_question" value="1">
            </div>

                <!-- etc .... -->
        <div class='panel-footer'>
            <input type='hidden' name='id' value="<?PHP echo $row->id ?>"  class='form-control'/>
            <input type='hidden' name='course_quiz_id' value="<?PHP echo $row->course_quiz_id ?>"  class='form-control'/>
            <input type='submit' class='btn btn-primary' value='Save changes'/>
        </div>
            </form>
        </div>
    </div>
@endsection