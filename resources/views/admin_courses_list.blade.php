<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your custom  HTML goes here -->
    <form method="get" action="{{ url('admin/courses') }}">
        <h3>Search</h3>
        <table class='table' style="width: 50%">
            <tr>
                <td>Course Title</td>
                <td><input type="text" name="course_title" VALUE="<?php echo $course_title; ?>"></td>
            </tr>
            <tr>
                <td>Category</td>
                <td>
                    <select name="category_id">
                        <option value="0">View All</option>
                        <?php
                            $sel = '';
                            foreach ($categories as $categories_item) {
                                if ($category_id > 0) {
                                    if ($category_id == $categories_item->id) {
                                        $sel = ' selected';
                                    } else {
                                        $sel = '';
                                    }
                                } ?>
                        <option <?php echo $sel; ?> value="<?php echo $categories_item->id; ?>">
                            <?php echo $categories_item->category_name; ?></option>
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
        <a class="btn btn-sm btn-success" href='{{ CRUDBooster::mainpath('add') }}'>Add new course</a>
        <thead>
            <tr>
                <th>Course Title</th>
                <th>Category</th>
                <th>Pass Percentage</th>
                <th>Publish/Unpublish</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $row)
                <tr>
                    <td>{{ $row->course_title }}</td>
                    <td>{{ $row->category_name }}</td>
                    <td>{{ $row->passing_percentage }}</td>
                    <td>
                        <?php if ($row->is_publish == 0) { ?>
                        <a href='{{ CRUDBooster::mainpath("publish-unpublish/1/$row->id") }}'>Publish</a>
                        <?php } else { ?>
                        <a href='{{ CRUDBooster::mainpath("publish-unpublish/0/$row->id") }}'>UnPublished</a>
                        <?php } ?>

                    </td>
                    <td>
                        <a href='{{ CRUDBooster::mainpath("edit-course/$row->id") }}'>Edit</a>
                        |
                        <a href='{{ CRUDBooster::mainpath("add-course-contents/$row->id") }}'>Add course contents</a>
                        |
                        <a href='{{ CRUDBooster::mainpath("course-descriptions/$row->id") }}'>View course description</a>
                        |
                        <a href='{{ CRUDBooster::mainpath("course-contents/$row->id") }}'>View course contents</a>
                        {{-- |
                    <a style="color: red" href='{{CRUDBooster::mainpath("delete-course/$row->id")}}' onclick="return confirm('Are you sure you want to category?');">Delete</a> --}}



                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>{!! urldecode(str_replace('/?', '?', $result->appends(Request::all())->render())) !!}</p>
    <!-- ADD A PAGINATION -->
@endsection
