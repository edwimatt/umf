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
                    <label>Category</label>
                    <select name="category_id" id="category_id" class='form-control'>
                        <option value="" >Please select category</option>
                        @if(!empty($categories))
                            @foreach ($categories as $categories_item)
                                <option {!! ($category_id == $categories_item->id) ? "selected='selected'" : '' !!} value="{!! $categories_item->id !!}" {!! !empty($categories_item->category_type) ? "data-type='$categories_item->category_type'" : "" !!}>{!! $categories_item->category_name !!}</option>
                            @endforeach
                        @endif
                    </select>
                    @if($errors->has("category_id"))
                        <div class="alert text-danger alert-block">
                            <strong> {{$errors->first("category_id")}}</strong>
                        </div>
                    @endif
                </div>
                <div class='form-group'>
                    <label>English Course Title</label>
                    <input type='text' name='course_title' class='form-control'/>
                    @if($errors->has("course_title"))
                        <div class="alert text-danger alert-block">
                            <strong> {{$errors->first("course_title")}}</strong>
                        </div>
                    @endif
                </div>

                <div class='form-group'>
                    <label>Spanish Course Title</label>
                    <input type='text' name='spanish_course_title' class='form-control'/>
                    @if($errors->has("spanish_course_title"))
                        <div class="alert text-danger alert-block">
                            <strong> {{$errors->first("spanish_course_title")}}</strong>
                        </div>
                    @endif
                </div>
                <div class='form-group passing_percentage'>
                    <label>Passing Percentage</label>
                    <input type='text' name='passing_percentage' class='form-control'/>
                    @if($errors->has("passing_percentage"))
                        <div class="alert text-danger alert-block">
                            <strong> {{$errors->first("passing_percentage")}}</strong>
                        </div>
                    @endif
                </div>
                <!-- etc .... -->
                <div class='panel-footer'>
                    <input type='submit' class='btn btn-primary' value='Save changes'/>
                </div>

                <input type="hidden" name="course_type" id="course_type">
            </form>
        </div>
    </div>
@endsection