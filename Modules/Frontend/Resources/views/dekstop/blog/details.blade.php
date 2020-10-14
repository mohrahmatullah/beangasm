@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | Blog | '.$blogs->post_title)
@section('content')
<!-- Main Content -->
<main>
  
  <div class="container">
    <div class="row justify-content-center mb-3 py-3">
      <div class="col-12 col-xl-9">
        <div class="row mb-3">
          <div class="col-12">
            <h1 class="mb-3">{{ $blogs->post_title }}</h1>
            <h6 class="mb-3 text-primary">{{ date('d M, Y', strtotime($blogs->updated_at))  }}</h6>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12">
            <img class="w-100 h-auto of-cover" src="{{ config('app.url_media').$blogs->featured_image }}" />
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12 text-justify post-content">
            {!! string_decode(str_replace('<p>','<p class="mb-3" style="font-size: 1.4rem;">',  $blogs->post_content )) !!}
          </div>
        </div>

      </div>
    </div>
    @if(count($latest_blogs) > 0)
    <div class="row mb-3">
      <div class="col-12 text-center mb-4">
        <h3 class="text-uppercase"><strong>Latest Blog</strong></h3>
      </div>
      @foreach($latest_blogs as $b)
      <div class="col-12 col-xl-4">
        <a href="{{ route('detail-blog', $b->post_slug) }}" class="d-block blg-c pb-3 mb-3">
          <div class="blg-c-img w-100 mb-3">
            <img class="w-100 h-100 of-cover" src="{{ config('app.url_media').$b->featured_image }}" height="275px" />
          </div>
          <div class="blg-c-bdy w-100 mb-3 px-3">
            <h5 class="mb-3 text-grey">{{ $b->post_title }}</h5>
            {{--<h6 class="mb-3">{{ string_decode(\Illuminate\Support\Str::limit($b->post_content ?? '',50,'...')) }}</h6>--}}
            <h6 class="mb-3 text-primary">{{ date('d M, Y', strtotime($b->updated_at))  }}</h6>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @endif
    @if(count($latest_items) > 0)
    <div class="row mb-3">
      <div class="col-12 text-center mb-4">
        <h3 class="text-uppercase"><strong>Latest Items</strong></h3>
      </div>
      @foreach($latest_items as $p)
      @php
            $details = DB::table('users_details')->where('user_id', $p->author_id)->where('users_details.details','LIKE','%profile_details%')->first()->details;
            $score_star = get_comments_rating_details( $p->id, 'product' );
      @endphp
      <div class="col-6 col-md-4 col-lg-3">
        <div class="hm-fp-c pb-3 mb-3" onclick="window.location='{{ route('detail-product', $p->slug) }}';">
          <div class="hm-fp-img mb-3">
            <img src="{{ config('app.url_media').$p->image_url }}" style="width: 100%; height: 100%;" />
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
              <div class="col-6">
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
              <div class="col-6">
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
    @endif
  </div>
</main>
<!-- /Main Content -->
@endsection