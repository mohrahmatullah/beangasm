@extends('frontend::dekstop.includes.default')
@section('title', 'Beangasm | Blog')
@section('content')
<!-- Main Content -->
<main>
 
  <div class="container">
    <div class="row">
      @if(count($blogs) > 0)
      <div class="col-12 py-5">
        <div class="row">
          @foreach($blogs as $b)
          <div class="col-12 col-xl-4">
            <a href="{{ route('detail-blog', $b->post_slug) }}" class="d-block blg-c pb-3 mb-4">
              <div class="blg-c-img w-100 mb-3">
                <img class="w-100 of-cover" src="{{ config('app.url_media').$b->featured_image }}" height="275px" />
              </div>
              <div class="blg-c-bdy w-100 mb-3 px-3">
                <h5 class="mb-3">{{ $b->post_title }}</h5>
                {{--<h6 class="mb-3">{!! string_decode(\Illuminate\Support\Str::limit($b->post_content ?? '',50,'...')) !!}</h6>--}}
                <h6 class="mb-3 text-primary">{{ date('d M, Y', strtotime($b->updated_at))  }}</h6>
              </div>
            </a>
          </div>
          @endforeach
        </div>

        <!-- Pagination -->
        @php $paginator = $blogs; @endphp
        {{ $paginator->appends([])->render('layouts.pagination') }}
        <!-- /Pagination -->
      </div>
      @endif
    </div>
  </div>
</main>
<!-- /Main Content -->
@endsection
