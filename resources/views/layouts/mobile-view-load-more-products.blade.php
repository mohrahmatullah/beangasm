<div id="list-terkini">
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