<!-- Navbar Header -->
<header>
  <nav id="header" class="header flex-column">
    <div class="container h-100">
      <div class="row h-100" >
        @if((Request::is('product/*')))
        <div class="col-12 h-100 d-flex justify-content-center justify-content-xl-between align-items-center">          
          <div class="d-flex d-xl-none justify-content-between align-items-center w-100">
            <div class="d-inline-flex ">
              <a href="javascript:history.back()"><img src="{{url('assets/frontend/img/back.png')}}" alt="" width="23px" height="23px"></a>
            </div>
            <a href="{{ route('checkout-page') }}" class="nav-link py-2 px-3 h-100 d-flex align-items-center position-relative" id="cart-html">
              <img src="{{url('assets/frontend/img/bag-l.png')}}" width="18" height="18" />
              @if(Cart::count() > 0)
                <div class="third d-inline-flex position-absolute text-white mcart-notif">{!! Cart::count() !!}</div>
              @endif
            </a>
          </div>          
        </div>
        @else
          @if((Request::is('list-store')) || (Request::is('list-store/*')))
          <div class="col-12 h-100 d-flex justify-content-center justify-content-xl-between align-items-center pl-0">
            <h1 class="brand mb-0"><a href="{{ route('/') }}"><img class="w-100 h-auto" src="{{url('assets/frontend/img/logo-v2.png')}}"/></a></h1>
            <form class="d-inline-flex d-xl-none src-g position-relative mr-xl-3" action="{{ route('list-store') }}" method="GET">
              <input name="search" type="search" class="src-inp w-100 suggestion-src-store" placeholder="Search store" value="{{ isset($input['search']) ? $input['search'] : '' }}" />
              <button class="src-img position-absolute" type="submit" id="">
                <img src="{{url('assets/frontend/img/search.png')}}" class="w-100 h-auto" />
              </button>            
            </form>          
          </div>
          <div class="text-center position-absolute w-100" style="top: 47px; background: #fffefe;">
            <div id="search-store-content"></div>
          </div>
          @else
          <div class="col-12 h-100 d-flex justify-content-center justify-content-xl-between align-items-center pl-0">
            <h1 class="brand mb-0"><a href="{{ route('/') }}"><img class="w-100 h-auto" src="{{url('assets/frontend/img/logo-v2.png')}}"/></a></h1>
            <form class="d-inline-flex d-xl-none src-g position-relative mr-xl-3" action="{{ route('search') }}" method="GET">
              <input name="q" type="search" class="src-inp w-100 search-suggestion" placeholder="Search products and store" value="{{ isset($input['q']) ? $input['q'] : '' }}" />
              <button class="src-img position-absolute" type="submit" id="">
                <img src="{{url('assets/frontend/img/search.png')}}" class="w-100 h-auto" />
              </button>            
            </form>          
          </div>
          <div class="text-center position-absolute w-100" style="top: 47px; background: #fffefe;">
            <div id="search-content"></div>
          </div>
          @endif
        @endif
      </div>

      
    </div>
  </nav>

  <div id="header-m" class="" style="display: none;">
    <div class="row">
      <div class="col-12 text-center">
        <ul class="list-unstyled mb-0 nav-menu-m ">
          <li class=""><a href="{{ route('/') }}" class="nav-link py-3 px-3 d-flex align-items-center justify-content-center">Home</a></li>
          <li class=""><a href="{{ route('product') }}" class="nav-link py-3 px-3 d-flex align-items-center justify-content-center">Category</a></li>
          <li class=""><a href="{{ route('blog') }}" class="nav-link py-2 px-3 d-flex align-items-center justify-content-center">Blog</a></li>
          <li class=""><a href="{{ route('contact') }}" class="nav-link py-3 px-3 d-flex align-items-center justify-content-center">Contact</a></li>
        </ul>
      </div>
    </div>

  </div>
</header>
<div class="w-100 space-header"></div>
<!-- /Navbar Header -->
