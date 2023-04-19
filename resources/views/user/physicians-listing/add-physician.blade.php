@include('user.include.header')
@include('user.include.sidebar')
<div class="right_col" role="main">
    <div class="row" id="content-heading">
        <form autocomplete="off" enctype="multipart/form-data" method="post"
              action="{{url('/user/post-physician-register')}}"
              accept-charset="UTF-8">
            <div class="panel panel-default">
                <div class="panel-heading cust-head">
                    Add New User
                </div>
                <div class="panel-body">
                    @if (Session::get('error'))
                        <div class="alert alert-danger" role="alert">
                            @foreach(Session::get('error')['data'] as $key => $value)
                                {{$value}}<br/>
                            @endforeach
                        </div>
                        <?PHP
                        //dd($request);
                        ?>
                        {{ Session::forget('error')  }}
                        {{ Session::forget('posting_data')  }}
                    @endif
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="title">First Name</label>
                        <?PHP
                        $title = '';
                        if (isset($post_data['first_name']) && $post_data['first_name'] != '') {
                            $first_name = $post_data['first_name'];
                        }
                        ?>
                        <input type="text" maxlength="30" class="form-control" id="first_name" name="first_name"
                               placeholder="First name"
                               value="<?PHP echo $first_name ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="title">Last Name</label>
                        <?PHP
                        $last_name = '';
                        if (isset($post_data['last_name']) && $post_data['last_name'] != '') {
                            $last_name = $post_data['last_name'];
                        }
                        ?>
                        <input type="text" maxlength="30" class="form-control" id="last_name" name="last_name"
                               placeholder="Last name"
                               value="<?PHP echo $last_name ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="title">Email</label>
                        <?PHP
                        $email = '';
                        if (isset($post_data['email']) && $post_data['email'] != '') {
                            $email = $post_data['email'];
                        }
                        ?>
                        <input type="text" maxlength="30" class="form-control" id="email" name="email"
                               placeholder="Email"
                               value="<?PHP echo $email ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="title">Password</label>
                        <?PHP
                        $email = '';
                        if (isset($post_data['password']) && $post_data['password'] != '') {
                            $password = $post_data['password'];
                        }
                        ?>
                        <input type="password" maxlength="30" class="form-control" id="password" name="password"
                               placeholder="Password" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="title">Mobile No</label>
                        <?PHP
                        $mobile_no = '';
                        if (isset($post_data['mobile_no']) && $post_data['mobile_no'] != '') {
                            $mobile_no = $post_data['mobile_no'];
                        }
                        ?>
                        <input type="text" maxlength="30" class="form-control" id="mobile_no" name="mobile_no"
                               placeholder="Mobile No" value="<?PHP echo $mobile_no ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="title">User Image</label>
                        <input type="file" class="form-control" id="image_url" name="image_url"/>
                    </div>

                    <div class="form-group">
                        <label for="title">Active / Deactivate Physician</label>
                        <select id="is_active" name="is_active" class="form-control">
                            <option value="">Select option</option>
                            <option value="1">
                                Active
                            </option>
                            <option value="0">
                                Deactivate
                            </option>
                        </select>
                    </div>
                </div>


                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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