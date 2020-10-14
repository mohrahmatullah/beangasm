@extends('frontend::mobile.includes.default')
@section('title', 'Beangasm | Products')
@section('content')
<!-- Main Content -->

<main>

  <section class="hd-lnk-s">
    <div class="container">
    
      <!-- <div class="row ">
        <div class="col-12">
          <nav aria-label="breadcrumb ">
            <ol class="breadcrumb mb-0 white px-0">
              <li class="breadcrumb-item"><a href="#">All</a></li>
              @if(isset($input['category']))
              @php                
              $body = $input['category'];                
              $body = str_replace('-',' ', $body);
              $body = ucwords($body);
              @endphp
              <li class="breadcrumb-item"><a href="#">Kategori</a></li>              
              <li class="breadcrumb-item active" aria-current="page">{{$body}}</li>
              @endif
              @if(isset($input['type']))
              @php                
              $body = $input['type'];                
              $body = str_replace('-',' ', $body);
              $body = ucwords($body);
              @endphp
              <li class="breadcrumb-item"><a href="#">Kategori</a></li>              
              <li class="breadcrumb-item active" aria-current="page">{{$body}}</li>
              @endif
            </ol>
          </nav>
        </div>
      </div> -->
      <div class="row mt-2">
        <div class="col-12 d-flex justify-content-between align-items-center">
          <ul class="list-unstyled mb-0 hd-lnk-m">
            <li class="mr-2"><a href="{{ route('product')}}" class="hd-lnk {{ (request()->segment(1) && !$input) ? 'actived' : '' }}">All</a></li>
            @if(count($product_category) > 0)
              @foreach($product_category as $c)
              <li class="mr-2"><a href="{{ config('app.url').'product?category='.$c->slug }}" class="hd-lnk @if(isset($input['category'])) {{ ($c->slug == $input['category']) ? 'actived' : '' }} @endif">{{ $c->name }}</a></li>
              @endforeach
            @endif
          </ul>
        </div>
      </div>

      {{--<div class="row">
        <div class="col-12">
          <ul class="list-unstyled mb-0 w-100">
            <!-- <li class="float-left mr-2 mb-3"><a href="" class="hd-lnk lnk-filter active">Filter</a></li> -->
            <li class="float-left mr-2 w-100">
              <!-- <a href="" class="hd-lnk lnk-sort ">Urutkan</a> -->
              @if( (!(isset($input['type']))) )
              <div class="sort-width">
                <select class="wide lnk-sort sort-by-filter">
                  <option value="all" data-display="Sort">Sort</option>
                  <option value="terbaru" {{ (isset($input['sort']) && $input['sort'] == 'terbaru') ? 'selected' : '' }}>Latest</option>
                  <option value="termurah" {{ (isset($input['sort']) && $input['sort'] == 'termurah') ? 'selected' : '' }}>Cheapest</option>
                  <option value="termahal" {{ (isset($input['sort']) && $input['sort'] == 'termahal') ? 'selected' : '' }}>Most expensive</option>
                </select>
              </div>
              @endif
            </li>
          </ul> 
        </div>
      </div>--}}
    </div>
  </section>
  @if(count($products) > 0)
  <section class="prd-ls-s d-flex align-items-center pt-3 pb-5 wow fadeIn" data-wow-delay=".7s">
    <div class="container">
      <div class="row">
        {{--<div class="col-12">

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
              
                  <div id="accordFltBdy" class="collapse" aria-labelledby="accordFltHead" data-parent="#accordFlt">
                    <div class="card-body accord">
                      <div class="row mb-2">
                        <form class="col-12" action="{{ route('product') }}" method="GET">
                          <label>Price Range</label>
                          @if(isset($input['category']))
                          <input type="hidden" name="category" value="{{ $input['category'] }}" />
                          @endif
                          @if(isset($input['type']))
                          <input type="hidden" name="type" value="{{ $input['type'] }}" />
                          @endif
                          <input type="text" name="price_min" class="form-control mb-2" placeholder="Price Min" value="{{ isset($input['price_min']) ? $input['price_min'] : '' }}" required />
                          <input type="text" name="price_max" class="form-control mb-2" placeholder="Price Max" value="{{ isset($input['price_max']) ? $input['price_max'] : '' }}" required />
                          <input type="submit" class="btn primary text-white d-block w-100" value="Cari">
                        </form>
                      </div>
                      <!-- <div class="row">
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
                      </div> -->
                    </div>
                  </div>

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
              <div class="hm-fp-c-m mb-3" onclick="window.location='{{ route('detail-product', $p->slug) }}';">
                <div class="hm-fp-img mb-3">
                  <img src="{{ config('app.url_media').$p->image_url }}" style="width: 100%; height: 100%;" />
                  {{---<div class="hm-fp-img-nt">Discount 10%</div>
                  <div class="hm-fp-img-wl"><i class="fas fa-heart checked"></i></div>--}}
                </div>
                <div class="hm-fp-bdy w-100 mb-3">
                  <h5 class="mb-0 text-grey">{{ $p->title }}</h5>
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
    </div>
  </section>
  @endif

</main>
<!-- /Main Content -->
@endsection
