<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your html goes here -->
    <div class='panel panel-default'>
        <div class='panel-heading'>Edit Form</div>
        <div class='panel-body'>
            <form method='post' action='{{CRUDBooster::mainpath('course-edit-save/'.$row->id)}}'>

                {{ csrf_field() }}
                <div class='form-group'>
                    <label>Category</label>
                    <select name="category_id" class='form-control'>
                        <?PHP
                        $sel = '';
                        foreach ($categories as $categories_item)    {
                        if ($row->category_id > 0) {
                            if ($row->category_id == $categories_item->id) {
                                $sel = ' selected';
                            } else {
                                $sel = '';
                            }
                        }
                        ?>
                        <option
                            <?PHP echo $sel ?> value="<?PHP echo $categories_item->id?>"><?PHP echo $categories_item->category_name?></option>
                        <?PHP } ?>
                    </select>

                </div>
                <div class='form-group'>
                    <label>English Course Title</label>
                    <input type='text' name='course_title' required class='form-control'
                           value="{!! $row->course_title !!}"/>
                </div>

                <div class='form-group'>
                    <label>Spanish Course Title</label>
                    <input type='text' name='spanish_course_title' class='form-control'
                           value="{!! $row->spanish_course_title !!}"/>
                    @if($errors->has("spanish_course_title"))
                        <div class="alert text-danger alert-block">
                            <strong> {{$errors->first("spanish_course_title")}}</strong>
                        </div>
                    @endif
                </div>

                <div class='form-group'>
                    <label>Pass Percentage</label>
                    <input type='text' name='passing_percentage' required class='form-control'
                           value="<?PHP echo $row->passing_percentage ?>"/>
                </div>


                <!-- etc .... -->


                <div class='panel-footer'>
                    <input type='hidden' name='id' value="<?PHP echo $row->id ?>" class='form-control'/>
                    <input type='submit' class='btn btn-primary' value='Save changes'/>
                </div>
            </form>
        </div>
    </div>
@endsection