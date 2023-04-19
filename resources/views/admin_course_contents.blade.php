<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your custom  HTML goes here -->
    <form method="get" action="{{ url('admin/courses/course-contents/' . $id) }}">
        <h3>Search</h3>
        <table class='table' style="width: 50%">
            <tr>
                <td>Course Title</td>
                <td><input type="text" name="course_title" VALUE="<?php echo $course_title; ?>"></td>
            </tr>
            <tr>
                <td>Language</td>
                <td>
                    <select name="language_id">
                        <option value="0">View All</option>
                        <?php
                            $sel = '';
                            foreach ($languages as $languages_item) {
                                if ($language_id > 0) {
                                    if ($language_id == $languages_item->id) {
                                        $sel = ' selected';
                                    } else {
                                        $sel = '';
                                    }
                                } ?>
                        <option <?php echo $sel; ?> value="<?php echo $languages_item->id; ?>">
                            <?php echo $languages_item->language_name; ?></option>
                        <?php
                            }
                            ?>
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
        <a class="btn btn-sm btn-success" href='{{ url('admin/courses/add-course-contents/' . $id) }}'>Add new course
            content</a>
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Language</th>
                <th>Video Heading</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $row)
                <tr>
                    <td>{{ $row->course_name }}</td>
                    <td>{{ $row->language_name }}</td>
                    <td>{{ $row->video_heading }}</td>
                    <td>
                        <a href='{{ CRUDBooster::mainpath("edit-course-contents/$row->id") }}'>Edit</a>
                        {{-- <a class='btn btn-danger btn-sm' href='{{CRUDBooster::mainpath("delete-course-contents/{$row->course_id}/{$row->id}")}}' onclick="return confirm('Are you sure you want to category?');">Delete</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>{!! urldecode(str_replace('/?', '?', $result->appends(Request::all())->render())) !!}</p>
    <!-- ADD A PAGINATION -->
@endsection
