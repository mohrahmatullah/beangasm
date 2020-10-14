@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | Wishlist')
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
						  <h6 style="padding-bottom: .75rem;border-bottom: 1px solid #f7f7f7;">Wishlist</h6>
						</div>
					</div>
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