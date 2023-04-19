<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your custom  HTML goes here -->
    <form method="get" action="{{url('admin/courses')}}">
        <h3>Search</h3>
        <table class='table' style="width: 50%">
            <tr>
                <td>Course Quiz Title</td>
                <td><input type="text" name="course_quiz_title" VALUE="<?PHP echo $course_quiz_title?>"></td>
            </tr>
            <tr>
                <td>Course</td>
                <td>
                    <select name="course_id">
                        <option value="0">View All</option>
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
                </td>
            </tr>
            <tr>
                <td><input type="submit"></td>
                <td></td>
            </tr>
        </table>
    </form>
    <hr>

    <table class='table table-striped table-bordered'>
        <a class="btn btn-sm btn-success" href='{{CRUDBooster::mainpath("add")}}' >Add new Quiz</a>
        <thead>
        <tr>
            <th>Course Title</th>
            <th>Course Quiz Title</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($result as $row)
            <tr>
                <td>{{$row->course_title}}</td>
                <td>{{$row->course_quiz_title}}</td>
                <td>
                    <a href='{{CRUDBooster::mainpath("edit-quiz/$row->id")}}' >Edit</a>
                    |
                    <a href='{{CRUDBooster::mainpath("add-quiz-question/$row->id")}}' >Add quiz question</a>
                                        |
                    <a href='{{CRUDBooster::mainpath("quiz-questions/$row->id")}}' >View quiz questions</a>
                    |
                    <a style="color: red"  href='{{CRUDBooster::mainpath("delete-course-quiz/$row->id")}}' onclick="return confirm('Are you sure you want to quiz?');">Delete</a>



                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>
    <!-- ADD A PAGINATION -->

@endsection