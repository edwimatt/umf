@include('user.include.header')
@include('user.include.sidebar')
<div class="right_col" role="main">
    <div class="row" id="content-heading">
        <div class="col-md-8">
            <h1 class="cust-head">Users</h1>
        </div>
        <div class="col-md-4 text-right">
            <?PHP
            $employees_registration = (int)$hospital->employees_registration;
            $total_user = $total_user->total_user;
            if($total_user <= $employees_registration){
            ?>
            <a href="{{ url('/user/add-physician') }}" class="btn btn-info b1">Add New User</a>
            <?PHP } ?>


        </div>
    </div>
    <hr class="border">
    <div class="row" id="pg-content">
        @include('user.error')
        <?PHP

        if(isset($_GET['s']) && $_GET['s'] == "c"){
        ?>
        <div class="alert alert-success">User has been created successfully.</div>
        <?PHP } ?>
        <?PHP
        if(isset($_GET['s']) && $_GET['s'] == "e"){
        ?>
        <div class="alert alert-success">User has been updated successfully.</div>
        <?PHP } ?>
        <?PHP
        if(isset($_GET['s']) && $_GET['s'] == "l"){
        ?>
        <div class="alert alert-success">Your total User(s) registration limit is <?PHP echo $employees_registration?>
            .
        </div>
        <?PHP } ?>

        <div class="table-responsive">
            <table class="table table-striped jambo_table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                @if(!empty($records))
                    @foreach ($records as $record)
                        <tr>
                            <td> {!! $record->first_name !!} {!! $record->last_name !!}</td>
                            <td> {!! $record->email !!} </td>
                            <td>
                                <a href="{{ url('user/editphysician', $record->id) }}" style="color:black;" title="Edit"> <i
                                            class="far fa-edit"></i> </a>
                                | <a href="{{ url('user/view-attempted-trainings', $record->id) }}" style="color:black;"
                                     title="View Attempted Trainings"> View Attempted Trainings </a>
                            </td>

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{ $records->links() }}
        </div>
    </div>

    <script type="text/javascript">

    </script>

</div>
@include('user.include.footer')