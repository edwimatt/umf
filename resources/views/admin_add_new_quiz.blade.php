<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Add Form</div>
        <div class='panel-body'>
            <form method='post' action='{{CRUDBooster::mainpath('add-save')}}'>
                {{ csrf_field() }}
                <div class='form-group'>
                    <label>Course</label>


                    <select name="course_id" class='form-control'>
                        <?PHP
                        $sel= '';
                        foreach ($courses as $courses_item)    {
                        if($course_id > 0){
                            if($course_id == $courses_item->id){
                                $sel = ' selected';
                            }else{
                                $sel = '';
                            }
                        }
                        ?>
                        <option <?PHP echo $sel ?> value="<?PHP echo $courses_item->id?>"><?PHP echo $courses_item->course_title?></option>
                        <?PHP } ?>
                    </select>
                </div>
                <div class='form-group'>
                    <label>Course Quiz Title</label>
                    <input type='text' name='course_quiz_title' required class='form-control'/>
                </div>
                <!-- etc .... -->
                <div class='panel-footer'>
                    <input type='submit' class='btn btn-primary' value='Save changes'/>
                </div>
            </form>
        </div>
    </div>
@endsection