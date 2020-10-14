@extends('frontend::mobile.includes.default')
@section('title', 'Beangasm | Home')
@section('content')

<!-- Main Content -->
<main>
  <header class="hm-t-b">
    <div class="hm-b-c owl-carousel owl-theme position-relative">
      <div class="item"><img class="w-100 h-auto of-cover" src="{{url('assets/frontend/img/Header-Beangasm.jpg')}}"/></div>
      <div class="item"><img class="w-100 h-auto of-cover" src="{{url('assets/frontend/img/Header-Beangasm.jpg')}}"/></div>
    </div>
  </header>

  @if(count($product_category) > 0)
  <section class="wow fadeIn py-3" data-wow-delay=".7s">
    <div class="container">
      <div class="row mx-0 ">
        <div class="col-12 text-center">
          <h3 class="text-uppercase text-grey"><strong>Category</strong></h3>
        </div>
      </div>

      @if(count($product_category) > 0)
      <div class="scroll py-3 pl-3 justify-content-center">
        <nav class="">
          @foreach($product_category as $p)
          <a href="{{ config('app.url').'product?category='.$p->slug }}" class="item-scroll mr-2 text-center" style="width: 85px;max-width: 85px;">
            <div class="p-2 img-circle mb-2 grey d-inline-block" >
              <img class="of-cover" src="{{ config('app.url_media').$p->category_img }}" width="40px" height="40px" />
            </div>
            <h4 class="fs-08 text-center px-1 text-grey fw-400" style="white-space: normal;overflow-wrap: break-word;">{{ $p->name }}</h4>
          </a>
          @endforeach
          
        </nav>
      </div>
      @endif

    </div>
  </section>
  @endif

  @if(count($features_items) > 0)
  <section class="hm-fp d-flex align-items-center py-5 wow fadeIn" data-wow-delay=".7s">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-4">
          <h3 class="text-grey"><strong>Featured Product</strong></h3>
        </div>
      </div>
      <div class="scroll mb-3">
        @foreach($features_items as $p)
        @php
          $details = DB::table('users_details')->where('user_id', $p->author_id)->where('users_details.details','LIKE','%profile_details%')->first()->details;
          $score_star = get_comments_rating_details( $p->id, 'product' );
        @endphp
        <a href="{{ route('detail-product', $p->slug) }}" class="hm-fp-c mb-3 item-scroll mr-2 shadow white" style="width: 149px;">
          <div class="hm-fp-img">
            <img src="{{ config('app.url_media').$p->image_url }}"/>
            {{--<div class="hm-fp-img-nt">Discount 10%</div>
            <div class="hm-fp-img-wl"><i class="fas fa-heart checked"></i></div>--}}
          </div>
          <div class="hm-fp-bdy w-100 p-2">
            <h5 class="mb-0 text-grey" style="white-space: normal;">{{ $p->title }}</h5>
            <div class="hm-fp-bdy-pr mb-1 fw-500">{{ money($p->price) }}</div>
            <div class="hm-fp-bdy-ct mb-1">{{ json_decode($details)->profile_details->city }}</div>
            {{--
            @if(isset($score_star))
            <div class="row">
              <div class="col-12 col-lg-6">
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
              <div class="col-12 col-lg-6">
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
        </a>
        @endforeach
      </div>
      
      <div class="row">
        <div class="col-12 text-center">
          <div class="mr-btn d-inline-block m-3">
            <a href="{{ config('app.url').'product?type=featured' }}">See others</a>
          </div>
        </div>
      </div>
      
    </div>
  </section>
  @endif

  @if(count($best_sales) > 0)
  <section class="hm-bs d-flex align-items-center py-5 wow fadeIn" data-wow-delay=".7s">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-4">
          <h3 class="text-grey"><strong>Best Seller</strong></h3>
        </div>
      </div>
      <div class="scroll mb-3">
        @foreach($best_sales as $p)
            @php
                  $details = DB::table('users_details')->where('user_id', $p->author_id)->where('users_details.details','LIKE','%profile_details%')->first()->details;
                  $score_star = get_comments_rating_details( $p->id, 'product' );
            @endphp
            <a href="{{ route('detail-product', $p->slug) }}" class="hm-bs-c pb-md-3 mb-md-3 d-inline-flex item-scroll mr-2 shadow mb-3" style="width: 300px;">
              <div class="hm-bs-img">
                <img src="{{ config('app.url_media').$p->image_url }}"/>
                {{--<div class="hm-bs-img-wl"><i class="fas fa-heart checked"></i></div>--}}
              </div>
              <div class="hm-bs-bdy w-100 p-2">
                <h5 class="mb-0 text-grey" style="white-space: normal;">{{ $p->title }}</h5>
                <div class="hm-bs-bdy-pr mb-1 fw-500">{{--<strike>Rp 1.000.000</strike>--}}{{ money($p->price) }}</div>
                <div class="hm-bs-bdy-ct mb-1">{{ json_decode($details)->profile_details->city }}</div>
                {{--
                @if(isset($score_star))
                <div class="row">
                  <div class="col-12 col-lg-5">
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
                  <div class="col-12 col-lg-7">
                    <div class="rt-t mb-1 fs-07">({!! $score_star['total'] !!} ulasan)</div>
                  </div>
                </div>                  
                @endif
                <div class="hm-bs-bdy-rt mb-1">
                  <i class="fas fa-star checked"></i>
                  <i class="fas fa-star checked"></i>
                  <i class="fas fa-star checked"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <div class="rt-t mb-1">(9999 ulasan)</div>
                </div>--}}
              </div>
            </a>
        @endforeach
      </div>
      
      <div class="row">
        <div class="col-12 text-center">
          <div class="mr-btn d-inline-block m-3">
            <a href="{{ config('app.url').'product?type=best-sales' }}">See others</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif

  @if(count($whats_new) > 0)
  <section class="hm-fp d-flex align-items-center py-5 wow fadeIn" data-wow-delay=".7s">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-4">
          <h3 class="text-grey"><strong>Whats New Product</strong></h3>
        </div>
      </div>
      <div class="scroll mb-3">
        @foreach($whats_new as $p)
        @php
          $details = DB::table('users_details')->where('user_id', $p->author_id)->where('users_details.details','LIKE','%profile_details%')->first()->details;
          $score_star = get_comments_rating_details( $p->id, 'product' );
        @endphp
        <a href="{{ route('detail-product', $p->slug) }}" class="hm-fp-c mb-3 item-scroll mr-2 shadow white" style="width: 149px;">
          <div class="hm-fp-img">
            <img src="{{ config('app.url_media').$p->image_url }}"/>
            {{--<div class="hm-fp-img-nt">Discount 10%</div>
            <div class="hm-fp-img-wl"><i class="fas fa-heart checked"></i></div>--}}
          </div>
          <div class="hm-fp-bdy w-100 p-2">
            <h5 class="mb-0 text-grey" style="white-space: normal;">{{ $p->title }}</h5>
            <div class="hm-fp-bdy-pr mb-1  fw-500">{{ money($p->price) }}</div>
            <div class="hm-fp-bdy-ct mb-1">{{ json_decode($details)->profile_details->city }}</div>
            {{--
            @if(isset($score_star))
            <div class="row">
              <div class="col-12 col-lg-6">
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
              <div class="col-12 col-lg-6">
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
        </a>
        @endforeach
      </div>
      
      <div class="row">
        <div class="col-12 text-center">
          <div class="mr-btn d-inline-block m-3">
            <a href="{{ config('app.url').'product?type=whats-new' }}">See others</a>
          </div>
        </div>
      </div>
      
    </div>
  </section>
  @endif

  @if(count($products) > 0)
  <section class="hm-bs d-flex align-items-center py-5 wow fadeIn" data-wow-delay=".7s">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-4">
          <h3>
            <strong>
              @if(Session::has('beangasm_frontend_buyer_id') || Cookie::has('p_slg'))
              Products Recomended
              @elseif(!Session::has('beangasm_frontend_buyer_id') || !Cookie::has('p_slg'))
              Products
              @endif
            </strong>
          </h3>
        </div>
      </div>
      
      <div class="row">
        <div class="col-12">
          <div class="row">
            @foreach($products as $key => $p)
              @php
                    $details = DB::table('users_details')->where('user_id', $p->author_id)->where('users_details.details','LIKE','%profile_details%')->first()->details;
                    $score_star = get_comments_rating_details( $p->id, 'product' );
              @endphp
              <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('detail-product', $p->slug) }}" class="hm-fp-c pb-3 mb-3">
                  <div class="hm-fp-img mb-3">
                    <img src="{{ config('app.url_media').$p->image_url }}"/>
                    {{--<div class="hm-fp-img-nt">Discount 10%</div>
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
                </a>
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
      
    </div>
  </section>
  @endif

</main>
<!-- /Main Content -->
@endsection