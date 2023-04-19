<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Edit Form</div>
        <div class='panel-body'>
            <form method='post' action='{{CRUDBooster::mainpath('course-contents-edit-save/'.$row->id)}}' enctype="multipart/form-data">
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
                    <label>Course Name</label>
                    <input type='text' name='course_name' value="<?PHP echo $row->course_name ?>" required class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Video Heading</label>
                    <input type='text' name='video_heading' value="<?PHP echo $row->video_heading ?>" required class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Video Description</label>
                    <textarea id="textarea_content" name='video_description' required class='form-control'><?PHP echo $row->video_description ?></textarea>
                </div>
                <div class='form-group'>
                    <label>Upload Video File</label>
                    <input type="file" name="video_file[]">
                    <?PHP

                    if($row->video_file != ''){
                        $video_file = env('APP_URL').config('constants.MEDIA_IMAGE_PATH').$row->video_file;

                    }else{
                        $video_file = '';
                    }

                    ?>
                    <?PHP
                    if($video_file != '')
                    { ?>
                    <a target="_blank" href="<?PHP echo $video_file ?>">View</a>
                    <?PHP
                    }
                    ?>
                </div>

                <div class='form-group'>
                    <label>Certificate Title</label>
                    <input type='text' name='course_certificate_title' value="<?PHP echo $course_certificates->course_certificate_title ?>" required class='form-control'/>
                </div>

                <div class='form-group'>
                    <label>Course Certificate File</label>
                    <input type="file" name="course_certificate_file">
                    <?PHP

                    if($course_certificates->course_certificate_file != ''){
                        $course_certificate_file = env('APP_URL').config('constants.MEDIA_IMAGE_PATH').$course_certificates->course_certificate_file;

                    }else{
                        $course_certificate_file = '';
                    }

                    ?>
                    <?PHP
                    if($course_certificate_file != '')
                    { ?>
                    <a target="_blank" href="<?PHP echo $course_certificate_file ?>">View</a>
                    <?PHP
                    }
                    ?>
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