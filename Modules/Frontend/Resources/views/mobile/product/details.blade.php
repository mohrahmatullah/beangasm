@extends('frontend::mobile.includes.default')
@section('title', 'Beangasm | '.$single_product_details['post_title'])
@section('content')
<section class="dt-inf">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-6 d-flex position-relative flex-column">

        <div class="prd-c position-relative">
          <div class="item"><img class="c-img of-cover" src="{{ config('app.url_media').$single_product_details['_product_related_images_url']->product_image }}"/></div>
          
        </div>

        @if(!empty($single_product_details['_product_related_images_url']->product_gallery_images))
        <div class="prd-g2 owl-carousel owl-theme position-relative">
          @foreach($single_product_details['_product_related_images_url']->product_gallery_images as $row)
          <div class="item">
            <a href="{{ config('app.url_media').$row->url }}" data-fancybox="gallery">
              <img class="g2-img of-cover" src="{{ config('app.url_media').$row->url }}"/>
            </a>
          </div>
          @endforeach
        </div>
        @endif

      </div>
      <div class="col-12 col-lg-6 p-3">
        <h4 class="mb-2">{{ $single_product_details['post_title'] }}</h4>
        
        <div class="inf-rt mb-2">            
          <div class="d-flex">
            <div class="score mr-2">
              <div class="score-wrap">
                <span class="stars-active" style="width: {{ $comments_rating_details['percentage'] }}%">
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
            <div class="rt-t mb-1 mr-2">({!! $comments_rating_details['total'] !!} ulasan)</div>
            <a href="#" class="rt-lnk mb-1">Tulis review</a>
          </div>                       
          
        </div>
        
        <div class="inf-pr mb-3">
          {{ money($single_product_details['post_price']) }}
        </div>
        <div class="inf-lnk d-flex align-items-center">
          <ul class="list-unstyled lnk-stok d-inline-flex mb-3">
            <li class="stok-itm">
              <a class="btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                <img class="of-cover" src="{{url('assets/frontend/img/-.png')}}"  />
              </a>
            </li>
            <li class="stok-itm">
              <input readonly type="text" id="quantity" name="quant[1]" value="1" min="1" max="@if(isset($product_stock_qty) && $product_stock_qty != "0" && $product_stock_availability == "in_stock") {{$product_stock_qty}} @else 10 @endif" />
            </li>
            <li class="stok-itm">
              <a class="btn-number" data-type="plus" data-field="quant[1]">
                <img class="of-cover" src="{{url('assets/frontend/img/+.png')}}"  />
              </a>
            </li>
          </ul>

          <a href="" class="d-inline-flex d-lg-none align-items-center lnk-reg mb-3"><i class="fas fa-heart mr-2"></i> Add to wishlist</a>
        </div>
        <div class="inf-desc mb-4">
          @if(isset($product_stock_qty) && $product_stock_qty > 0 && $product_stock_availability == "in_stock")
            Remaining Stock &nbsp; : &nbsp; {{ $product_stock_qty }}<br />
          @endif
          Weight &nbsp; : &nbsp; {{ $single_product_details['post_weight'] < 1000 ? $single_product_details['post_weight'].' Gr' : ($single_product_details['post_weight']/1000).' Kg' }} <br />
          Category &nbsp; : &nbsp; {{ $category_by_item }} <br />           
        </div>
        <div class="inf-sh">
          <h6 class="text-uppercase mb-2">Share</h6>
          <ul class="list-unstyled inf-soc-mn">
            <li class="soc-itm"><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('detail-product', $single_product_details['post_slug']) }}?utm_source=facebook&utm_medium=share&utm_campaign=social_media_beangasm" class="soc-lnk fb">Facebook</a></li>
            <li class="soc-itm"><a href="https://wa.me/?text={{ route('detail-product', $single_product_details['post_slug']) }}?utm_source=whatsapp&utm_medium=share&utm_campaign=social_media_beangasm" class="soc-lnk wa">WhatsApp</a></li>
            <li class="soc-itm"><a href="" class="soc-lnk ig">Instagram</a></li>
            <li class="soc-itm"><a href="https://twitter.com/intent/tweet?text={{ route('detail-product', $single_product_details['post_title']) }}&url={{ route('detail-product', $single_product_details['post_slug']) }}" class="soc-lnk tw">Twitter</a></li>
          </ul>
        </div>
        
      </div>
    </div>
  </div>
</section>

<section class="dt-dsc">
  <div class="container">

    <!-- Store Mobile -->
    <div class="row ">
      <div class="col-12">
        @php
          $details = DB::table('users_details')->where('user_id', $single_product_details['author_id'])->where('users_details.details','LIKE','%profile_details%')->first()->details;
          $store = DB::table('users')
                    ->select('users.id','users.display_name','users.name')
                    ->where('users.id', $single_product_details['author_id'] )
                    ->first();
        @endphp
        <a class="hm-fp-c mb-4 s d-flex align-items-center" href="{{ route('detail-list-store', $store->name) }}">
          <div class="hm-fp-img p-3 p-xl-5 d-inline-flex align-items-center">
            <img src="{{ config('app.url_media').json_decode($details)->general_details->cover_img }}" class="img-circle " style="width: 100px;height: 100px;" />
          </div>
          <div class="hm-fp-bdy w-100 px-3">
            <h5 class="mb-2 " style="min-height: 50px;max-height: 50px;">{{ json_decode($details)->profile_details->store_name }}</h5>
            <div class="hm-fp-bdy-ct mb-1 text-primary">{{ json_decode($details)->profile_details->city }}</div>
          </div>
        </a>
      </div>
    </div>

    <!-- Deskripsi Mobile -->
    <div class="row ">
      <div class="col-12">
        <div class="accordion mb-3" id="accordDesc">
          <div class="card accord">

            <div class="card-header accord" id="accordDescHead">
              <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#accordDescBdy" aria-expanded="true" aria-controls="collapseOne">
                  Product Description
                  <img class="arrow-desc-accord of-cover" src="{{url('assets/frontend/img/arrow-r-b.svg')}}" />
                </button>
              </h2>
            </div>
        
            <div id="accordDescBdy" class="collapse" aria-labelledby="accordDescHead" data-parent="#accordDesc">
              <div class="card-body accord">
                {!! string_decode($single_product_details['post_content']) !!}
              </div>
            </div>

          </div>
        </div>
        {{--
        <div class="accordion" id="accordReview">
          <div class="card accord">

            <div class="card-header accord" id="accordReviewHead">
              <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#accordReviewBdy" aria-expanded="true" aria-controls="collapseOne">
                  Review
                  <img class="arrow-review-accord of-cover" src="{{url('assets/frontend/img/arrow-r-b.svg')}}" />
                </button>
              </h2>
            </div>
        
            <div id="accordReviewBdy" class="collapse" aria-labelledby="accordReviewHead" data-parent="#accordReview">
              <div class="card-body accord">
                Review
              </div>
            </div>

          </div>
        </div>
        --}}
      </div>
    </div>
  </div>
</section>

<section class="dt-fp d-flex align-items-center py-5 wow fadeIn" data-wow-delay=".7s">
  @if(count($related_items) > 0)
  <div class="container">
    <div class="row">
      <div class="col-12 mb-4">
        <h4><strong>Related Product</strong></h4>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="row">
          @foreach($related_items as $p)
          @php
                $details = DB::table('users_details')->where('user_id', $p->author_id)->where('users_details.details','LIKE','%profile_details%')->first()->details;
                $score_star = get_comments_rating_details( $p->id, 'product' );
          @endphp
          <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('detail-product', $p->slug) }}" class="hm-fp-c pb-3 mb-3 text-grey">
              <div class="hm-fp-img mb-3">
                <img src="{{ config('app.url_media').$p->image_url }}"/>
                <!-- <div class="hm-fp-img-nt">Discount 10%</div> -->
                <!-- <div class="hm-fp-img-wl"><i class="fas fa-heart checked"></i></div> -->
              </div>
              <div class="hm-fp-bdy w-100 mb-3">
                <h5 class="mb-2">{{ $p->title }}</h5>
                <div class="hm-fp-bdy-pr mb-1">{{ money($p->price) }}</div>
                <div class="hm-fp-bdy-ct mb-1">{{ json_decode($details)->profile_details->city }}</div>
                <!-- <div class="d-flex flex-column">
                  <div class="score mr-1">
                    <div class="score-wrap">
                      <span class="stars-active">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                      </span>
                    </div>
                  </div>
                  <div class="rt-t mb-1">(12 ulasan)</div>
                </div> -->
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    
  </div>
  @endif
</section>
@endsection