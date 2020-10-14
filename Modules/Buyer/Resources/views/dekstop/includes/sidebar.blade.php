
<!-- Side Menu Section -->
<div class="col-12 col-lg-3 pr-lg-0 mb-2">
	<!-- Profile Section -->
	<div class="row mx-0 py-3 px-1 white" style="border-bottom: 1px solid #f7f7f7;">
		<div class="col-12">
			<div class="d-flex align-items-center">
				<div class="primary img-circle mr-3 d-inline-block" style="width: 65px;height: 65px;">
				<img class="of-cover w-100 h-100 img-circle" src="{{url('assets/frontend/img/1.png')}}" />
				</div>
				<div class="d-inline-block">
					<h6 class="mb-0 text-grey">{{ $login_user_details['user_display_name'] }}</h6>
					<p class="mb-0 text-grey" style="font-size: .8rem;">{!! Carbon\Carbon::parse($login_user_details['member_since'])->format('d, M Y') !!}</p>
					<p class="mb-0 text-grey" style="font-size: .8rem;">Bean Points: @if(isset($login_user_details['total_points']) && $login_user_details['total_points'] > 0) {!! number_format($login_user_details['total_points'],0,',','.') !!} @else 0 @endif</p>
				</div>
			</div>
		</div>
		<!-- <div class="col-12 text-right">
			<a href="" class="d-inline-flex align-items-center text-grey" style="font-size: .8rem;"><img class="of-cover mr-1" src="{{url('assets/frontend/img/edit.png')}}" width="15" height="15" />Edit Profile</a>
		</div> -->
	</div>
	<!-- /Profile Section -->

	<!-- Menu User Section -->
	<div class="row mx-0 white mb-2">
		<div class="col-12 px-0">
			<ul class="list-unstyled mb-0">
				<li><a href="{{ route('buyer-dashboard') }}" class="p-3 d-flex align-items-center dsb-menu-link active"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/dashboard.svg')}}" width="20" height="20" /> Halaman Depan</a></li>
				<li><a href="{{ route('buyer-myorder') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/bag-l.svg')}}" width="20" height="20" /> Order Saya <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
				<li><a href="{{ route('buyer-wishlist') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/heart.svg')}}" width="20" height="20" /> Wishlist</a></li>
				<li><a href="{{ route('buyer-coupon') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/coupon.svg')}}" width="20" height="20" /> Kupon Saya</a></li>
				<li><a href="{{ route('buyer-profile') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/user-l.svg')}}" width="20" height="20" /> Profile</a></li>
			</ul>
		</div>
	</div>
	<!-- /Menu User Section -->

	<!-- Button Sign Up Vendor -->
	<a href="/" class="btn-bean mb-2 w-100 fw-500 text-white d-inline-block text-center" >
		Daftar Vendor
	</a>
	<!-- /Button Sign Up Vendor -->

	<!-- Button Logout -->
	<form method="post" action="{{ route('post-buyer-logout') }}" enctype="multipart/form-data">
		<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">  
		<button type="submit" class="btn-bean mb-2 w-100 fw-500 text-primary white">Logout</button>
	</form>
	<!-- /Button Logout -->

</div>
<!-- /Side Menu Section -->