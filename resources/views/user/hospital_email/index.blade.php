@include('user.include.header')
@include('user.include.sidebar')
<div class="right_col" role="main">
    <div class="row" id="content-heading">
        <div class="col-md-8">
            <h1 class="cust-head">Hospital Email</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ url('/user/hospital-email/add') }}" class="btn btn-info b1">Add Hospital Email</a>
        </div>
    </div>
    <hr class="border">
    <div class="row" id="pg-content">
        @include('user.error')
        <div class="table-responsive">
            <table class="table table-striped jambo_table">
                <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                @if(!empty($records))
                    @foreach ($records as $record)
                        <tr>
                            <td> {!! $record->email !!}</td>
                            <td>
                                <a class="__delete" data-id="{!! $record->id !!}"   data-module="hospital-email" href="javascript:void(0)"
                                   style="color:black; color: rgba(231, 76, 60, 0.88) !important;"
                                   title="Delete"> <i class="fa fa-trash"></i> </a>
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