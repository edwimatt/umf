<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Edit Form</div>
        <div class='panel-body'>
            <form method='post' action='{{CRUDBooster::mainpath('answer-edit-save/'.$row->id)}}' enctype="multipart/form-data">
            {{ csrf_field() }}

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

            <div class='form-group'>
                <label>Answer Option Title</label>
                <input type='text' name='answer_option_title' value="<?PHP echo $row->answer_option_title ?>" required class='form-control'/>
            </div>

            <div class='form-group'>
                <label>Answer Title</label>
                <input type='text' name='answer_title' value="<?PHP echo $row->answer_title ?>" required class='form-control'/>
            </div>

            <div class='form-group'>
                <label>Is Correct Answer?</label>
                <?PHP
                if($row->is_correct_answer == 1 ){
                    $chk = ' checked="checked"';
                }   else{
                    $chk = '';
                }
                ?>
                <input <?PHP echo $chk?> type="checkbox" name="is_correct_answer" value="1">
            </div>

                <!-- etc .... -->
        <div class='panel-footer'>
            <input type='hidden' name='id' value="<?PHP echo $row->id ?>"  class='form-control'/>
            <input type='hidden' name='quiz_question_id' value="<?PHP echo $row->quiz_question_id ?>"  class='form-control'/>
            <input type='hidden' name='language_id' value="<?PHP echo $language_id ?>" required class='form-control'/>
            <input type='submit' class='btn btn-primary' value='Save changes'/>
        </div>
            </form>
        </div>
    </div>
@endsection