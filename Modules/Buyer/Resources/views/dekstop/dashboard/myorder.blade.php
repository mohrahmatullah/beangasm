@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | My Order')
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
						<h6 style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Order List</h6>
						</div>
					</div>

					<!-- Order Table -->
					<section class="row">
						
						<div class="col-12">
							<div class="table-responsive">
								<table class="table">
								<thead class="thead-light">
									<tr>
                    <th scope="col">No</th>
                    <th scope="col">Order Id</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>							

									<tr>
                    <th scope="row">01</th>
                    <td>#001</td>
                    <td>On Hold</td>
                    <td>Rp. 50.000.000</td>
                    <td>10/12/2020</td>
                    <td>
                      <a href="{{ route('buyer-myorder-detail') }}" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">View Detail</a>
                    </td>
									</tr>
									
									<tr>
                    <th scope="row">01</th>
                    <td>#001</td>
                    <td>On Hold</td>
                    <td>Rp. 50.000.000</td>
                    <td>10/12/2020</td>
                    <td>
                      <a href="{{ route('buyer-myorder') }}" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">View Detail</a>
                    </td>
									</tr>
									
									<tr>
                    <th scope="row">01</th>
                    <td>#001</td>
                    <td>On Hold</td>
                    <td>Rp. 50.000.000</td>
                    <td>10/12/2020</td>
                    <td>
                      <a href="{{ route('buyer-myorder') }}" class="d-inline-block py-1 px-2 primary text-white btn mb-2 dsb-crd-1-ket">View Detail</a>
                    </td>
									</tr>
									
								</tbody>
								</table>
							</div>
						</div>
						
					</section>
					<!-- /Order Table -->

					</div>
				</div>
			</div>
			<!-- /Content Section -->
		</div>
  </div>
</main>
<!-- /Main -->

@endsection