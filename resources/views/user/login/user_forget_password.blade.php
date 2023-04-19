<!-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
     Tell the browser to be responsive to screen width
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/user-stylesheet/user-style.css')}}">
    <link rel="stylesheet" href="assets/css/custom.css"> 
</head>
<body class="bg-img">
<div class="row nomargin justify-content-center">
    <div class="col-md-4">
    </div>
    <div class="col-md-4 text-center mb-4">
        <img src="{{asset('image/applogo.png')}}" class="img-responsive logo-img" style="background-color: #fff;padding: 8px; width: 500px;" >
        <div  class="card mt-5">
            <form method="post" class="login" action="{{ URL::to('user/forgot/userpassword') }}">
                {{ csrf_field() }}
                <input type="hidden" class="submit_url"  value="{{ URL::to('user/forgot/password') }}" />
                <div class="input-group form-group fields" id="custom-form1">
                    <i class="fa fa-user icon1" id="icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="Your Email" id="custom-input1" required="required">
                </div>
                <input type="submit" name="submit" value="submit" class="btn btn-default btn-lg">
                &nbsp;&nbsp;<a href="{{ URL::to('user/login') }}" class="txt1" style="color: white">Back to Login</a>
            </form>
        </div>

    </div>
    <div class="col-md-4"></div>
</div> -->
<!-- /.login-box-body -->
<!-- /.login-box -->
<!-- jQuery 3 -->

@include('includes.header')
   @include('includes.nav')
   <section class="section">
      <div class="container">
         <div class="text-left">
            <h2 class="section-heading mb-4">Forgot Password</h2>
         </div>
         <div class="row">
            <div class="col-md-12">
               <form enctype="multipart/form-data" method="post" class="login" action="{{ URL::to('user/forgot/userpassword') }}" accept-charset="UTF-8">
               @include('user.error')
            @if (Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    @foreach(Session::get('error')['data'] as $key => $value)

                        {{$value}}<br/>

                    @endforeach
                </div>
                {{ Session::forget('error')  }}
            @endif
            <?PHP
            if(isset($_GET['v']) && $_GET['v'] == "s")
                {
            ?>
            <div class="alert alert-info" role="alert">
                We have sent a link on your email address. Click on the link in the email to reset your password.
            </div>
             <?PHP
                }
            ?>

            <?PHP
            if(isset($_GET['v']) && $_GET['v'] == "e")
            {
            ?>
            <div class="alert alert-danger" role="alert">
                You provided email does not exist in our records.
            </div>
            <?PHP
            }
            ?>
                  {{ csrf_field() }}
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email</label>
                     <input  type="email" name="email" class="form-control" placeholder="Your Email" id="custom-input1" required="required">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <div class="form-group mt-4">
                    If you have already account: <a href="{{URL::to('user/login')}}" class="text-info">Login</a>

                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
   @include('includes.footer')