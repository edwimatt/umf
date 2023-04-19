<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your custom  HTML goes here -->

    <table class='table table-striped table-bordered'>
        <thead>
        <tr>
            <th style="width: 40%">Category</th>

            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $row)
            <tr>
                <td>{{$row->category_name}}</td>
                <td>
                    <!-- To make sure we have read access, wee need to validate the privilege -->
                    @if(CRUDBooster::isUpdate() && $button_edit)
                        <a class='btn btn-success btn-sm' href='{{CRUDBooster::mainpath("edit-category/$row->id")}}'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='{{CRUDBooster::mainpath("delete-category/$row->id")}}' onclick="return confirm('Are you sure you want to category?');">Delete</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- ADD A PAGINATION -->
@endsection