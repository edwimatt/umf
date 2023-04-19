<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')

    <!-- Your custom  HTML goes here -->

    <table id="dtBasicExample" class='table table-striped table-bordered'>
        <thead>
        <tr>
            <th>Name (email)</th>
            <th>Hospital</th>
            <th>Total Number of Employees Registration</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($result as $row)
            <tr>
                <td>{{$row->first_name}} {{$row->last_name}} <b>({{$row->email}})</b></td>
                <td>{{$row->name}}</td>
                <td>{{$row->employees_registration}}</td>
                <td>
                    @if($row->is_active == 1)
                        @php
                            $path = CRUDBooster::mainpath("hospital-status/{$row->user_id}");
                            echo  "<a onclick=\"return confirm('Are you sure you want to Deactivate?')\" href='{$path}' data-id='{$row->is_active}'>Active<a/>";
                        @endphp
                    @else
                        @php
                            $path = CRUDBooster::mainpath("hospital-status/{$row->user_id}");
                            echo  "<a onclick=\"return confirm('Are you sure you want to Acitve?')\" href='{$path}' data-id='{$row->is_active}'>Deactivate<a/>";
                        @endphp
                    @endif
                </td>
                <td>
                    @if($row->is_approved == "0")
                        <?PHP
                        if ($row->is_approved == 0) {
                            $path = CRUDBooster::mainpath('user-approve/' . $row->user_id);
                            echo "<a onclick=\"return confirm('Are you sure you want to Approve?')\" href='" . $path . "'>Approve<a/>";
                        } else {
                            return "Approved";
                        }
                        ?>
                    @elseif($row->is_approved == "1")
                        {{--<a class='btn btn-info btn-sm' href='{{CRUDBooster::mainpath("user-scheduling-status/$row->id/pending")}}' onclick="return confirm('Are you sure you want to make as Pending?');">Make as Pending</a>--}}
                        APPROVED

                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- ADD A PAGINATION -->
    <p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable({
                "paging": false // false to disable pagination (or any other option)
            });
            $('.dataTables_length').addClass('bs-select');
        });

    </script>
@endsection

