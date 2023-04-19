@include('user.include.header')
@include('user.include.sidebar')
<div class="right_col" role="main">
   <div class="panel panel-default">
      <form enctype="multipart/form-data" method="post" action="{{url('/user/posteditprofile')}}" accept-charset="UTF-8">
         {{ csrf_field() }}
         <div class="panel-heading cust-head">
            Edit Profile
         </div>
         <div class="panel-body">
            <div class="row" id="pg-content">
               <?PHP
                  if(isset($_GET['s']) && $_GET['s'] == "c"){
                  ?>
               <div class="alert alert-success">Profile has been updated successfully.</div>
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
                     <label for="exampleFormControlSelect1">First Name</label>


                     <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?PHP echo $user->first_name?>" />
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <label for="exampleFormControlSelect1">Last Name</label>
                     <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?PHP echo $user->last_name?>" />
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12">
                     <label for="exampleFormControlSelect1">Hospital Name</label>
                     <input type="text" class="form-control" id="name" name="hospital_name" placeholder="Hospital Name" value="<?PHP echo $hospital->name?>" />
                  </div>
               </div>


                  <div class="form-group">
                     <label for="exampleFormControlSelect1">Banner</label>
                     <?PHP


                     if(!empty($hospital->hospital_image)){

                     ?>
                        <br/>
                        <img width="200px" src="<?PHP echo URL::to('/uploads/user/' . $hospital->hospital_image) ?>" alt="">
                     <?PHP } else {?>

                        <br/>
                     <br/>
                        <img width="300px" src="<?PHP echo URL::to('/uploads/user/banner-no-image.png') ?>" alt="">
                     <br/>
                     <br/>
                     <?PHP }?>


                     <input type="file" class="form-control" id="hospital_image" name="hospital_image" />
                  </div>
            </div>
         </div>
         <div class="panel-footer"><button type="submit" class="btn btn-primary">Submit</button></div>
      </form>
   </div>
</div>
@include('user.include.footer')