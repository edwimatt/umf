<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Add Course Contents Form</div>
        <div class='panel-body'>
            <form method='post' action='{{CRUDBooster::mainpath('add-save-course-contents')}}'
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class='form-group'>
                    <label>Language</label>
                    <select name="language_id" class='form-control'>
                        @if(!empty($languages))
                            @foreach ($languages as $languages_item)
                                <option {!! (($language_id == $languages_item->id) || (old("language_id") == $languages_item->id)) ? "selected='selected'" : '' !!} value="{!! $languages_item->id !!}">{!! $languages_item->language_name !!}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class='form-group'>
                    <label>Course Type</label>
                    <input class='form-control' type="text" value="{!! $course->course_type !!}" readonly="readonly"
                           name="course_type">
                    @if($errors->has("course_type"))
                        <div class="alert text-danger alert-block">
                            <strong> {{$errors->first("course_type")}}</strong>
                        </div>
                    @endif
                </div>

                <div class='form-group'>
                    <label>Course Name</label>
                    <input type='text' name='course_name' class='form-control' value="{!! old("course_name") !!}"/>
                    @if($errors->has("course_name"))
                        <div class="alert text-danger alert-block">
                            <strong> {{$errors->first("course_name")}}</strong>
                        </div>
                    @endif
                </div>
                <div class='form-group'>
                    <label>Video Heading</label>
                    <input type='text' name='video_heading' value="{!! old("video_heading") !!}" class='form-control'/>
                    @if($errors->has("video_heading"))
                        <div class="text-danger alert-block">
                            <strong> {{$errors->first("video_heading")}}</strong>
                        </div>
                    @endif
                </div>
                <div class='form-group'>
                    <label>Video Description</label>
                    <textarea id="textarea_content" name='video_description' class='form-control'> {!! old("video_description") !!}</textarea>
                    @if($errors->has("video_description"))
                        <div class="text-danger alert-block">
                            <strong> {{$errors->first("video_description")}}</strong>
                        </div>
                    @endif
                </div>
                <div class='form-group'>
                    <label>Upload Video File</label>
                    <input type="file" name="video_file[]">
                    @if($errors->has("video_file"))
                        <div class="text-danger alert-block">
                            <strong> {{$errors->first("video_file")}}</strong>
                        </div>
                    @endif
                </div>
                @if(!in_array($course->course_type ,["video"]))
                    <div class='form-group'>
                        <label>Certificate Title</label>
                        <input type='text' name='course_certificate_title' class='form-control'
                               value="{!! old("course_certificate_title") !!}"/>
                        @if($errors->has("course_certificate_title"))
                            <div class="text-danger alert-block">
                                <strong> {{$errors->first("course_certificate_title")}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class='form-group'>
                        <label>Upload Certificate</label>
                        <input type="file" name="course_certificate_file">
                        @if($errors->has("course_certificate_file"))
                            <div class="text-danger alert-block">
                                <strong> {{$errors->first("course_certificate_file")}}</strong>
                            </div>
                        @endif
                    </div>
                @endif
            <!-- etc .... -->
                <div class='panel-footer'>
                    <input type='hidden' name='course_id' value="{!! $course->id !!}" required
                           class='form-control'/>
                    <input type='submit' class='btn btn-primary' value='Save changes'/>
                </div>
            </form>
        </div>
    </div>
@endsection