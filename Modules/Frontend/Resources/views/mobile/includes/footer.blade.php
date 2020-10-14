<div class="space-header d-xl-none"></div>
@if((Request::is('product/*')))
<section class="dt-bot-nav d-lg-none">
  <div class="container">
    <div class="row">
      <div class="col-6 pr-1">
        <a href="#" data-id="{{ $single_product_details['id'] }}" class="d-inline-flex align-items-center justify-content-center lnk-solid add-to-cart-bg add-to-checkout">Checkout</a>
      </div>
      <div class="col-6 pl-1">
        <a href="#" data-id="{{ $single_product_details['id'] }}" class="d-inline-flex align-items-center justify-content-center lnk-reg add-to-cart-bg"><img class="of-cover" src="{{url('assets/frontend/img/cart.png')}}" /> Add to cart</a>
      </div>
    </div>
  </div>
</section>
@elseif((Request::is('product')) || Request::capture()->except('page') || (Request::is('list-store/*')))
<section class="dt-bot-nav d-lg-none" id="sort-filter" style="display: none;">
  <div class="container">
    <div class="row">
      @if((Request::is('list-store/*')))
      <div class="col-12">
        <a href="#" class="d-inline-flex align-items-center justify-content-center lnk-reg" data-toggle="modal" data-target="#pop-up-sort-by-product">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-filter" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
          </svg>
          &nbsp;&nbsp;Sort
        </a>
      </div>
      @elseif(isset($input['type']) && $input['type'])
      <div class="col-12">
        <a href="#" class="d-inline-flex align-items-center justify-content-center lnk-reg" data-toggle="modal" data-target="#pop-up-filter-product">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-funnel-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
          </svg>
          &nbsp;&nbsp;Filter
        </a>
      </div>
      @else
        <div class="col-6 pr-1">
          <a href="#" class="d-inline-flex align-items-center justify-content-center lnk-reg" data-toggle="modal" data-target="#pop-up-sort-by-product">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-filter" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
            </svg>
            &nbsp;&nbsp;Sort
          </a>
        </div>
        <div class="col-6 pl-1">
          <a href="#" class="d-inline-flex align-items-center justify-content-center lnk-reg" data-toggle="modal" data-target="#pop-up-filter-product">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-funnel-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
            </svg>
            &nbsp;&nbsp;Filter
          </a>
        </div>
      @endif
    </div>
  </div>
</section>
<div class="modal" id="pop-up-sort-by-product" tabindex="-1" role="dialog" aria-labelledby="pop-up-sort-by-product" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content w-100" style="height: 100vh; left: 0; position: fixed; top: 0; border: 0; border-radius: 0; overflow: hidden;">
      <div class="modal-header">
        <span>SORT BY</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center sort-by-filter-mobile" data-val_sort="terbaru">
          Latest
          @if(isset($input['sort']) && $input['sort'] == 'terbaru') <span class="fa fa-check"></span> @endif
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center sort-by-filter-mobile" data-val_sort="termurah">
          Cheapest
          @if(isset($input['sort']) && $input['sort'] == 'termurah') <span class="fa fa-check"></span> @endif
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center sort-by-filter-mobile" data-val_sort="termahal">
          Most expensive
          @if(isset($input['sort']) && $input['sort'] == 'termahal') <span class="fa fa-check"></span> @endif
        </li>
      </ul>
      <div class="card-body accord"> 
      </div>
    </div>
  </div>
</div>
<div class="modal" id="pop-up-filter-product" tabindex="-1" role="dialog" aria-labelledby="pop-up-filter-product" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content w-100" style="height: 100vh; left: 0; position: fixed; top: 0; border: 0; border-radius: 0; overflow: hidden;">
      <div class="modal-header">
        <span>FILTER</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body accord">
        <div class="row mb-2">
          @if(isset($input['q']) && $input['q'])
          <form class="col-12" action="{{ route('search') }}" method="GET">
            <label>Price Range</label>
            @if(isset($input['q']))
            <input type="hidden" name="q" value="{{ $input['q'] }}" />
            @endif
            <input type="text" name="price_min" class="form-control mb-2" placeholder="Price Min" value="{{ isset($input['price_min']) ? $input['price_min'] : '' }}" required />
            <input type="text" name="price_max" class="form-control mb-2" placeholder="Price Max" value="{{ isset($input['price_max']) ? $input['price_max'] : '' }}" required />
            <input type="submit" class="btn primary text-white d-block w-100" value="Search">
          </form>
          @else
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
            <input type="submit" class="btn primary text-white d-block w-100" value="Search">
          </form>
          @endif
        </div>
        <div class="row mb-5 text-center">
          @if(isset($sub_cat) && count($sub_cat) > 0)
          <div class="col-12 d-flex justify-content-between align-items-center">
            <ul class="list-unstyled mb-0 hd-lnk-m">
                @foreach($sub_cat as $sc)
                <li class="mr-2"><a href="#" class="btn btn-outline-warning sort-by-sub-cat-mobile" data-val_sort="{{ $sc->term_id }}">{{ $sc->name }}</a></li>
                @endforeach
            </ul>
          </div>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Nav Menu -->
<nav class="nav-menu nav-menu-m d-xl-none" id="nav-menu">
  <div class="row mx-0 h-100 align-items-center">
    <div class="col px-0 text-center">
      @if(Request::is('/'))
      <a href="{{ route('/') }}" class="menu-link menu-link-m active">
        <!-- <svg>
          <use xlink:href="#home" />
        </svg> -->
        <!-- <img width="25" height="25" src="{{url('assets/frontend/img/home.svg')}}" class="mb-1" /> -->
        <span class="nav-m nav-home"></span>
        <div class="fw-500">Home</div>
      </a>
      @else
      <a href="{{ route('/') }}" class="menu-link menu-link-m">
        <span class="nav-m nav-home"></span>
        <div class="fw-500">Home</div>
      </a>
      @endif
    </div>
    <div class="col px-0 text-center">
      @if(url()->full() == config('app.url').'product?type=whats-new')
      <a href="{{ config('app.url').'product?type=whats-new' }}" class="menu-link menu-link-m active">
        <span class="nav-m nav-new"></span>
        <div class="fw-500">What's New</div>
      </a>
      @else
      <a href="{{ config('app.url').'product?type=whats-new' }}" class="menu-link menu-link-m">
        <span class="nav-m nav-new"></span>
        <div class="fw-500">What's New</div>
      </a>
      @endif
    </div>
    <div class="col px-0 text-center">
      @if(Request::is('list-store') || Request::is('list-store/*'))
      <a href="{{ route('list-store') }}" class="menu-link menu-link-m active">
        <span class="nav-m nav-store"></span>
        <div class="fw-500">Store</div>
      </a>
      @else
      <a href="{{ route('list-store') }}" class="menu-link menu-link-m">
        <span class="nav-m nav-store"></span>
        <div class="fw-500">Store</div>
      </a>
      @endif
    </div>
    <div class="col px-0 text-center">
      @if(Request::is('checkout'))
      <a href="{{ route('checkout-page') }}" class="menu-link menu-link-m active">
        <span class="nav-m nav-cart"></span>
        <div class="fw-500">Cart</div>
      </a>
      @else      
      <a href="{{ route('checkout-page') }}" class="menu-link menu-link-m">
        <span class="nav-m nav-cart"></span>
        <div class="fw-500">Cart</div>
        @if(Cart::count() > 0)
          <div class="third d-inline-flex position-absolute text-white mcart-notif">{!! Cart::count() !!}</div>
        @endif
      </a>
      @endif
    </div>
    <div class="col px-0 text-center">
      @if(Request::is('login'))
      <a href="{{ route('login-user') }}" class="menu-link menu-link-m active">
        <span class="nav-m nav-user"></span>
        <div class="fw-500">login</div>
      </a>
      @else
      <a href="{{ route('login-user') }}" class="menu-link menu-link-m">
        <span class="nav-m nav-user"></span>
        <div class="fw-500">login</div>
      </a>
      @endif
    </div>
  </div>
</nav>
<!-- Nav Menu -->
@else
<!-- Nav Menu -->
<nav class="nav-menu nav-menu-m d-xl-none">
  <div class="row mx-0 h-100 align-items-center">
    <div class="col px-0 text-center">
      @if(Request::is('/'))
      <a href="{{ route('/') }}" class="menu-link menu-link-m active">
        <!-- <svg>
          <use xlink:href="#home" />
        </svg> -->
        <!-- <img width="25" height="25" src="{{url('assets/frontend/img/home.svg')}}" class="mb-1" /> -->
        <span class="nav-m nav-home"></span>
        <div class="fw-500">Home</div>
      </a>
      @else
      <a href="{{ route('/') }}" class="menu-link menu-link-m">
        <span class="nav-m nav-home"></span>
        <div class="fw-500">Home</div>
      </a>
      @endif
    </div>
    <div class="col px-0 text-center">
      @if(url()->full() == config('app.url').'product?type=whats-new')
      <a href="{{ config('app.url').'product?type=whats-new' }}" class="menu-link menu-link-m active">
        <span class="nav-m nav-new"></span>
        <div class="fw-500">What's New</div>
      </a>
      @else
      <a href="{{ config('app.url').'product?type=whats-new' }}" class="menu-link menu-link-m">
        <span class="nav-m nav-new"></span>
        <div class="fw-500">What's New</div>
      </a>
      @endif
    </div>
    <div class="col px-0 text-center">
      @if(Request::is('list-store') || Request::is('list-store/*'))
      <a href="{{ route('list-store') }}" class="menu-link menu-link-m active">
        <span class="nav-m nav-store"></span>
        <div class="fw-500">Store</div>
      </a>
      @else
      <a href="{{ route('list-store') }}" class="menu-link menu-link-m">
        <span class="nav-m nav-store"></span>
        <div class="fw-500">Store</div>
      </a>
      @endif
    </div>
    <div class="col px-0 text-center">
      @if(Request::is('checkout'))
      <a href="{{ route('checkout-page') }}" class="menu-link menu-link-m active">
        <span class="nav-m nav-cart"></span>
        <div class="fw-500">Cart</div>
      </a>
      @else      
      <a href="{{ route('checkout-page') }}" class="menu-link menu-link-m">
        <span class="nav-m nav-cart"></span>
        <div class="fw-500">Cart</div>
        @if(Cart::count() > 0)
          <div class="third d-inline-flex position-absolute text-white mcart-notif">{!! Cart::count() !!}</div>
        @endif
      </a>
      @endif
    </div>
    <div class="col px-0 text-center">
      @if(Request::is('login'))
      <a href="{{ route('login-user') }}" class="menu-link menu-link-m active">
        <span class="nav-m nav-user"></span>
        <div class="fw-500">login</div>
      </a>
      @else
      <a href="{{ route('login-user') }}" class="menu-link menu-link-m">
        <span class="nav-m nav-user"></span>
        <div class="fw-500">login</div>
      </a>
      @endif
    </div>
  </div>
</nav>
<!-- Nav Menu -->
@endif