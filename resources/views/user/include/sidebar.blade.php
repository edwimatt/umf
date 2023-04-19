<!--sidebar-->
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">

                    <li class="">
                        <a href="{{ URL::to('user/physicians-listing') }}">
                            <i class="glyphicon glyphicon-user" rel="tooltip" title="Users List"></i>
                            Users List
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ URL::to('user/messages') }}">
                            <i class="glyphicon glyphicon-comment" rel="tooltip" title="Messages"></i>
                            Messages
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ URL::to('user/hospital-email') }}">
                            <i class="glyphicon glyphicon-envelope" rel="tooltip" title="Hospital Email"></i>
                            Hospital Email
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ URL::to('user/hospital-news') }}">
                            <i class="glyphicon glyphicon-bell" rel="tooltip" title="Hospital News"></i>
                            Hospital News
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        {{--<div class="sidebar-footer hidden-small">--}}
            {{--<a data-toggle="tooltip" data-placement="top" title="Settings">--}}
                {{--<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>--}}
            {{--</a>--}}
            {{--<a data-toggle="tooltip" data-placement="top" title="FullScreen">--}}
                {{--<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>--}}
            {{--</a>--}}
            {{--<a data-toggle="tooltip" data-placement="top" title="Lock">--}}
                {{--<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>--}}
            {{--</a>--}}
            {{--<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">--}}
                {{--<span class="glyphicon glyphicon-off" aria-hidden="true"></span>--}}
            {{--</a>--}}
        {{--</div>--}}
        <!-- /menu footer buttons -->
    </div>
</div>
<!--sidebar-end-->
