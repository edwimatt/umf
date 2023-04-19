<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Add Course Description Form</div>
        <div class='panel-body'>
            <form method='post' action='{{CRUDBooster::mainpath('add-save-course-description')}}' enctype="multipart/form-data">
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
                    <label>Lecture Number</label>
                    <input type='text' name='lecture_number' required class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Lecture Heading</label>
                    <input type='text' name='lecture_heading' required class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Lecture Description</label>
                    <textarea name="lecture_content" required class='form-control'></textarea>
                </div>
                <!-- etc .... -->
                <div class='panel-footer'>
                    <input type='hidden' name='course_id' value="<?PHP echo $course_id ?>" required class='form-control'/>
                    <input type='submit' class='btn btn-primary' value='Save changes'/>
                </div>
            </form>
        </div>
    </div>
@endsection