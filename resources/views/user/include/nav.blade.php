@inject('provider', 'App\Http\Controllers\UserController')
<div class="row nomargin">
	<div class="top_nav">
		<div class="nav_menu">
			<nav>
				<div class="nav toggle">
				<a href="{{url('/user/physicians-listing')}}" style="padding:0px;"> 
						<img width="72" src="{{asset('assets/img/logo.png')}}" class="img-responsive">
					</a>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<?PHP $user_data = $provider::getUserData(Session::get('user')->id); ?>
                                {{--<img src={{URL::to('image/img.jpg')}} alt="">--}}{{ $user_data->first_name }} {{ $user_data->last_name }}
                                <span class="fas fa-angle-down" style="margin-right:10px; margin-left: 7px;"></span>
                            </a>

						<ul class="dropdown-menu dropdown-usermenu pull-right" >

							<li>
								<a  href="{{ URL::to('/user/editprofile') }}">Edit Profile</a>
							</li>
							 <li>
								 <a  href="{{ URL::to('/user/changeuserpassword') }}">Change Password</a>
							 </li>
							 <li>
								 <a href="{{ URL::to('/user/logout') }}">Log Out</a>
							 </li>
						</ul>
					</li>

				</ul>
			</nav>
		</div>
	</div>
</div>


<!-- <script type="text/javascript">
$(document).ready(function(){

    var columns = ['nav_user_name','user_image'];
    getEditRecord('POST',base_url + "/tenant/user/profile",{},{},columns); // UPDATE FUNCTION

})
</script> -->