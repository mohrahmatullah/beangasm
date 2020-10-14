@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | Wishlist')
@section('content')

<!-- Main -->
<main style="background: #f7f7f7;">
  <div class="container py-3">
		<div class="row">
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
								<h6 class="mb-0 text-grey">Abdul Jaelani</h6>
								<p class="mb-0 text-grey" style="font-size: .8rem;">Jakarta, Indonesia</p>
							</div>
						</div>
					</div>
					<!-- <div class="col-12 text-right">
						<a href="" class="d-inline-flex align-items-center text-grey" style="font-size: .8rem;"><img class="of-cover mr-1" src="{{url('assets/frontend/img/edit.png')}}" width="15" height="15" />Edit Profile</a>
					</div> -->
				</div>
				<!-- /Profile Section -->

				<!-- Menu User Section -->
				<div class="row mx-0 white" style="border-bottom: 1px solid #f7f7f7;">
					<div class="col-12 px-0">
					<ul class="list-unstyled mb-0">
						<li><a href="{{ route('store-dashboard') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/dashboard.svg')}}" width="20" height="20" /> Halaman Depan</a></li>
						<li><a href="{{ route('store-myorder') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/bag-l.svg')}}" width="20" height="20" /> Order Saya <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
						<li><a href="{{ route('store-wishlist') }}" class="p-3 d-flex align-items-center dsb-menu-link active"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/heart.svg')}}" width="20" height="20" /> Wishlist</a></li>
						<li><a href="{{ route('store-coupon') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/coupon.svg')}}" width="20" height="20" /> Kupon Saya</a></li>
						<li><a href="{{ route('store-profile') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/user-l.svg')}}" width="20" height="20" /> Profile</a></li>
					</ul>
					</div>
				</div>
				<!-- /Menu User Section -->

				<!-- Menu Store Section -->
				<div class="row mx-0 white mb-2">
					<div class="col-12 px-0">
					<ul class="list-unstyled mb-0">
						<li><a href="{{ route('store-myproduct') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/coffee-l.svg')}}" width="20" height="20" /> Produk Saya</a></li>
						<li><a href="{{ route('store-orders') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/shop.svg')}}" width="20" height="20" /> Penjualan <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
						<li><a href="{{ route('store-withdraw') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/money.svg')}}" width="20" height="20" /> Withdraw</a></li>
						<li><a href="{{ route('store-reviews') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/doc.svg')}}" width="20" height="20" /> Vendor Review</a></li>
						<li><a href="{{ route('store-notification') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/mail.svg')}}" width="20" height="20" /> Kotak Masuk <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
					</ul>
					</div>
				</div>
				<!-- Menu Store Section -->

				<!-- Button Sign Up Vendor -->
				<a href="/" class="btn-bean mb-2 w-100 fw-500 text-white d-inline-block text-center" >
					Change to user
				</a>
				<!-- /Button Sign Up Vendor -->

				<!-- Button Logout -->
				<form method="post" action="" enctype="multipart/form-data">
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">  
					<button type="submit" class="btn-bean mb-2 w-100 fw-500 text-primary white">Logout</button>
				</form>
				<!-- /Button Logout -->

			</div>
			<!-- /Side Menu Section -->

			<!-- Content Section -->
			<div class="col-12 col-lg-9 mb-2">
				<div class="row mx-0 p-3 white">
					<div class="col-12">
					<div class="row mb-3">
						<div class="col-12">
						  <h6 style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Wishlist</h6>
						</div>
					</div>

					<!-- Wishlist Table -->
					<section class="row">
						<div class="col-12">
						
						</div>
						<div class="col-12">
              <div class="table-responsive">
								<table class="table">
								<thead class="thead-light">
									<tr>
									<th scope="col">No</th>
									<th scope="col">Produk Image</th>
									<th scope="col">Description</th>
									<th scope="col">Availability</th>
									<th scope="col">Price</th>
									<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									<th scope="row">01</th>
									<td><img class="of-cover" src="{{url('assets/frontend/img/1.png')}}" width="50px" height="50px" /></td>
									<td>Coffee Arabica</td>
									<td>Tersedia</td>
									<td>Rp. 50.000.000</td>
									<td>
										<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Lihat</a>
										<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Hapus</a>
									</td>
									</tr>
									<tr>
									<th scope="row">02</th>
									<td><img class="of-cover" src="{{url('assets/frontend/img/2.png')}}" width="50px" height="50px" /></td>
									<td>Coffee Arabica</td>
									<td>Tersedia</td>
									<td>Rp. 50.000</td>
									<td>
										<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Lihat</a>
										<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Hapus</a>
									</td>
									</tr>
									<tr>
									<th scope="row">03</th>
									<td><img class="of-cover" src="{{url('assets/frontend/img/1.png')}}" width="50px" height="50px" /></td>
									<td>Coffee Arabica</td>
									<td>Tersedia</td>
									<td>Rp. 50.000</td>
									<td>
										<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Lihat</a>
										<a href="/" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Hapus</a>
									</td>
									</tr>
									
								</tbody>
								</table>
							</div>
						</div>
						
					</section>
					<!-- /Wishlist Table -->

					</div>
				</div>
			</div>
			<!-- /Content Section -->
		</div>
  </div>
</main>
<!-- /Main -->

@endsection