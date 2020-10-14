@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | Dashboard')
@section('content')

<!-- Main -->
<main style="background: #f7f7f7;">
  <div class="container py-3">
		<div class="row">
			<!-- Side Menu Section -->
			<div class="col-12 col-lg-3 pr-lg-0 mb-2">
				<!-- Profile Menu Section -->
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
				<!-- /Profile Menu Section -->

				<!-- Menu User Section -->
				<div class="row mx-0 white" style="border-bottom: 1px solid #f7f7f7;">
					<div class="col-12 px-0">
					<ul class="list-unstyled mb-0">
						<li><a href="{{ route('store-dashboard') }}" class="p-3 d-flex align-items-center dsb-menu-link active"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/dashboard.svg')}}" width="20" height="20" /> Halaman Depan</a></li>
						<li><a href="{{ route('store-myorder') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/bag-l.svg')}}" width="20" height="20" /> Order Saya <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
						<li><a href="{{ route('store-wishlist') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/heart.svg')}}" width="20" height="20" /> Wishlist</a></li>
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
								<h6 style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Dashboard Saya</h6>
							</div>
						</div>

						<!-- Store Notif -->
						<section class="row align-items-center p-3 mb-3" style="background: #f7f7f7;">
							<div class="col-12 col-lg-6">
								<div class="d-flex align-items-center">
									<div class="primary p-3 img-circle mr-3 d-inline-block" style="width: 75px;height: 75px;"></div>
									<div class="d-inline-block w-75">
										<h6 class="text-grey mb-0 fs-095">Toko Abdul Jaelani</h6>
										<div class="mb-0 text-grey mb-0">
											<div class="score-wrap">
												<span class="stars-active">
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
												</span>
											</div>
											<div class="mb-0 text-grey mb-0 fs-07">
												55% Respon positif
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<div class="row">
									<div class="col-6">
										<h3 class="text-grey fw-400 mb-1">
											999
										</h3>
										<h6 class="text-grey fw-500 mb-2 fs-08">
											Order Masuk
										</h6>
										<a href="" class=" fs-07">Lihat Pesanan</a>
									</div>
									<div class="col-6">
										<h3 class="text-grey fw-400 mb-1">
											999
										</h3>
										<h6 class="text-grey fw-500 mb-2 fs-08">
											Ulasan Masuk
										</h6>
										<a href="" class=" fs-07">Lihat Chat</a>
									</div>
								</div>
							</div>
						</section>
						<!-- /Store Notif -->

						<!-- Dashboard Information Section -->
						<section class="row mb-3">
							<div class="col-12">
								<h6 class="d-flex align-items-center">
									<div class="primary img-circle mr-2 d-inline-block" style="width: 20px;height: 20px;">
									<img class="of-cover w-100 h-100 img-circle" src="{{url('assets/frontend/img/1.png')}}" />
									</div>
									Hallo, Abdul Jaelani
								</h6>
								<p style="font-size: .9rem;">Here's you have ability to view a snapshot of your recent account activity or what's happening with your account right now !</p>
							</div>
							<div class="col-12">
								<div class="row">
									<div class="col-12 col-lg-4 mb-2">
										<div class="dsb-crd-1 p-2">
											<div class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Pembelian hari ini</div>
											<h1 class="text-grey fw-400">
												999
											</h1>
											<h6 class="text-grey fw-500 mb-0">
												Pembelian
											</h6>
											<div class="dsb-crd-1-date">12 Desember 2018</div>
										</div>
										<a href="/" class="primary p-2 d-block dsb-crd-1-btn text-white text-right">
											Lihat selengkapnya
										</a>

									</div>
									<div class="col-12 col-lg-4 mb-2">
										<div class="dsb-crd-1 p-2">
											<div class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Riwayat pembelian</div>
												<h1 class="text-grey fw-400">
													999
												</h1>
												<h6 class="text-grey fw-500 mb-0">
													Riwayat
												</h6>
												<div class="dsb-crd-1-date">12 Desember 2018</div>
										</div>
										<a href="/" class="primary p-2 d-block dsb-crd-1-btn text-white text-right">
											Lihat selengkapnya
										</a>
									</div>
									<div class="col-12 col-lg-4 mb-2">
										<div class="dsb-crd-1 p-2">
											<div class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">Voucher diskon</div>
											<h1 class="text-grey fw-400">
												999
											</h1>
											<h6 class="text-grey fw-500 mb-0">
												Voucher belum terpakai
											</h6>
											<div class="dsb-crd-1-date">12 Desember 2018</div>
										</div>
										<a href="/" class="primary p-2 d-block dsb-crd-1-btn text-white text-right">
											Lihat selengkapnya
										</a>
									</div>
								</div>
							</div>
						</section>
						<!-- /Dashboard Information Section -->

						<!-- Wishlist Table -->
						<section class="row">
							<div class="col-12">
								<h6 class="d-flex align-items-center">
									Wishlist
								</h6>
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