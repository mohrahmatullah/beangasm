@extends('frontend::mobile.includes.default')
@section('title', 'Beangasm | Store')
@section('content')
<!-- Main Content -->
<main>
  <section class="hd-lnk-s py-3">
    <div class="container">
      <!-- <div class="row">
        <div class="col-12 d-flex justify-content-between">
          <ul class="list-unstyled mb-0 d-none d-lg-block">
            <li class="float-left mr-2 mb-3"><a href="" class="hd-lnk lnk-filter active">Filter</a></li>
            <li class="float-left mr-2 mb-3"><a href="" class="hd-lnk lnk-sort ">Urutkan</a></li>
          </ul>
          <ul class="list-unstyled mb-0 hd-lnk-m">
            <li class="mr-2"><a href="" class="hd-lnk actived">All</a></li>
            <li class="mr-2"><a href="" class="hd-lnk">Roasted Beans</a></li>
            <li class="mr-2"><a href="" class="hd-lnk">Green Beans</a></li>
            <li class="mr-2"><a href="detailOrder.html" class="hd-lnk">Coffee Tools</a></li>
          </ul>
        </div>
      </div> -->
    </div>
  </section>
  <!-- #DESKTOP# -->
  <section class="d-flex d-none store-ls-s d-flex align-items-center pt-3 pb-5 wow fadeIn" data-wow-delay=".7s">
    <div class="container">
      <div class="row">
        <div class="col-12">
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
            @endif
          </div>
        </div>
      </div>
      <div id="list-terkini-ajax">
        <div class="row">
          <div class="col-12 text-center">
            <div class="mr-btn d-inline-block m-3" id="load-more">
              <!-- Pagination -->
              @php $paginator = $store; @endphp
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