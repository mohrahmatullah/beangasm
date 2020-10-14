@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | Order Detail')
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
						<li><a href="{{ route('store-dashboard') }}" class="p-3 d-flex align-items-center dsb-menu-link"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/dashboard.svg')}}" width="20" height="20" /> Halaman Depan</a></li>
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
						<li><a href="{{ route('store-orders') }}" class="p-3 d-flex align-items-center dsb-menu-link active"><img class="of-cover mr-3 nav-img" src="{{url('assets/frontend/img/shop.svg')}}" width="20" height="20" /> Penjualan <div class="third d-inline-flex text-white ml-2 mcart-notif py-1 px-2">5</div></a></li>
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
							<div class="col-12" style="border-bottom: 1px solid #f7f7f7;">
                <h6 class="dsb-title-content d-inline-block">Order Detail</h6>
							</div>
            </div>
            
            <!-- Oder Detail -->
            <section class="row">
              <div class="col-12">

                <div class="p-3" style="border: 1px solid #f7f7f7">
                  <div class="text-center py-1 mb-2">
                    <img class="of-cover nav-img" src="{{url('assets/frontend/img/logo-v2.png')}}" width="100" height="100" />
                  </div>
                  <div class="w-100 d-flex mb-4 text-grey">
                    <div class="w-50">
                      <div class="d-inline-block fs-08">Order id <a href="">#121</a></div>
                    </div>
                    <div class="w-50 text-right">
                      <div class="d-inline-block fs-08">Thu, May 31, 2020 2:24 PM</div>
                    </div>
                  </div>
                  <div class="text-grey mb-2 fs-09">
                    Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.
                  </div>
                  <div class="text-grey mb-2 fs-09 py-3" style="border-top: 1px solid #f7f7f7;border-bottom: 1px solid #f7f7f7;">
                    <h6 class="text-grey mb-3">Order Status</h6>
                    <ul class="list-unstyled">
                      <li class="d-inline-flex align-items-center mr-4"><img class="of-cover mr-2 nav-img" src="{{url('assets/frontend/img/box.svg')}}" width="25" height="25" /> Processing</li>
                      <li class="d-inline-flex align-items-center mr-4"><img class="of-cover mr-2 nav-img" src="{{url('assets/frontend/img/route.svg')}}" width="25" height="25" /> Shipping</li>
                      <li class="d-inline-flex align-items-center mr-4"><img class="of-cover mr-2 nav-img" src="{{url('assets/frontend/img/tracking.svg')}}" width="25" height="25" /> Item Arrived</li>
                      <li class="d-inline-flex align-items-center mr-4"><img class="of-cover mr-2 nav-img" src="{{url('assets/frontend/img/product.svg')}}" width="25" height="25" /> Compleated</li>
                    </ul>
                  </div>
                  <div class="text-grey mb-2 fs-09 py-3">
                    <h6 class="text-grey mb-3">Shipping Status</h6>
                    <!-- Store Notif -->
                    <section class="row align-items-center mb-3">
                      <div class="col-6 col-lg-3">
                        <h6 class="text-grey fs-085">Shipping Method</h6>
                        <p class="mb-0 fs-09 text-grey">JNE (REG)</p>
                      </div>
                      
                      <div class="col-6 col-lg-3">
                        <h6 class="text-grey fs-085">Shipping Number</h6>
                        <p class="mb-0 fs-09 text-grey">541040025337220</p>
                      </div>
                      
                      <div class="col-6 col-lg-3">
                        <h6 class="text-grey fs-085">Estimated Items Arrived</h6>
                        <p class="mb-0 fs-09 text-grey">Sunday, 19 July 2020</p>
                      </div>
                      
                      <div class="col-6 col-lg-3">
                        <p class="mb-0 fs-09 text-grey">
                          <a href="">Shipping History</a>
                        </p>
                      </div>
                      
                      
                    </section>
                    <!-- /Store Notif -->
                  </div>
                  <div class="mb-2">
                    <h6 class="text-grey py-3 mb-0" style="border-top: 1px solid #f7f7f7;border-bottom: 1px solid #f7f7f7;">Rincian pesanan</h6>
                    <div class="row py-2 mb-2" style="border-bottom: 1px solid #f7f7f7;">
                      <div class="col-12 col-xl-4">
                        <h6 class="text-grey">Nama Produk</h6>
                        <p class="mb-0 fs-09 text-grey">Coffee Arabica</p>
                      </div>
                      <div class="col-6 col-xl-4 text-right">
                        <h6 class="text-grey">Jumlah</h6>
                        <p class="mb-0 fs-09 text-grey">200 mg</p>
                      </div>
                      <div class="col-6 col-xl-4 text-right">
                        <h6 class="text-grey">Harga</h6>
                        <p class="mb-0 fs-09 text-grey">Rp. 450.000</p>
                      </div>
                    </div>
                    <div class="row py-2 mb-2" style="border-bottom: 1px solid #f7f7f7;">
                      <div class="col-12 col-xl-4">
                        <h6 class="text-grey">Store</h6>
                        <p class="mb-3 fs-09 text-grey">COFFEACIRCULOR</p>
                        <h6 class="text-grey">Notes</h6>
                        <p class="mb-0 fs-09 text-grey">Tidak usah digiling Tidak usah digiling Tidak usah digiling Tidak usah digiling Tidak usah digiling</p>
                      </div>
                      <div class="col-6 col-xl-8 text-right">
                        <div class="row mb-1">
                          <div class="col-6 text-right">
                            <p class="mb-0 fs-09 text-grey">Total harga produk</p>
                          </div>
                          <div class="col-6 text-right">
                            <p class="mb-0 fs-09 text-grey">Rp. 450.000</p>
                          </div>
                        </div>
                        <div class="row mb-1">
                          <div class="col-6 text-right">
                            <p class="mb-0 fs-09 text-grey">Ongkos kirim</p>
                          </div>
                          <div class="col-6 text-right">
                            <p class="mb-0 fs-09 text-grey">Rp. 30.000</p>
                          </div>
                        </div>
                        <div class="row mb-1">
                          <div class="col-6 text-right">
                            <p class="mb-0 fs-09 text-grey">Pajak</p>
                          </div>
                          <div class="col-6 text-right">
                            <p class="mb-0 fs-09 text-grey">Rp. 10.000</p>
                          </div>
                        </div>
                        <div class="row mb-1">
                          <div class="col-6 text-right">
                            <p class="mb-0 fs-09 text-grey">Biaya tambahan</p>
                          </div>
                          <div class="col-6 text-right">
                            <p class="mb-0 fs-09 text-grey">Rp. 10.000</p>
                          </div>
                        </div>
                        <div class="row mb-1">
                          <div class="col-6 text-right">
                            <p class="mb-0 fs-09 text-grey">Kode unik</p>
                          </div>
                          <div class="col-6 text-right">
                            <p class="mb-0 fs-09 text-grey">Rp. 75</p>
                          </div>
                        </div>
                        <div class="row mb-1 mt-3">
                          <div class="col-6 text-right">
                            <h6 class="text-grey">Total Pembayaran</h6>
                          </div>
                          <div class="col-6 text-right">
                            <h6 class="text-grey">Rp. 490.000</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                  </div>
                  <div class="grey p-3">
                    <h6 class="text-grey mb-4">Alamat pengiriman</h6>
                    <p class="mb-1 fs-09 text-grey">Alamat 1</p>
                    <p class="mb-1 fs-09 text-grey">Abdul</p>
                    <p class="mb-1 fs-09 text-grey">Jl Tebet barat VIII No 35, RT 10/RW 4, Tebet Barat, Tebet, Kota Jakarta Selatan, DKI Jakarta 12810</p>
                    <p class="mb-1 fs-09 text-grey">Telp: 089875994567</p>
                    <p class="mb-1 fs-09 text-grey">Email: hello@me.com</p>
                  </div>
                  <div class="text-center p-3">
                    <p class="mb-0 fs-08 text-grey">Jika butuh bantuan, gunakan halaman <a href="">Kontak Kami</a></p>
                    <p class="mb-0 fs-08 text-grey">&copy; 2020, PT Gesha Bersama Ultima</p>
                  </div>
                </div>

              </div>
              
            </section>
            <!-- /Oder Detail -->
						
					</div>
				</div>
			</div>
			<!-- /Content Section -->

		</div>
  </div>
</main>
<!-- /Main -->

@endsection