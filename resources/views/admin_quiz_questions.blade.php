<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your custom  HTML goes here -->
    <form method="get" action="{{url('admin/course_quizzes/quiz-questions/'.$id)}}">
        <h3>Search</h3>
        <table class='table' style="width: 50%">
            <tr>
                <td>Question Title</td>
                <td><input type="text" name="question_title" VALUE="<?PHP echo $question_title?>"></td>
            </tr>
            <tr>
                <td>Language</td>
                <td>
                    <select name="language_id">
                        <option value="0">View All</option>
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
        <a class="btn btn-sm btn-success" href='{{url('admin/course_quizzes/add-quiz-question/'.$id."/".$languages_item->id)}}' >Add new quiz question</a>
        <thead>
        <tr>
            <th>Language</th>
            <th>Question Option Title</th>
            <th>Question Title</th>
            <th>Is multiple choice question?</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($result as $row)
            <?PHP

            ?>
            <tr>
                <td>{{$row->language_name}}</td>
                <td>{{$row->question_option_title}}</td>
                <td>{{$row->question_title}}</td>
                <td>
                    <?PHP
                    if($row->is_multiple_choice_question == 1){
                        echo "YES";
                    }    else{
                        echo "NO";
                    }
                    ?>

                </td>
                <td>
                    <a href='{{CRUDBooster::mainpath("edit-quiz-question/$row->id")}}' >Edit</a>
                    |
                    <a href='{{CRUDBooster::mainpath("add-quiz-answer/$row->id"."/".$row->language_id)}}' >Add quiz Answer</a>
                    |
                    <a href='{{CRUDBooster::mainpath("quiz-answers/$row->id"."/".$row->language_id)}}' >View quiz Answers</a>
                    |
                    <a style="color: red"  href='{{CRUDBooster::mainpath("delete-question/$row->id")}}' onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>
    <!-- ADD A PAGINATION -->

@endsection