@include('user.include.header')
@include('user.include.sidebar')

<div class="right_col" role="main">
<div class="row" id="content-heading">
<div class="col-md-12">
            <h1 class="cust-head">Update Deal Information</h1>
        </div>
        </div>
        <hr class="border">
        <div class="row" id="pg-content">
{{--   @include('user.error')--}}
   <?PHP
   //dd($post_data);
   ?>
   <form autocomplete="off" enctype="multipart/form-data" method="post" action="{{url('/user/editpostdeal')}}" accept-charset="UTF-8">
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
           <label for="exampleFormControlSelect1">Category</label>
           <select class="form-control" id="deal_categories_id" name="deal_categories_id">
               <?PHP
                   $sel = '';
               foreach ($business_categories as $business_category){
                   if(isset($post_data['deal_categories_id']) && $post_data['deal_categories_id'] > 0){
                       if($post_data['deal_categories_id'] == $business_category->id){
                           $sel = ' SELECTED';
                       }else{
                           $sel = '';
                       }
                   }

               ?>
               <option <?PHP echo $sel?> value="<?PHP echo $business_category->id ?>"><?PHP echo $business_category->name ?></option>
               <?PHP } ?>
           </select>
       </div> <br>


       <div class="form-group">
           <label for="exampleFormControlSelect1">Deal Type</label>
           <select class="form-control" id="deal_type_id" name="deal_type_id">
               <?PHP
               $sel = '';
               foreach ($deal_types as $deal_type){
               if (isset($post_data['deal_type_id']) && $post_data['deal_type_id'] > 0) {
                   if ($post_data['deal_type_id'] == $deal_type->id) {
                       $sel = ' SELECTED';
                   } else {
                       $sel = '';
                   }
               }
               ?>
               <option
                   <?PHP echo $sel?> value="<?PHP echo $deal_type->id ?>"><?PHP echo $deal_type->deal_type_title ?></option>
               <?PHP } ?>
           </select>
           <br>
           <?PHP
           $deal_type_time_style = ' style="display: none;font-size: 20px;font-weight: bold;"';
           foreach ($deal_types as $deal_type){
           if ($post_data['is_custom_time'] == 0) {
               if ($post_data['deal_type_id'] == $deal_type->id) {
                   $deal_type_time_style = ' style="display: block;font-size: 20px;font-weight: bold;"';
               } else {
                   $deal_type_time_style = ' style="display: none;font-size: 20px;font-weight: bold;"';
               }
           }else{
               $deal_type_time_style = ' style="display: none;font-size: 20px;font-weight: bold;"';
           }
           ?>
           <span <?PHP echo $deal_type_time_style ?> id="deal_type_time_<?PHP echo $deal_type->id?>"><?PHP echo $deal_type->deal_type_time ?></span>

           <?PHP }?>
           <?PHP
           $is_custom_time_yes = '';
           $is_custom_time_no = ' checked="checked"';
           if(isset($post_data['is_custom_time']) && $post_data['is_custom_time'] == 1){
               $is_custom_time_yes = ' checked="checked"';
               $is_custom_time_no = '';
           }
           ?>

           <h4>OR <br>Choose deal type time optional
               <input <?PHP echo $is_custom_time_yes?> type="radio" name="is_custom_time" id="is_custom_time_yes" value="1">Yes
               <input type="radio" name="is_custom_time" id="is_custom_time_no" value="0" <?PHP echo $is_custom_time_no?>> No</h4>
       </div>
           <?PHP
           $deal_custom_time_style = ' style="display: none"';
           if(isset($post_data['is_custom_time']) && $post_data['is_custom_time'] == 1){
               $deal_custom_time_style = ' style="display: block"';
           }
           ?>
           <div class="form-group" id="deal_custom_time" <?PHP echo $deal_custom_time_style?>>
           <label for="exampleFormControlSelect1">Start Time</label>
           <?PHP
           $deal_start_time = '';
           if (isset($post_data['deal_start_time']) && $post_data['deal_start_time'] != '') {
               $deal_start_time = $post_data['deal_start_time'];
           }
               if ($post_data['is_custom_time'] == 0) {
                   $deal_start_time = "";
               }
           ?>
           <select name="deal_start_time" id="deal_start_time">
               <option value="">Select</option>
               <?PHP
               /*if($post_data['deal_type_id'] != 5){
                   if($deal_start_time != ""){
                       echo get_times($deal_start_time);
                   }else{
                       echo get_times("Select");
                   }
               }else{
                   echo get_times("Select");
               }*/
               if($deal_start_time != ""){
                   echo get_times($deal_start_time);
               }else{
                   echo get_times("Select");
               }
               ?>
           </select>


           <label for="exampleFormControlSelect1">End Time</label>

           <?PHP
           $deal_end_time = '';
           if (isset($post_data['deal_end_time']) && $post_data['deal_end_time'] != '') {
               $deal_end_time = $post_data['deal_end_time'];
           }

               if ($post_data['is_custom_time'] == 0) {
                   $deal_end_time = "";
               }
           ?>

           <select name="deal_end_time" id="deal_end_time">
               <option value="">Select</option>
               <?PHP
               if($deal_end_time != ""){
                   echo get_times($deal_end_time);
               }else{
                   echo get_times("Select");
               }

               ?>
               <?PHP
               if($post_data['deal_type_id'] != 4){
                   if($deal_end_time != ""){
                       echo get_times($deal_end_time);
                   }else{
                       echo get_times("Select");
                   }
               }else{
                   echo get_times("Select");
               }
               ?>
           </select>


       </div>

       <div class="form-group">
           <label for="title">Title</label>
           <?PHP
           $title = '';
           if(isset($post_data['title']) && $post_data['title'] != ''){
               $title = $post_data['title'];
           }
           ?>
           <input type="text" class="form-control" id="title" maxlength="30" name="title" placeholder="Deal Title" value="<?PHP echo $title ?>" />
       </div> <br>
       <div class="form-group">
           <label for="exampleFormControlSelect1">Description</label>
           <?PHP
           $description = '';
           if(isset($post_data['description']) && $post_data['description'] != ''){
               $description = $post_data['description'];
           }
           ?>
           <textarea rows="10" class="form-control" maxlength="45" id="description" name="description" placeholder="Deal Description"  /><?PHP echo ($description)?></textarea>
       </div> <br>


<div class="row">
       <div class="form-group col-md-6">
           <label for="exampleFormControlSelect1">Start Date</label>
           <?PHP
           $start_date = '';
           if(isset($post_data['start_date']) && $post_data['start_date'] != ''){
               $start_date = $post_data['start_date'];
           }
           ?>
           <input type="text" class="form-control datepicker" id="start_date" name="start_date" placeholder="Deal start Date" value="<?PHP echo $start_date ?>"/>
       </div>

       <div class="form-group col-md-6">
           <label for="exampleFormControlSelect1">Expiry Date</label>
           <?PHP
           $expiry_date = '';
           if(isset($post_data['expiry_date']) && $post_data['expiry_date'] != ''){
               $expiry_date = $post_data['expiry_date'];
           }
           ?>
           <input type="text" class="form-control datepicker" id="expiry_date" name="expiry_date" placeholder="Deal expiry Date" value="<?PHP echo $expiry_date ?>"/>
       </div>

</div><br>
<div class="row">
       <div class="form-group col-md-6">
           <label for="exampleFormControlSelect1">Limit Deal Redemptions</label>
           <?PHP
           $validity = '';
           if(isset($post_data['validity']) && $post_data['validity'] != ''){
               $validity = $post_data['validity'];
           }
           ?>
           <input type="text" class="form-control" id="validity" name="validity" placeholder="Enter in the maximum number of times you want your Deal to be redeemed (Only number allowed)" onkeyup="this.value=this.value.replace(/[^\d]/,'')" value="<?PHP echo $validity?>" />
       </div>

       <div class="form-group col-md-6">
           <label for="exampleFormControlSelect1">Price</label>
           <?PHP
           $price = '';
           if(isset($post_data['price']) && $post_data['price'] != ''){
               $price = $post_data['price'];
           }
           ?>
           <input type="text" class="form-control" id="price" name="price" placeholder="Deal original price" onkeyup="this.value=this.value.replace(/[^\d]/,'')" value="<?PHP echo $price ?>" />
       </div>

</div> <br>
       <div class="form-group">
           <label for="exampleFormControlSelect1">Discount Price</label>
           <?PHP
           $discount_price = '';
           if(isset($post_data['discount_price']) && $post_data['discount_price'] != ''){
               $discount_price = $post_data['discount_price'];
           }
           ?>
           <input type="text" class="form-control" id="discount_price" name="discount_price" placeholder="Deal discount price" onkeyup="this.value=this.value.replace(/[^\d]/,'')" value="<?PHP echo $discount_price ?>" />
       </div> <br>

       <div class="form-group">
           <label for="exampleFormControlSelect1">Listing Type</label>
           <?PHP

           $normal = ' checked="checked"';
           $premium ="";
           if (isset($post_data['is_hot']) && $post_data['is_hot'] == "1") {
               $normal = ' checked="checked"';
               $premium ="";
           }

           if (isset($post_data['is_premium']) && $post_data['is_premium'] == "1") {
               $normal = '';
               $premium =' checked="checked"';
           }

           ?>
           <input <?PHP echo $normal ?>  type="radio" id="normal_premium" name="normal_premium" value="normal"> Normal
           <input <?PHP echo $premium ?> type="radio" id="normal_premium" name="normal_premium" value="premium"> Premium
       </div>

       <br>

       <div class="form-group">
           <label for="exampleFormControlSelect1">Deal Picture</label>

           <input type="file" class="form-control" id="deal_image" name="deal_image" />
           @if(file_exists( public_path().'/uploads/user/'.$post_data['deal_image'].''))
               <br />
               <img width="200px" src="<?PHP echo URL::to('/uploads/user/'.$post_data['deal_image']) ?>" alt="">
           @else
               <br />
               <img width="100px" src="<?PHP echo URL::to('/uploads/user/no-image-icon.png') ?>" alt="">
           @endif
       </div> 

        <input type="hidden" name="id" value="<?PHP echo $post_data['id']?>">

       <button type="submit" class="btn btn-primary">Submit</button>
   </form>
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
            $('body').on('change', '#deal_type_id', function() {

                $('#deal_type_time_1').hide();
                $('#deal_type_time_2').hide();
                $('#deal_type_time_3').hide();
                $('#deal_type_time_4').hide();
                $('#deal_type_time_'+$(this).val()).show();
                $('#deal_custom_time').hide();
                $('#deal_start_time').val('')
                $('#deal_end_time').val('')
                $('#is_custom_time_no').val('')
                $( "#is_custom_time_no" ).prop( "checked", true );
                $( "#is_custom_time_yes" ).prop( "checked", false );


            });

            $('body').on('change', '#is_custom_time_yes', function() {

                if($(this).val() == 1){

                    $('#deal_type_time_1').hide();
                    $('#deal_type_time_2').hide();
                    $('#deal_type_time_3').hide();
                    $('#deal_type_time_4').hide();
                    $('#deal_custom_time').show();
                }else{
                    $('#deal_type_time_1').hide();
                    $('#deal_type_time_2').hide();
                    $('#deal_type_time_3').hide();
                    $('#deal_type_time_4').hide();
                    $('#deal_type_time_'+$('#deal_type_id').val()).show();
                    $('#deal_custom_time').hide();
                    $('#deal_start_time').val('')
                    $('#deal_end_time').val('')

                }
            });

            $('body').on('change', '#is_custom_time_no', function() {

                if($(this).val() == 0){

                    $('#deal_type_time_1').hide();
                    $('#deal_type_time_2').hide();
                    $('#deal_type_time_3').hide();
                    $('#deal_type_time_4').hide();
                    $('#deal_custom_time').hide();
                    $('#deal_start_time').val('')
                    $('#deal_end_time').val('')
                    $('#deal_type_time_'+$('#deal_type_id').val()).show();
                }
            });

        })
    </script>
    

    </div>
<?PHP
function get_times( $default = '00:00:00', $interval = '+30 minutes' ) {

    $output = '';

    $current = strtotime( '00:00:00' );
    $end = strtotime( '23:59:00' );

    while( $current <= $end ) {
        $time = date( 'H:i:s', $current );
        $sel = ( $time == $default ) ? ' selected' : '';

        $output .= "<option value=\"{$time}\"{$sel}>" . date( 'h.i A', $current ) .'</option>';
        $current = strtotime( $interval, $current );
    }

    return $output;
}
?>
@include('user.include.footer')