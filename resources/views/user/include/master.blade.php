<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('image/icon.png') }}" type="image/gif" sizes="20x20">
    <title>Project Title</title>
    <!-- Bootstrap -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/user-stylesheet/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!-- NProgress -->
    <link href="{{asset('assets/css/nprogress.css')}}" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="{{asset('assets/css/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/mytheme.css')}}" rel="stylesheet">
    <!-- jQuery -->


</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="top_nav ">
            {{--navbar navbar-fixed-top--}}
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src={{URL::to('image/img.jpg')}} alt="">John Doe
                                <span class="fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">

                                <li><a href="javascript:;">Change Password</a></li>
                                <li><div class="divider"></div></li>
                                <li><a href="{{URL::to('user/logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;padding:10px 40px;">
                        <a href="index.html" class="site_title">
                            <img src="{{asset('image/applogo.png')}}" class="img-responsive">
                        </a>
                    </div>


                <div class="clearfix"></div>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">

                            <?PHP
                            $user_business = Session::get('user_business');

                            if(isset($user_business)  && count($user_business) > 0)
                            {
                            ?>
                                <li><a href="{{ URL::to('user/business') }}"> <i class="fas fa-user icon" rel="tooltip" title="" ></i><span class="menu">Business</span></a></li>
                            <?PHP }?>
                            <li><a href="{{ URL::to('user/deals') }}"> <i class="fas fa-user icon" rel="tooltip" title="" ></i><span class="menu">Deals</span></a></li>
                            <?PHP
                            $user_business = Session::get('user_business');

                            if(isset($user_business)  && count($user_business) > 0)
                            {
                            ?>
                            <li><a href="{{ URL::to('user/branches') }}"> <i class="fas fa-user icon" rel="tooltip" title="" ></i><span class="menu">Branches</span></a></li>
                            <?PHP }?>
                            <li><a href="{{ URL::to('user/updatebranch') }}"> <i class="fas fa-user icon" rel="tooltip" title="" ></i><span class="menu">Update Branch</span></a></li>


                        </ul>
                    </div>


                </div>
                <!-- /sidebar menu -->

            </div>
        </div>
        <div class="right_col" role="main">
            @yield('content')
        </div>
    </div>
</div>
@yield('js')

<!-- FastClick -->

<!-- Bootstrap -->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('assets/js/nprogress.js')}}"></script>
<!-- jQuery custom content scroller -->
<script src="{{asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset('assets/js/custom.min.js')}}"></script>


</body>
</html>