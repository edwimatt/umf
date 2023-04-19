@include('includes.header')
<body id="page-top">
<!-- Navigation-->
@include('includes.nav')
<section class="section">
    <div class="container">
        <div class="text-left">
            <h2 class="section-heading mb-4">Hospital Registration</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                    {{ Session::forget('price_error_message')  }}
                @endif
                @if (!empty($error))
                    @foreach($error['data'] as $key => $value)
                        <div class="alert alert-danger" role="alert">
                            <p><strong>Validation Error: </strong><br>{{$value['email']}}</p>
                        </div>
                    @endforeach
                    {{ Session::forget('error')  }}
                @endif
                <form action="{{ url('/hospital/post-hospital-register') }}" method="post" class="login" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="hospital_image">Hospital Logo</label>
                        <?PHP
                        $hospital_image = '';
                        if (isset($post_data['hospital_image']) && $post_data['hospital_image'] != '') {
                            $hospital_image = $post_data['hospital_image'];
                        }
                        ?>
                        <input type="file" class="form-control" id="hospital_image" name="hospital_image" />

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">First Name</label>
                        <?PHP
                        $first_name = '';
                        if (isset($post_data['first_name']) && $post_data['first_name'] != '') {
                            $first_name = $post_data['first_name'];
                        }
                        ?>
                        <input value="<?PHP echo $first_name?>" type="text" name="first_name" class="form-control" placeholder="First Name" id="custom-input1" required="required">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Last Name</label>
                        <?PHP
                        $last_name = '';
                        if (isset($post_data['last_name']) && $post_data['last_name'] != '') {
                            $last_name = $post_data['last_name'];
                        }
                        ?>
                        <input value="<?PHP echo $last_name?>" type="text" name="last_name" class="form-control" placeholder="Last Name" id="custom-input1" required="required">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hospital Name</label>
                        <?PHP
                        $hospital_name = '';
                        if (isset($post_data['hospital_name']) && $post_data['hospital_name'] != '') {
                            $hospital_name = $post_data['hospital_name'];
                        }
                        ?>
                        <input value="<?PHP echo $hospital_name ?>" type="text" name="hospital_name" class="form-control" placeholder="Hospital Name" id="custom-input1" required="required">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Address</label>
                        <?PHP
                        $email = '';
                        if (isset($post_data['email']) && $post_data['email'] != '') {
                            $email = $post_data['email'];
                        }
                        ?>
                        <input value="<?PHP echo $email ?>" type="email" name="email" class="form-control" placeholder="Email Address" id="custom-input1" required="required">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <?PHP
                        $password = '';
                        if (isset($post_data['password']) && $post_data['password'] != '') {
                            $password = $post_data['password'];
                        }
                        ?>
                        <input value="<?PHP echo $password?>" type="Password" name="password" class="form-control" placeholder="Password" id="custom-input2" required="required">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">How many employees will use UMF app?</label>
                        <?PHP
                        $employees_registration = '';
                        if (isset($post_data['employees_registration']) && $post_data['employees_registration'] != '') {
                            $employees_registration = $post_data['employees_registration'];
                        }
                        ?>
                        <input value="<?PHP echo $employees_registration?>" type="number" name="employees_registration" class="form-control" placeholder="How many employees will use UMF app?" id="custom-input2" required="required">
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                    <div class="form-group mt-4">
                        <!-- <a href="{{URL::to('user/login/user_forget_password')}}" class="text-info">Forgot Password?</a> |  -->
                        If you have already account: <a href="{{URL::to('user/login')}}" class="text-info">Login</a>
                  </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include('includes.footer')
</body>
</html>