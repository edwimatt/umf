@include('user.include.header')
@include('user.include.sidebar')
<div class="right_col" role="main">
    <div class="row" id="content-heading">
        <form autocomplete="off" enctype="multipart/form-data" method="post"
              action="{{url('/user/hospital-email/add')}}"
              accept-charset="UTF-8">
            <div class="panel panel-default">
                <div class="panel-heading cust-head">
                    Add New User
                </div>
                <div class="panel-body">
                    @if (Session::has('errors'))
                        @foreach($errors->all() as $key => $value)
                            <div class="alert alert-danger" role="alert">
                                {{$value}}
                            </div>
                        @endforeach
                    @endif
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Email</label>
                        <input type="text" maxlength="30" class="form-control" id="email" name="email"
                               placeholder="Email"
                               value="{!! old("email") !!}"/>
                    </div>


                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{asset('assets/js/jquery-timepicker-master/jquery.timepicker.js')}}"></script>
    <script src="{{asset('assets/js/jquery-timepicker-master/lib/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/js/jquery-timepicker-master/lib/site.js')}}"></script>
    <link href="{{asset('assets/js/jquery-timepicker-master/jquery.timepicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/js/jquery-timepicker-master/lib/site.css')}}" rel="stylesheet">
    <!-- the datepicker input -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
    <script>
        $('.datepicker').datepicker(
            {
                minDate: 0,
                dateFormat: 'yy-mm-dd'
            }
        );

    </script>
    <script language="javascript">
        $(document).ready(function () {
            $('.basicExample').timepicker({'scrollDefault': 'now'});


            $('body').on('change', '#deal_type_id', function () {

                $('#deal_type_time_1').hide();
                $('#deal_type_time_2').hide();
                $('#deal_type_time_3').hide();
                $('#deal_type_time_4').hide();
                $('#deal_type_time_' + $(this).val()).show();

            });

            $('body').on('change', '#is_custom_time', function () {
                if ($(this).val() == 1) {
                    $('#deal_type_time_1').hide();
                    $('#deal_type_time_2').hide();
                    $('#deal_type_time_3').hide();
                    $('#deal_type_time_4').hide();
                    $('#deal_custom_time').show();
                } else {
                    $('#deal_type_time_1').hide();
                    $('#deal_type_time_2').hide();
                    $('#deal_type_time_3').hide();
                    $('#deal_type_time_4').hide();
                    $('#deal_type_time_' + $('#deal_type_id').val()).show();
                    $('#deal_custom_time').hide();
                    $('#deal_start_time').val('')
                    $('#deal_end_time').val('')

                }
            });

        })
    </script>
</div>
<?PHP
function get_times($default = '00:00:00', $interval = '+30 minutes')
{

    $output = '';

    $current = strtotime('00:00:00');
    $end = strtotime('23:59:00');

    while ($current <= $end) {
        $time = date('H:i:s', $current);
        $sel = ($time == $default) ? ' selected' : '';

        $output .= "<option value=\"{$time}\"{$sel}>" . date('h.i A', $current) . '</option>';
        $current = strtotime($interval, $current);
    }

    return $output;
}
?>
@include('user.include.footer')