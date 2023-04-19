<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Edit Form</div>
        <div class='panel-body'>
            <form method='post' action='{{CRUDBooster::mainpath('course-description-edit-save/'.$row->id)}}' enctype="multipart/form-data">
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
                    <label>Lecture Number</label>
                    <input type='text' name='lecture_number' value="<?PHP echo $row->lecture_number ?>" required class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Lecture Heading</label>
                    <input type='text' name='lecture_heading' value="<?PHP echo $row->lecture_heading ?>" required class='form-control'/>
                </div>

                <div class='form-group'>
                    <label>Lecture Description</label>
                    <textarea name="lecture_content" required class='form-control'><?PHP echo $row->lecture_content ?></textarea>
                </div>
                <!-- etc .... -->
        <div class='panel-footer'>
            <input type='hidden' name='id' value="<?PHP echo $row->id ?>"  class='form-control'/>
            <input type='hidden' name='course_id' value="<?PHP echo $row->course_id ?>"  class='form-control'/>
            <input type='submit' class='btn btn-primary' value='Save changes'/>
        </div>
            </form>
        </div>
    </div>
@endsection