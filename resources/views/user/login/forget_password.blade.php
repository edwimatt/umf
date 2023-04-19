<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/user-stylesheet/user-style.css')}}">
    <!-- <link rel="stylesheet" href="assets/css/custom.css"> -->




</head>
<body class="bg-img">


<!-- /.login-logo -->
<div class="row nomargin justify-content-center">
    <div class="col-md-4">

    </div>
    <div class="col-md-4 text-center mb-4">
        <img src="{{asset('image/applogo.png')}}" class="img-responsive logo-img" style="background-color: #fff;padding: 8px;">
        <div  class="card mt-5">
            @include('user.error')
            @if (Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    @foreach(Session::get('error')['data'] as $key => $value)

                        {{$value}}<br/>

                    @endforeach
                </div>
                {{ Session::forget('error')  }}
            @endif
            <form method="post" class="login">
                {{ csrf_field() }}
                <input type="hidden" class="submit_url"  value="{{ URL::to('user/forgot/password') }}" />
                <div class="input-group form-group fields" id="custom-form1">

                    <i class="fa fa-user icon1" id="icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="Your Email" id="custom-input1" required="required">
                </div>

                <button class="btn btn-default btn-lg" id="submit-btn">Submit</button>

            </form>
        </div>

    </div>
    <div class="col-md-4"></div>
</div>
<!-- /.login-box-body -->

<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/user-js/common.js')}}"></script>
<!-- iCheck -->

<script src="{{asset('assets/js/user-js/login.js')}}"></script>

</body>
</html>
