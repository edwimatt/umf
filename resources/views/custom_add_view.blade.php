<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Add Form</div>
        <div class='panel-body'>
            {{--{{CRUDBooster::mainpath('save-data')}}--}}
            <form method='post' action='{{CRUDBooster::mainpath('save-data')}}'>
                {{ csrf_field() }}

                <div class='form-group'>
                    <label>Category Type</label>
                    <select class="form-control" name="category_type" class='form-control'>
                        <option value="">
                            Please select category Type
                        </option>
                        <option {!! (($languages_item->id == "quiz") || (old("category_type") == "quiz")) ? "selected='selected'" : '' !!} value="quiz">
                            Quiz
                        </option>
                        <option {!! (($languages_item->id == "quiz") || (old("category_type") == "video")) ? "selected='selected'" : '' !!} value="video">
                            Video
                        </option>
                    </select>
                    @if($errors->has("category_type"))
                        <div class="alert text-danger alert-block">
                            <strong> {{$errors->first("category_type")}}</strong>
                        </div>
                    @endif
                </div>

                <div class='form-group'>
                    <label>Name</label>
                    <input type='text' name='category_name' required class='form-control'/>
                    @if($errors->has("category_name"))
                        <div class="alert text-danger alert-block">
                            <strong> {{$errors->first("category_name")}}</strong>
                        </div>
                    @endif
                </div>
                <div class='form-group'>
                    <label>Description</label>
                    <textarea name="description" class='form-control textarea_content'></textarea>
                    @if($errors->has("description"))
                        <div class="alert text-danger alert-block">
                            <strong> {{$errors->first("description")}}</strong>
                        </div>
                    @endif
                </div>


                <div class='form-group'>
                    <label>Spanish Name</label>
                    <input type='text' name='spanish_category_name' class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Spanish Description</label>
                    <textarea name="spanish_description" class='form-control textarea_content'></textarea>
                </div>

                <!-- etc .... -->


                <div class='panel-footer'>
                    <input type='submit' class='btn btn-primary' value='Save changes'/>
                </div>
            </form>
        </div>
    </div>
@endsection