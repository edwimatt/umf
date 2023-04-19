<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
    <!-- Your custom  HTML goes here -->
    <form method="get" action="{{url('admin/appusers')}}" autocomplete="off">
        <h3>Search</h3>
        @if(!empty($hospitals) && !empty($hospital_id))
            <table class='table' style="width: 50%">
                <tr>
                    <td>Hospital</td>
                    <td>
                        <select name="hospital_id">
                            <option value="0">View All</option>
                                <?PHP
                                $sel = '';
                            foreach ($hospitals as $hospitals_item)    {
                                if ($hospital_id > 0) {
                                    if ($hospital_id == $hospitals_item->id) {
                                        $sel = ' selected';
                                    } else {
                                        $sel = '';
                                    }
                                }

                                ?>
                            <option <?PHP echo $sel ?> value="<?PHP echo $hospitals_item->id?>"><?PHP echo $hospitals_item->name ?></option>
                            <?PHP } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit"></td>
                    <td></td>
                </tr>
            </table>
        @endif


    </form>
    <hr>
    <table id="dtBasicExample" class='table table-striped table-bordered'>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Hospital</th>
            <th>Contact</th>
            {{--<th>Action</th>--}}
        </tr>
        </thead>
        <tbody>

        @foreach($result as $row)
                <?PHP
                $hospital_id = $row->hospital_id;
                ?>
            <tr>
                <td>{{$row->first_name}} {{$row->last_name}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->hospital_name}}</td>
                <td>{{$row->mobile_no}}</td>
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

