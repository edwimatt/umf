@include('user.include.header')
@include('user.include.sidebar')
<div class="right_col" role="main">
   <div class="panel panel-default">
      <form enctype="multipart/form-data" method="post" action="{{url('/user/postchangeuserpassword')}}" accept-charset="UTF-8">
         {{ csrf_field() }}
         <div class="panel-heading cust-head">
            Change Password
         </div>
         <div class="panel-body">
            <div class="row" id="pg-content">
               <?PHP
                  if(isset($_GET['s']) && $_GET['s'] == "c"){
                  ?>
               <div class="alert alert-success">
                  <ul>
                     <li>Password has been changed successfully.</li>
                  </ul>
               </div>
               <?PHP } ?>
               @if($error)
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($error['data'] as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               @include('user.error')
               <div class="row">
                  <div class="form-group col-md-12">
                     <label for="exampleFormControlSelect1">Current Password</label>
                     <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" value="<?PHP echo $business->email?>" />
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <label for="exampleFormControlSelect1">New Password</label>
                     <input type="password" class="form-control" id="password" name="password" placeholder="New Password" value="<?PHP echo $business->email?>" />
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <label for="exampleFormControlSelect1">Confirm Password</label>
                     <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?PHP echo $business->email?>" />
                  </div>
               </div>
            </div>
         </div>
         <div class="panel-footer"><button type="submit" class="btn btn-primary">Submit</button></div>
      </form>
   </div>
</div>
@include('user.include.footer')