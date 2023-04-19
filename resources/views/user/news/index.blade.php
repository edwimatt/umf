@include('user.include.header')
@include('user.include.sidebar')
<div class="right_col" role="main">
    <div class="row" id="content-heading">
        <div class="col-md-8">
            <h1 class="cust-head">Hospital News</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ url('/user/hospital-news/add') }}" class="btn btn-info b1">Add Hospital News</a>
        </div>
    </div>
    <hr class="border">
    <div class="row" id="pg-content">
        @include('user.error')
        <div class="table-responsive">
            <table class="table table-striped jambo_table">
                <thead>
                <tr>
                    <th scope="col">News Title</th>
                    <th scope="col">News</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                @if(!empty($records))
                    @foreach ($records as $record)
                        <tr>
                            <td> {!! $record->news_title !!}</td>
                            <td> {!! $record->news_description !!}</td>
                            @if(!empty($record->news_image))
                                    <td><img style="width: 70px;" src='{!! url("storage/{$record->news_image}") !!}'></td>
                            @else
                            <td>--</td>
                            @endif
                            <td>
                                <a class="__delete" data-id="{!! $record->id !!}"  data-module="hospital-news" href="javascript:void(0)"
                                   style="color:black; color: rgba(231, 76, 60, 0.88) !important;"
                                   title="Delete"> <i class="fa fa-trash"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                            <td colspan="4"> No Record Found.</td>
                        </tr>
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