@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | My Order Detail')
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
                <h6 class="text-grey" style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Order List / <a href="" class="text-grey">Detail Order List</a></h6>
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
                  <div class="mb-2">
                    <h6 class="text-grey py-2 mb-0" style="border-top: 1px solid #f7f7f7;border-bottom: 1px solid #f7f7f7;">Rincian pesanan</h6>
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
                    <div class="row mb-1">
                      <div class="col-6 col-xl-8 text-right">
                        <p class="mb-0 fs-09 text-grey">Total harga produk</p>
                      </div>
                      <div class="col-6 col-xl-4 text-right">
                        <p class="mb-0 fs-09 text-grey">Rp. 450.000</p>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <div class="col-6 col-xl-8 text-right">
                        <p class="mb-0 fs-09 text-grey">Ongkos Kirim</p>
                      </div>
                      <div class="col-6 col-xl-4 text-right">
                        <p class="mb-0 fs-09 text-grey">Rp. 30.000</p>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <div class="col-6 col-xl-8 text-right">
                        <p class="mb-0 fs-09 text-grey">Pajak</p>
                      </div>
                      <div class="col-6 col-xl-4 text-right">
                        <p class="mb-0 fs-09 text-grey">Rp. 10.000</p>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <div class="col-6 col-xl-8 text-right">
                        <p class="mb-0 fs-09 text-grey">Biaya tambahan</p>
                      </div>
                      <div class="col-6 col-xl-4 text-right">
                        <p class="mb-0 fs-09 text-grey">Rp. 10.000</p>
                      </div>
                    </div>
                    <div class="row mb-1 mt-3">
                      <div class="col-6 col-xl-8 text-right">
                        <h6 class="text-grey">Total Pembayaran</h6>
                      </div>
                      <div class="col-6 col-xl-4 text-right">
                        <h6 class="text-grey">Rp. 490.000</h6>
                      </div>
                    </div>
                  </div>
                  <div class="grey p-3">
                    <h6 class="text-grey mb-4">Alamat pengiriman</h6>
                    <p class="mb-1 fs-09 text-grey">Alamat 1</p>
                    <p class="mb-1 fs-09 text-grey">Abdul</p>
                    <p class="mb-1 fs-09 text-grey">Jl Tebet barat VIII No 35, RT 10/RW 4, Tebet Barat, Tebet, Kota Jakarta Selatan, DKI Jakarta 12810</p>
                    <p class="mb-1 fs-09 text-grey">Telp: 089875994567</p>
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