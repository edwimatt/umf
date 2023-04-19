@include('user.include.header')
@include('user.include.sidebar')
<div class="right_col" role="main">
    <div class="panel panel-default">
        <form autocomplete="off" enctype="multipart/form-data" method="post" action="{{url('/user/editpostphysician')}}"
              accept-charset="UTF-8">
            <div class="panel-heading cust-head">Edit Physician</div>
            <div class="panel-body">
                @if (Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        @foreach(Session::get('error')['data'] as $key => $value)
                            {{$value}}<br/>
                        @endforeach
                    </div>
                    {{ Session::forget('error')  }}
                @endif
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">First name</label>
                    <?PHP
                    $first_name = '';
                    if (isset($post_data['first_name']) && $post_data['first_name'] != '') {
                        $first_name = $post_data['first_name'];
                    }
                    ?>
                    <input type="text" class="form-control" id="first_name" maxlength="30" name="first_name"
                           placeholder="First name" value="<?PHP echo $first_name ?>"/>
                </div>
                <div class="form-group">
                    <label for="title">Last name</label>
                    <?PHP
                    $last_name = '';
                    if (isset($post_data['last_name']) && $post_data['last_name'] != '') {
                        $last_name = $post_data['last_name'];
                    }
                    ?>
                    <input type="text" class="form-control" id="last_name" maxlength="30" name="last_name"
                           placeholder="Last name" value="<?PHP echo $last_name ?>"/>
                </div>
                <div class="form-group">
                    <label for="title">Email</label>
                    <?PHP
                    $email = '';
                    if (isset($post_data['email']) && $post_data['email'] != '') {
                        $email = $post_data['email'];
                    }
                    ?>
                    <input type="email" class="form-control" readonly value="<?PHP echo $email ?>"/>
                </div>
                <div class="form-group">
                    <label for="title">Mobile No</label>
                    <?PHP
                    $mobile_no = '';
                    if (isset($post_data['mobile_no']) && $post_data['mobile_no'] != '') {
                        $mobile_no = $post_data['mobile_no'];
                    }
                    ?>
                    <input type="text" class="form-control" id="mobile_no" maxlength="30" name="mobile_no"
                           placeholder="Mobile No" value="<?PHP echo $mobile_no ?>"/>
                </div>

                <div class="form-group">
                    <label for="title">User Image</label>
                    <input type="file" class="form-control" id="image_url" name="image_url"/>
                    <br>
                    @if($post_data['image_url'] != '')
                        <img width="200px" src="<?PHP echo URL::to('uploads/user/' . $post_data['image_url']) ?>"
                             alt="">
                    @endif
                </div>
                <div class="form-group">
                    <label for="title">Active / Deactivate Physician</label>
                    <select id="is_active" name="is_active" class="form-control">
                        <option value="">Select option</option>
                        <option  {!! ($post_data['is_active'] == 1) ? "selected='selected'" : "" !!} value="1">Active</option>
                        <option  {!! ($post_data['is_active'] == 0) ? "selected='selected'" : "" !!} value="0">Deactivate</option>
                    </select>
                </div>

                <input type="hidden" name="id" value="<?PHP echo $post_data['id']?>">
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <hr class="border">
    <div class="row" id="pg-content">
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
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
        /* var select_all = document.getElementById("select_all"); //select all checkbox
         var checkboxes = document.getElementsByClassName("checkboxdummy"); //checkbox items

         //select all checkboxes
         select_all.addEventListener("change", function(e){
             for (i = 0; i < checkboxes.length; i++) {
                 checkboxes[i].checked = select_all.checked;
             }
         });


         for (var i = 0; i < checkboxes.length; i++) {
             checkboxes[i].addEventListener('change', function(e){ //".checkbox" change
                 //uncheck "select all", if one of the listed checkbox item is unchecked
                 if(this.checked == false){
                     select_all.checked = false;
                 }
                 //check "select all" if all checkbox items are checked
                 if(document.querySelectorAll('.checkboxdummy:checked').length == checkboxes.length){
                     select_all.checked = true;
                 }
             });
         }*/

        $(document).ready(function () {
            $('body').on('change', '#deal_type_id', function () {

                $('#deal_type_time_1').hide();
                $('#deal_type_time_2').hide();
                $('#deal_type_time_3').hide();
                $('#deal_type_time_4').hide();
                $('#deal_type_time_' + $(this).val()).show();
                $('#deal_custom_time').hide();
                $('#deal_start_time').val('')
                $('#deal_end_time').val('')
                $('#is_custom_time_no').val('')
                $("#is_custom_time_no").prop("checked", true);
                $("#is_custom_time_yes").prop("checked", false);


            });

            $('body').on('change', '#is_custom_time_yes', function () {

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

            $('body').on('change', '#is_custom_time_no', function () {

                if ($(this).val() == 0) {

                    $('#deal_type_time_1').hide();
                    $('#deal_type_time_2').hide();
                    $('#deal_type_time_3').hide();
                    $('#deal_type_time_4').hide();
                    $('#deal_custom_time').hide();
                    $('#deal_start_time').val('')
                    $('#deal_end_time').val('')
                    $('#deal_type_time_' + $('#deal_type_id').val()).show();
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