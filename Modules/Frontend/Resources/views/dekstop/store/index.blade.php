@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | Store')
@section('content')
<!-- Main Content -->
<main>
  <header class="cv-s">
    <img class="of-cover" src="{{url('assets/frontend/img/banner.png')}}"/>
  </header>

  <section class="hd-lnk-s py-3">
    <div class="container">
      <div class="row mb-3">
        <div class="col-12">
          <nav aria-label="breadcrumb ">
            <ol class="breadcrumb mb-0 white px-0">
              <li class="breadcrumb-item"><a href="{{ route('list-store') }}">All</a></li>
              <li class="breadcrumb-item active" aria-current="page">Store</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <!-- <div class="col-12 col-lg-6">
          <select class="wide lnk-sort sort-by-filter">
            <option value="all" data-display="Urutkan">Urutkan</option>
            <option value="terbaru">Terbaru</option>
            <option value="termurah">A - Z</option>
            <option value="termahal">Z - A</option>
          </select>
        </div> -->
        <div class="col-12 col-lg-6 offset-lg-6">
          <form class="src-g d-none d-xl-block position-relative mr-xl-3" action="{{ route('list-store') }}" method="GET">
            <input name="search" type="search" class="src-inp w-100 suggestion-src-store" placeholder="Search store" value="{{ isset($input['search']) ? $input['search'] : '' }}"/>
            <button class="src-img position-absolute" type="submit">
              <img src="{{url('assets/frontend/img/search.png')}}" class="w-100 h-auto" />
            </button>
            <div class="position-absolute w-100" style="top: 50px; background: #fffefe;">
              <div id="search-store-content" class="text-center"></div>
            </div>
          </form>
        </div>
      </div>
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
            @else
            <div class="col-lg-6 offset-lg-4">
              <h5><b>Oops, toko nggak ditemukan</b></h5>
            </div>
            @endif
          </div>
        </div>
      </div>
      <!-- Pagination -->
      @php $paginator = $store; @endphp
      {{ $paginator->appends([])->render('layouts.pagination') }}
      <!-- /Pagination -->
    </div>
  </section>

</main>
<!-- /Main Content -->
@endsection