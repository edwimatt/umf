@include('user.include.header')
@include('user.include.sidebar')
<div class="right_col" role="main">
<div class="row" id="content-heading">
<div class="col-md-8">
            <h1 class="cust-head">Deals Information</h1>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ URL::to('/user/deal/pdf') }}" target="_blank" id="downloadPDF" class="btn btn-info b1">Branch QR Code</a>
            <a href="{{ URL::to('user/adddeal') }}" class="btn btn-info b1">Add new Deal</a>
        </div>
        </div>
        <hr class="border">
        <div class="row" id="pg-content">
{{--   @include('user.error')--}}

   <div class="table-responsive">
       <table class="table table-striped jambo_table">
           <thead>
           <tr>
               <th scope="col">Title</th>
               {{--<th scope="col">QR Image</th>--}}
               <th scope="col">Image</th>
               <th scope="col">Start Date - Expiry Date</th>
               <th scope="col">Price</th>
               <th scope="col">Discount Price</th>
               <th scope="col">Discount</th>
               <th scope="col">Is Normal?</th>
               <th scope="col">Is Premium?</th>
               <th scope="col">Action</th>
           </tr>
           </thead>
           <tbody>

           <?PHP
           if(isset($Deals) && count($Deals) > 0){

            foreach ($Deals as $Deal){




           ?>



           <tr>
               <th scope="row"><?PHP echo $Deal->title ?></th>

               <td scope="row">
                   @if(file_exists( public_path().'/uploads/user/'.$Deal->deal_image) && $Deal->deal_image != '')
                       <img width="100px" src="<?PHP echo URL::to('/uploads/user/'.$Deal->deal_image) ?>" alt="">
                   @else

                       <img width="100px" src="<?PHP echo URL::to('/uploads/user/no-image-icon.png') ?>" alt="">
                   @endif
               </td>
               <td scope="row">
                   <?PHP echo date('Y-m-d', strtotime($Deal->start_date)) ?> - <?PHP echo date('Y-m-d', strtotime($Deal->expiry_date)) ?>
                       <?PHP
                           if(strtotime(date('Y-m-d')) > strtotime($Deal->expiry_date)){
                       ?>
                   <br />

                   <?PHP } ?>

               </td>
               <td>
                   <?PHP echo $Deal->price?>
               </td>
               <td><?PHP echo $Deal->discount_price?></td>
               <td>
                   <?PHP
                       if($Deal->discount_percent != ""){
                           echo $Deal->discount_percent.'%';
                       }else{
                           echo "-";
                       }
                   ?>
               </td>

               <td>
                   <?PHP
                   if($Deal->is_premium == "0"){
                       echo 'Yes';
                   }else{
                       echo 'No';
                   }
                   ?>
               </td>
               <td>
                   <?PHP
                   if($Deal->is_premium == "1"){
                       echo 'Yes';
                   }else{
                       echo 'No';
                   }
                   ?>
               </td>
               <td>
                   <?PHP
                   if(strtotime(date('Y-m-d')) > strtotime($Deal->expiry_date)){
                   ?>
                   <br />
                       <span style="color: red"><b>EXPIRED</b></span>


                   <?PHP } else {?>
                       <a href="{{ url('user/editdeal', $Deal->deal_id) }}" style="color:black;" title="Edit"> <i class="far fa-edit"></i> </a>
                   <?PHP } ?>


               </td>
           </tr>
           <?PHP } ?>
           <?PHP } ?>
           </tbody>
       </table>
       <?PHP echo $Deals->links() ?>
   </div>
</div>

    <script type="text/javascript">

    </script>

</div>
@include('user.include.footer')