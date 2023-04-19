<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your custom  HTML goes here -->
    <table class='table table-striped table-bordered'>
        <a class="btn btn-sm btn-success" href='{{url('admin/course_quizzes/add-quiz-answer/'.$id."/".$language_id)}}' >Add new quiz answer</a>
        <thead>
        <tr>
            <th>Language</th>
            <th>Answer Option Title</th>
            <th>Answer Title</th>
            <th>Is correct answer?</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($result as $row)

            <tr>
                <td>{{$row->language_name}}</td>
                <td>{{$row->answer_option_title}}</td>
                <td>{{$row->answer_title}}</td>
                <td>
                    <?PHP
                    if($row->is_correct_answer == 1){
                        echo "YES";
                    }    else{
                        echo "NO";
                    }
                    ?>

                </td>
                <td>
                    <a href='{{CRUDBooster::mainpath("edit-quiz-answer/$row->id"."/".$language_id)}}' >Edit</a>
                    |
                    <a style="color: red"  href='{{CRUDBooster::mainpath("delete-quiz-answers/$row->id/$row->quiz_question_id/$row->language_id")}}' onclick="return confirm('Are you sure you want to answer?');">Delete</a>


                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>
    <!-- ADD A PAGINATION -->

@endsection