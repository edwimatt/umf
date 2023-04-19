<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your custom  HTML goes here -->
    <form method="get" action="{{url('admin/courses/course-descriptions/'.$id)}}">
        <h3>Search</h3>
        <table class='table' style="width: 50%">
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
        <a class="btn btn-sm btn-success" href='{{url('admin/courses/add-course-description/'.$id)}}' >Add new course descriptions</a>
        <thead>
        <tr>
            <th>Language</th>
            <th>Lecture Number</th>
            <th>Lecture Heading</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($result as $row)
            <tr>
                <td>{{$row->language_name}}</td>
                <td>{{$row->lecture_number}}</td>
                <td>{{$row->lecture_heading}}</td>
                <td>
                    <a href='{{CRUDBooster::mainpath("edit-course-description/$row->id")}}' >Edit</a>


                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>
    <!-- ADD A PAGINATION -->

@endsection