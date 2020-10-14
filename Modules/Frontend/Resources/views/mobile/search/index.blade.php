@extends('frontend::mobile.includes.default')
@section('title', 'Beangasm | Search')
@section('content')
<!-- Main Content -->
<main>
	<section class="store-ls-s d-flex align-items-center pt-3 pb-5 wow fadeIn" data-wow-delay=".7s">
		<div class="container">
			<nav class="desc-nav">
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
				  <a class="nav-item nav-link w-50 active" id="nav-desc-tab" data-toggle="tab" href="#nav-desc" role="tab" aria-controls="nav-desc" aria-selected="true">Products</a>
				  <a class="nav-item nav-link w-50" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="false">Store</a>
				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-desc" role="tabpanel" aria-labelledby="nav-desc-tab">
					<div class="row pt-3 mb-3">
						<div class="col-12 d-flex justify-content-between align-items-center">          
							<ul class="list-unstyled mb-0 d-none d-lg-block">
								<li class="float-left mr-2">
									<select class="wide lnk-sort sort-by-filter">
										<option value="all" data-display="Urutkan">Urutkan</option>
										<option value="terbaru" {{ (isset($input['sort']) && $input['sort'] == 'terbaru') ? 'selected' : '' }}>Terbaru</option>
										<option value="termurah" {{ (isset($input['sort']) && $input['sort'] == 'termurah') ? 'selected' : '' }}>Termurah</option>
										<option value="termahal" {{ (isset($input['sort']) && $input['sort'] == 'termahal') ? 'selected' : '' }}>Termahal</option>
									</select>
								</li>
							</ul>
							@if(count($store) > 0)
								Showing {{ sizeof($products) }} products for "{{ $input['q'] }}"
							@endif
					</div>
				</div>
				<!-- #DESKTOP# -->
				@if(count($products) > 0)
				<div class="row">
					{{--<div class="col-12 col-xl-3">

						<!-- Filter Mobile -->
						<div class="row">
							<div class="col-12">
								<div class="accordion mb-3" id="accordFlt">
									<div class="card accord">

										<div class="card-header accord" id="accordFltHead">
											<h2 class="mb-0">
												<button class="btn btn-link d-flex w-100 justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#accordFltBdy" aria-expanded="true" aria-controls="collapseOne">
													Filter
													<img class="arrow-flt-accord of-cover" src="{{url('assets/frontend/img/arrow-r-b.svg')}}" />
												</button>
											</h2>
										</div>
								
										<!-- <div id="accordFltBdy" class="collapse" aria-labelledby="accordFltHead" data-parent="#accordFlt">
											<div class="card-body accord">
												<div class="row mb-2">
													<form class="col-12" action="{{ route('search') }}" method="GET">
														<label>Price Range</label>
														<input type="text" name="price_min" class="form-control mb-2" placeholder="Price Min" value="{{ isset($input['price_min']) ? $input['price_min'] : '' }}" required />
														<input type="text" name="price_max" class="form-control mb-2" placeholder="Price Max" value="{{ isset($input['price_max']) ? $input['price_max'] : '' }}" required />
														<input type="submit" class="btn primary text-white d-block w-100" value="Cari">
													</form>
												</div>
												<div class="row">
													<div class="col-12">
														<label>Acidity</label>
														<select class="wide mb-2 sort-by-acidity-min" name="acidity_min">
															<option data-display="Acidity Min" value="0" {{ (isset($input['acidity_min']) && $input['acidity_min'] == 0) ?  'selected' : '' }} >Acidity Min</option>
															<option value="1" {{ (isset($input['acidity_min']) && $input['acidity_min'] == 1 ) ?  'selected' : '' }}>1</option>
															<option value="2" {{ (isset($input['acidity_min']) && $input['acidity_min'] == 2 ) ?  'selected' : '' }}>2</option>
															<option value="3" {{ (isset($input['acidity_min']) && $input['acidity_min'] == 3 ) ?  'selected' : '' }}>3</option>
															<option value="4" {{ (isset($input['acidity_min']) && $input['acidity_min'] == 4 ) ?  'selected' : '' }}>4</option>
														</select>
														<select class="wide mb-2 sort-by-acidity-max" name="acidity_max">
															<option data-display="Acidity Max" value="0" {{ (isset($input['acidity_max']) && $input['acidity_max'] == 0) ?  'selected' : '' }}>Acidity Max</option>
															<option value="1" {{ (isset($input['acidity_max']) && $input['acidity_max'] == 1 ) ?  'selected' : '' }}>1</option>
															<option value="2" {{ (isset($input['acidity_max']) && $input['acidity_max'] == 2 ) ?  'selected' : '' }}>2</option>
															<option value="3" {{ (isset($input['acidity_max']) && $input['acidity_max'] == 3 ) ?  'selected' : '' }}>3</option>
															<option value="4" {{ (isset($input['acidity_max']) && $input['acidity_max'] == 4 ) ?  'selected' : '' }}>4</option>
														</select>
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<label>Sweetness</label>
														<select class="wide mb-2 sort-by-sweetness-min" name="sweetness_min">
															<option data-display="Sweetness Min" value="0" {{ (isset($input['sweetness_min']) && $input['sweetness_min'] == 0) ?  'selected' : '' }}>Sweetness Min</option>
															<option value="1" {{ (isset($input['sweetness_min']) && $input['sweetness_min'] == 1 ) ?  'selected' : '' }}>1</option>
															<option value="2" {{ (isset($input['sweetness_min']) && $input['sweetness_min'] == 2 ) ?  'selected' : '' }}>2</option>
															<option value="3" {{ (isset($input['sweetness_min']) && $input['sweetness_min'] == 3 ) ?  'selected' : '' }}>3</option>
															<option value="4" {{ (isset($input['sweetness_min']) && $input['sweetness_min'] == 4 ) ?  'selected' : '' }}>4</option>
														</select>
														<select class="wide mb-2 sort-by-sweetness-max" name="sweetness_max">
														<option data-display="Sweetness Max" value="0" {{ (isset($input['sweetness_max']) && $input['sweetness_max'] == 0) ?  'selected' : '' }}>Sweetness Max</option>
															<option value="1" {{ (isset($input['sweetness_max']) && $input['sweetness_max'] == 1 ) ?  'selected' : '' }}>1</option>
															<option value="2" {{ (isset($input['sweetness_max']) && $input['sweetness_max'] == 2 ) ?  'selected' : '' }}>2</option>
															<option value="3" {{ (isset($input['sweetness_max']) && $input['sweetness_max'] == 3 ) ?  'selected' : '' }}>3</option>
															<option value="4" {{ (isset($input['sweetness_max']) && $input['sweetness_max'] == 4 ) ?  'selected' : '' }}>4</option>
														</select>
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<label>Body</label>
														<select class="wide mb-2 sort-by-body-min" name="body_min">
															<option data-display="Body Min" value="0" {{ (isset($input['body_min']) && $input['body_min'] == 0) ?  'selected' : '' }}>Body Min</option>
															<option value="1" {{ (isset($input['body_min']) && $input['body_min'] == 1 ) ?  'selected' : '' }}>1</option>
															<option value="2" {{ (isset($input['body_min']) && $input['body_min'] == 2 ) ?  'selected' : '' }}>2</option>
															<option value="3" {{ (isset($input['body_min']) && $input['body_min'] == 3 ) ?  'selected' : '' }}>3</option>
															<option value="4" {{ (isset($input['body_min']) && $input['body_min'] == 4 ) ?  'selected' : '' }}>4</option>
														</select>
														<select class="wide mb-2 sort-by-body-max" name="body_max">
														<option data-display="Body Max" value="0" {{ (isset($input['body_max']) && $input['body_max'] == 0) ?  'selected' : '' }}>Body Max</option>
															<option value="1" {{ (isset($input['body_max']) && $input['body_max'] == 1 ) ?  'selected' : '' }}>1</option>
															<option value="2" {{ (isset($input['body_max']) && $input['body_max'] == 2 ) ?  'selected' : '' }}>2</option>
															<option value="3" {{ (isset($input['body_max']) && $input['body_max'] == 3 ) ?  'selected' : '' }}>3</option>
															<option value="4" {{ (isset($input['body_max']) && $input['body_max'] == 4 ) ?  'selected' : '' }}>4</option>
														</select>
													</div>
												</div>
											</div>
										</div> -->

									</div>
								</div>
							</div>
						</div>

					</div>--}}

					<div class="col-12 col-xl-9" id="product-category">
						<div class="item-list-m">
							@foreach($products as $p)
								@php
											$details = DB::table('users_details')->where('user_id', $p->author_id)->where('users_details.details','LIKE','%profile_details%')->first()->details;
											$score_star = get_comments_rating_details( $p->id, 'product' );
								@endphp
							<div class="">
								<div class="hm-fp-c-m pb-3 mb-3" onclick="window.location='{{ route('detail-product', $p->slug) }}';">
									<div class="hm-fp-img mb-3">
										<img src="{{ config('app.url_media').$p->image_url }}" style="width: 100%; height: 100%;" />
										{{---<div class="hm-fp-img-nt">Discount 10%</div>
										<div class="hm-fp-img-wl"><i class="fas fa-heart checked"></i></div>--}}
									</div>
									<div class="hm-fp-bdy w-100 mb-3">
										<h5 class="mb-2">{{ $p->title }}</h5>
										<div class="hm-fp-bdy-pr mb-1">{{ money($p->price) }}</div>
										<div class="hm-fp-bdy-ct mb-1">{{ json_decode($details)->profile_details->city }}</div>
										{{--
										@if(isset($score_star))
										<div class="row">
											<div class="col-12 col-lg-6">
												<div class="score hm-fp-bdy-rt mb-1">
													<div class="score-wrap">
															<span class="stars-active" style="width: {{ $score_star['percentage'] }}%">
																	<i class="fa fa-star" aria-hidden="true"></i>
																	<i class="fa fa-star" aria-hidden="true"></i>
																	<i class="fa fa-star" aria-hidden="true"></i>
																	<i class="fa fa-star" aria-hidden="true"></i>
																	<i class="fa fa-star" aria-hidden="true"></i>
															</span>
															<span class="stars-inactive">
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
																<i class="fas fa-star"></i>
															</span>
													</div>
												</div>
											</div>
											<div class="col-12 col-lg-6">
													<div class="rt-t mb-1">({!! $score_star['total'] !!} ulasan)</div>
											</div>
										</div>                  
										@endif
										<div class="hm-fp-bdy-rt mb-1">
											<i class="fas fa-star checked"></i>
											<i class="fas fa-star checked"></i>
											<i class="fas fa-star checked"></i>
											<i class="fas fa-star"></i>
											<i class="fas fa-star"></i>
											<div class="rt-t mb-1">(9999 ulasan)</div>
										</div>--}}
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				<div id="list-terkini-ajax">
					<div class="row">
					  <div class="col-12 text-center">
					    <div class="mr-btn d-inline-block m-3" id="load-more">
					      <!-- Pagination -->
					      @php $paginator = $products; @endphp
					      {!! $paginator->appends(Request::capture()->except('page'))->render('layouts.paggingmore') !!}
					      <!-- /Pagination -->
					    </div>
					  </div>
					</div>
				</div>
				@else
				<div class="row">
					<div class="col-12 text-center">
					  <b>Oops, product nggak ditemukan</b>
					</div>
				</div>
				@endif
				</div>
				<div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
					@if(count($store) > 0)
					<div class="row pt-3 mb-3">
						<div class="col-12 d-flex justify-content-between align-items-center">
							Menampilkan {{ sizeof($store) }} store untuk "{{ $input['q'] }}"
						</div>
					</div>
					@endif
					<div class="row"> 
					@if(count($store) > 0)
						@foreach($store as $s)
						@php
						$details = json_decode($s->details);
						@endphp
						<div class="col-6 col-md-4 col-lg-3">
						  <a href="{{ route('detail-list-store', $s->name) }}" class="hm-fp-c pb-3 mb-4 d-block s">
						    <div class="hm-fp-img p-3 p-xl-5">
						      <img src="{{ (!empty($s->user_photo_url)) ? config('app.url_media').$s->user_photo_url : config('app.url_media').'/public/uploads/1568189974-h-100-default.jpeg'  }}" class="img-circle" style="width: 100%; height: 100%;" />
						    </div>
						    <div class="hm-fp-bdy w-100 px-3">
						      <h5 class="mb-2" >{{ $s->display_name }}</h5>
						      <div class="hm-fp-bdy-ct mb-1">Member Since : {{ date('d/m/Y', strtotime($s->member_since))  }}</div>
						      <div class="hm-fp-bdy-ct mb-1 text-primary">{{ $details->profile_details->city }}</div>
						    </div>
						  </a>
						</div>
						@endforeach
					@else
						<div class="col-12 text-center">
						  <b>Oops, toko nggak ditemukan</b>
						</div>
					@endif
					</div>
					<div id="list-terkini-ajax-str">
						<div class="row">
						  <div class="col-12 text-center">
						    <div class="mr-btn d-inline-block m-3" id="load-more-str">
								<!-- Pagination -->
								@php $paginator = $store; @endphp
								{!! $paginator->appends(Request::capture()->except('store'))->render('layouts.paggingmorestr') !!}
								<!-- /Pagination -->
						    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<!-- /Main Content -->
@endsection