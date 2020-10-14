@extends('frontend::mobile.includes.default')
@section('title', 'Beangasm | Store | '.$store->display_name)
@section('content')
<!-- Main Content -->
<main>
  <!-- #DESKTOP# -->
  <section class="d-flex store-ls-s align-items-center py-2 wow fadeIn" data-wow-delay=".7s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="row">

            <div class="col-12 col-md-4 col-lg-3">

              <a class="hm-fp-c pb-lg-3 mb-2 s d-flex align-items-center flex-lg-column flex-row">
                <div class="hm-fp-img p-3 p-xl-5 d-inline-flex align-items-center">
                  <img src="{{ (!empty($store->user_photo_url)) ? config('app.url_media').$store->user_photo_url : config('app.url_media').'/public/uploads/1568189974-h-100-default.jpeg'  }}" class="img-circle str-cover" />
                </div>
                <div class="hm-fp-bdy w-100 px-3">
                  <h5 class="mb-2">{{ $store->display_name }}</h5>
                  <div class="hm-fp-bdy-ct mb-1">Member Since : {{ date('d/m/Y', strtotime($store->member_since))  }}</div>
                    @php
	                    $details = DB::table('users_details')->where('user_id',$store->id)->where('users_details.details','LIKE','%profile_details%')->first()->details;
	                  @endphp	              
                  <div class="hm-fp-bdy-ct mb-1 text-primary">{{ json_decode($details)->profile_details->city }}</div>
                </div>
              </a>
            </div>

            <div class="col-12 col-md-8 col-lg-9">
              <div class="w-100 str-banner str-b owl-carousel owl-theme">
                <div class="item"><img src="{{url('assets/frontend/img/1.png')}}" class="of-cover" /></div>
                <div class="item"><img src="{{url('assets/frontend/img/1.png')}}" class="of-cover" /></div>
                <div class="item"><img src="{{url('assets/frontend/img/1.png')}}" class="of-cover" /></div>
                <div class="item"><img src="{{url('assets/frontend/img/1.png')}}" class="of-cover" /></div>
                <div class="item"><img src="{{url('assets/frontend/img/1.png')}}" class="of-cover" /></div>
                <div class="item"><img src="{{url('assets/frontend/img/1.png')}}" class="of-cover" /></div>
                <div class="item"><img src="{{url('assets/frontend/img/1.png')}}" class="of-cover" /></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
  <section class="hd-lnk-s py-3">
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">          
          <ul class="list-unstyled mb-0 d-none d-lg-block">
            <!-- <li class="float-left mr-2 mb-3"><a href="" class="hd-lnk lnk-filter active">Filter</a></li> -->
            <li class="float-left mr-2">
              <!-- <a href="" class="hd-lnk lnk-sort ">Urutkan</a> -->
              @if( (!(isset($input['type']))) )
              <div class="sort-width">
                <select class="wide lnk-sort sort-by-filter">
                  <option option value="all" data-display="Sort">Sort</option>
                  <option value="terbaru" {{ (isset($input['sort']) && $input['sort'] == 'terbaru') ? 'selected' : '' }}>Latest</option>
                  <option value="termurah" {{ (isset($input['sort']) && $input['sort'] == 'termurah') ? 'selected' : '' }}>Cheapest</option>
                  <option value="termahal" {{ (isset($input['sort']) && $input['sort'] == 'termahal') ? 'selected' : '' }}>Most expensive</option>
                </select>
              </div>
              @endif
            </li>
          </ul>          
          <ul class="list-unstyled mb-0 hd-lnk-m">
            <li class="mr-2"><a href="{{ Request::url() }}" class="hd-lnk {{ (request()->segment(1) && !$input) ? 'actived' : '' }}">All</a></li>
            @if(count($product_category) > 0)
              @foreach($product_category as $c)
              <li class="mr-2"><a href="{{ Request::url().'?category='.$c->slug }}" class="hd-lnk @if(isset($input['category'])) {{ ($c->slug == $input['category']) ? 'actived' : '' }} @endif">{{ $c->name }}</a></li>
              @endforeach
            @endif
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- Product -->
  <section class="d-flex d-none prd-ls-s d-flex align-items-center pt-3 pb-5 wow fadeIn" data-wow-delay=".7s">
    <div class="container">
      {{--<div class="row">
        <div class="col-5 text-left mb-4">
          <select class="lnk-sort sort-by-filter s-sort">
            <option value="all" data-display="Urutkan">Urutkan</option>
            <option value="terbaru" {{ (isset($input['sort']) && $input['sort'] == 'terbaru') ? 'selected' : '' }}>Terbaru</option>
            <option value="termurah" {{ (isset($input['sort']) && $input['sort'] == 'termurah') ? 'selected' : '' }}>Termurah</option>
            <option value="termahal" {{ (isset($input['sort']) && $input['sort'] == 'termahal') ? 'selected' : '' }}>Termahal</option>
          </select>
        </div>
        <div class="col-7 text-left mb-4">
          <h3><strong>Store Product</strong></h3>
        </div>
      </div>--}}
      <div class="row" id="product-category">
        <div class="col-12">
          <div class="item-list-m">
          	@if(count($products) > 0)
	            @foreach($products as $p)
	              @php
	                    $details = DB::table('users_details')->where('user_id', $p->author_id)->where('users_details.details','LIKE','%profile_details%')->first()->details;
                      $score_star = get_comments_rating_details( $p->id, 'product' );
	              @endphp
		            <div class="">
		              <div class="hm-fp-c-m pb-3 mb-3" onclick="window.location='{{ route('detail-product', $p->slug) }}';">
		                <div class="hm-fp-img mb-3">
		                  <img src="{{ config('app.url_media').$p->image_url }}" style="width: 100%; height: 100%;" />
		                  {{--<div class="hm-fp-img-nt">Discount 10%</div>
		                  <div class="hm-fp-img-wl"><i class="fas fa-heart checked"></i></div>--}}
		                </div>
		                <div class="hm-fp-bdy w-100 mb-3">
		                  <h5 class="mb-0 text-grey">{{ $p->title }}</h5>
		                  <div class="hm-fp-bdy-pr mb-1 fw-500">{{ money($p->price) }}</div>
		                  <div class="hm-fp-bdy-ct mb-1">{{ json_decode($details)->profile_details->city }}</div>
                      {{--
                      @if(isset($score_star))
                      <div class="row">
                        <div class="col-12">
                          <div class="score hm-fp-bdy-rt mb-1 fs-065">
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
                        <div class="col-12">
                          <div class="rt-t mb-1 fs-07">({!! $score_star['total'] !!} ulasan)</div>
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
            @endif
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
    </div>
  </section>

</main>
<!-- /Main Content -->
@endsection