@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | Dashboard')
@section('content')

<!-- Main -->
<main style="background: #f7f7f7;">
  <div class="container py-3">
		<div class="row">
			@include('buyer::dekstop.includes.sidebar')
			<!-- Content Section -->
			<div class="col-12 col-lg-9 mb-2">
				<div class="row mx-0 p-3 white">
					<div class="col-12">
					<div class="row mb-3">
						<div class="col-12">
							<h6 style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Dashboard Saya</h6>
						</div>
					</div>

					<!-- Pop up sign up vendor -->
					<section class="row align-items-center p-3 mb-3" style="background: #f7f7f7;">
						<div class="col-12 col-lg-8">
						<div class="d-flex align-items-center">
							<div class="primary p-3 img-circle mr-3 d-inline-flex align-items-center justify-content-center" style="width: 75px;height: 75px;">
								<svg version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve" width="30px" height="30px">
									<g>
										<path d="M476.996,114.074l-34.133-102.4C440.541,4.701,434.016-0.002,426.667,0H51.2c-7.349-0.002-13.874,4.701-16.196,11.674L0.87,114.074c-0.526,1.594-0.82,3.255-0.87,4.932c0,0.171,0,0.29,0,0.461v17.067c0.062,26.74,12.707,51.892,34.133,67.891c0,0.137,0,0.239,0,0.375v221.867c0,28.277,22.923,51.2,51.2,51.2h307.2c28.277,0,51.2-22.923,51.2-51.2V204.8c0-0.137,0-0.239,0-0.375c21.426-15.999,34.072-41.151,34.133-67.891v-17.067c0-0.171,0-0.29,0-0.461    C477.816,117.328,477.523,115.667,476.996,114.074z M358.4,34.133h55.962l22.767,68.267H358.4V34.133z M256,34.133h68.267V102.4H256V34.133z M153.6,34.133h68.267V102.4H153.6V34.133z M63.505,34.133h55.962V102.4H40.738L63.505,34.133z M273.067,443.733H204.8V307.2h68.267V443.733z M409.6,426.667c0,9.426-7.641,17.067-17.067,17.067H307.2v-153.6c0-9.426-7.641-17.067-17.067-17.067h-102.4c-9.426,0-17.067,7.641-17.067,17.067v153.6H85.333c-9.426,0-17.067-7.641-17.067-17.067V220.16c23.951,4.917,48.857-0.799,68.267-15.667c30.466,22.376,71.934,22.376,102.4,0c30.466,22.376,71.934,22.376,102.4,0c19.41,14.869,44.316,20.584,68.267,15.667V426.667z M392.533,187.733c-14.759-0.009-28.774-6.483-38.349-17.715c-6.202-7.097-16.984-7.823-24.081-1.621c-0.576,0.503-1.118,1.045-1.621,1.621c-18.977,21.18-51.529,22.965-72.709,3.989c-1.401-1.256-2.733-2.587-3.989-3.989c-6.679-7.097-17.847-7.437-24.945-0.757c-0.26,0.245-0.513,0.497-0.757,0.757c-18.976,21.18-51.529,22.965-72.709,3.989c-1.402-1.256-2.733-2.587-3.989-3.989c-6.679-7.097-17.848-7.437-24.945-0.757c-0.26,0.245-0.513,0.497-0.757,0.757c-9.575,11.232-23.589,17.706-38.349,17.715c-28.277,0-51.2-22.923-51.2-51.2h409.6C443.733,164.81,420.81,187.733,392.533,187.733z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFFFFF"/>
									</g>
								</svg>
							</div>
							<div class="d-inline-block w-75">
							<h6>Daftar Menjadi Vendor</h6>
							<p class="mb-0" style="font-size: .9rem;">Here's you have ability to view a snapshot of your recent account activity or what's happening with your account right now !</p>
							</div>
						</div>
						</div>
						<div class="col-12 col-lg-4">
						<a href="/" class="btn-bean mt-2 w-100 fw-500 text-white d-inline-block text-center" >
							Daftar Vendor
						</a>
						</div>
					</section>
					<!-- /Pop up sign up vendor -->

					<!-- Dashboard Information Section -->
					<section class="row mb-3">
						<div class="col-12">
						<h6 class="d-flex align-items-center">
							<div class="primary img-circle mr-2 d-inline-block" style="width: 20px;height: 20px;">
								@if($login_user_details['user_photo_url'])
									<img class="of-cover w-100 h-100 img-circle" src="{{url('assets/frontend/img/1.png')}}" />
								@else
									<img class="of-cover w-100 h-100 img-circle" src="{{url('assets/frontend/img/1.png')}}" />
								@endif
							</div>
							Hallo, {{ $login_user_details['user_display_name'] }}
						</h6>
						<p class="fs-09">Here's you have ability to view a snapshot of your recent account activity or what's happening with your account right now !</p>
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

					@include('buyer::dekstop.includes.table-wishlist')

					</div>
				</div>
			</div>
			<!-- /Content Section -->
		</div>
  </div>
</main>
<!-- /Main -->

@endsection