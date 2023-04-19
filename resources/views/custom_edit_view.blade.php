<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Edit Form</div>
        <div class='panel-body'>
            <form method='post' action='{{CRUDBooster::mainpath('custom-edit-save/'.$row->id)}}'>
                {{ csrf_field() }}
                <div class='form-group'>
                    <label>Category Name</label>
                    <input type='text' name='category_name' value="{!! $row->category_name !!}"
                           class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Description</label>
                    <textarea name="description" class='form-control textarea_content'>{!! $row->description !!}</textarea>
                </div>

                <div class='form-group'>
                    <label>Spanish Name</label>
                    <input type='text' name='spanish_category_name' value="{!! $row->spanish_category_name !!}" class='form-control'/>
                </div>
                <div class='form-group'>
                    <label>Spanish Description</label>
                    <textarea name="spanish_description" class='form-control textarea_content'>{!! $row->spanish_description !!}</textarea>
                </div>


                <!-- etc .... -->
                <div class='panel-footer'>
                    <input type='hidden' name='id' value="{!! $row->id !!}" class='form-control'/>
                    <input type='submit' class='btn btn-primary' value='Save changes'/>
                </div>
            </form>
        </div>
    </div>
@endsection