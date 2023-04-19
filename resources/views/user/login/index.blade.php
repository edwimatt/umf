<!-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/user-stylesheet/user-style.css')}}">
</head>
<body class="bg-img">
    <div class="row nomargin justify-content-center">
        <div class="col-md-4 text-center mb-4">
           <img src="{{asset('image/applogo.png')}}" class="img-responsive logo-img" style="background-color: #fff;padding: 8px; width: 500px;" >
        </div>
    </div>

    <div class="row nomargin justify-content-center">

        <div class="col-md-4">
           <div  class="card">
                <form action="{{ url('/user/loginweb') }}" method="post" class="login">
                <div class="input-group form-group fields" id="custom-form1">

                    <i class="fa fa-user icon1" id="icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="User Name" id="custom-input1" required="required">
                </div>

                <div class="input-group form-group" id="custom-form2">
                    <i class="fa fa-key icon2" id="icon"></i>
                    <input type="Password" name="password" class="form-control" placeholder="Password" id="custom-input2" required="required">
                </div>
                <input type="submit"  name="submit" value="Login" class="btn btn-default btn-lg" id="login-btn">
                <div class="flex-sb-m w-full">
                    <div class="contact100-form-checkbox">
                    </div>
                    <div>
                        <a href="{{URL::to('user/login/user_forget_password')}}" class="txt1">
                            Forgot Password?
                        </a>|&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{URL::to('hospial/register')}}" class="txt1">
                            Register
                        </a>
                    </div>
                </div>
            </form>
            </div>
        </div>

    </div>
</body>
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{asset('assets/js/user-js/login.js')}}"></script>
</html> -->
@include('includes.header')
<body id="page-top">
   <!-- Navigation-->
   @include('includes.nav')
   <section class="section">
      <div class="container">
         <div class="text-left">
            <h2 class="section-heading mb-4">Sign In</h2>
         </div>
         <div class="row">
            <div class="col-md-12">
               <form enctype="multipart/form-data" action="{{ url('/user/loginweb') }}" method="post" class="login" accept-charset="UTF-8">
               @if (!empty($error))
                   @foreach($error['data'] as $key => $value)
                       <div class="alert alert-danger" role="alert">
                           <p><strong>Validation Error: </strong><br>{{$value['email']}}</p>
                       </div>
                   @endforeach
                   {{ Session::forget('error')  }}
               @endif
                  {{ csrf_field() }}
                  <div class="form-group">
                     <label for="email">Email Address</label>
                     <input type="email" name="email" class="form-control" placeholder="Email Address" id="email" required="required">
                  </div>
                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type="Password" name="password" class="form-control" placeholder="Password" id="password" required="required">
                  </div>

                  <input type="submit"  name="submit" value="Login" class="btn btn-primary" id="login-btn" >
                  <div class="form-group mt-4">
                    <a href="{{URL::to('user/login/user_forget_password')}}" class="text-info">
                        Forgot Password?
                    </a>
                    </a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
   @include('includes.footer')
</body>
</html>