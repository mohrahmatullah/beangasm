@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | Coupon')
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
						  <h6 style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Daftar coupon saya</h6>
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
                      <th scope="col">Active</th>
                      <th scope="col">Kode Kupon</th>
                      <th scope="col">Masa Berlaku</th>
                      <th scope="col">Besaran</th>
                      <th scope="col">Ketentuan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">01</th>
                      <td>Active</td>
                      <td>BEAN50</td>
                      <td>10/01/2020 - 30/01/2020</td>
                      <td>50%</td>
                      <td>
                        Potongan berlaku untuk kategori green beans
                      </td>
                    </tr>
                    
                    <tr>
                      <th scope="row">02</th>
                      <td>Expired</td>
                      <td>BEAN10K</td>
                      <td>10/01/2020 - 30/01/2020</td>
                      <td>10000</td>
                      <td>
                        Potongan hanya berlaku untuk pembelian di store beangasm
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