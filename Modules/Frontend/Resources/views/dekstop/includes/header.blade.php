<!-- Navbar Header -->
<header>
  <nav id="header" class="header flex-column">
    <div class="container h-100">
      <div class="row h-100" >
        <div class="col-12 h-100 d-flex justify-content-center justify-content-xl-between align-items-center">
          <h1 class="brand d-none d-xl-inline-flex align-items-center h-100 mb-0"><a href="{{ route('/') }}" class="d-inline-flex"><img class="w-100 h-auto" src="{{url('assets/frontend/img/Logo-Beangasm-Landscape.png')}}"/></a></h1>
          <div class="src-m d-none d-md-none align-items-center"><img class="w-100 h-auto" src="{{url('assets/frontend/img/search.png')}}"/></div>
          
          <div class="ml-auto d-none d-xl-inline-flex justify-content-between align-items-center nav-header h-100 ">
            <!-- @if(count($product_category) > 0)
            <ul class="list-unstyled float-left mb-0 nav-menu h-100 d-none d-xl-flex">
              @foreach($product_category as $p)
              <li class="float-left h-100 position-relative"><a href="{{ config('app.url').'product?category='.$p->slug }}" class="nav-link py-2 pr-3 pl-0 h-100 d-flex align-items-center"><h6 class="mb-0">{{ $p->name }}</h6></a></li>
              @endforeach
            </ul>
            @endif -->
            <ul class="list-unstyled float-left mb-0 nav-menu h-100 d-none d-xl-flex">
              <!-- <li class="float-left h-100 position-relative">
                <a href="{{ route('product') }}" class="nav-link py-2 pr-3 pl-0 h-100 d-flex align-items-center"><h6 class="mb-0">Kategori</h6></a>
                <ul class="list-unstyled position-absolute white p-3" style="border: 1px solid #ccc;box-shadow: 0 0 5px 0 #ccc;width: 170px;top: 55px;border-radius: 2px;">
                  <li class="mb-2"><a href=""><h6 class="mb-0">Roasted Beans</h6></a></li>
                  <li class="mb-2"><a href=""><h6 class="mb-0">Green Beans</h6></a></li>
                  <li class="mb-2"><a href=""><h6 class="mb-0">Coffee Tools</h6></a></li>
                </ul>
              </li> -->
              <li class="float-left h-100"><a href="{{ route('product') }}" class="nav-link py-2 pr-3 pl-0 h-100 d-flex align-items-center"><h6 class="mb-0">Category</h6></a></li>
              <li class="float-left h-100"><a href="{{ route('list-store') }}" class="nav-link py-2 pr-3 pl-0 h-100 d-flex align-items-center"><h6 class="mb-0">Store</h6></a></li>
            </ul>

            <form class="src-g d-none d-xl-block position-relative mr-xl-3" action="{{ route('search') }}" method="GET">
              <input name="q" type="search" class="src-inp w-100 search-suggestion" placeholder="Search products and store" value="{{ isset($input['q']) ? $input['q'] : '' }}"/>
              <button class="src-img position-absolute" type="submit">
                <img src="{{url('assets/frontend/img/search.png')}}" class="w-100 h-auto" />
              </button>
              
              <div class="position-absolute w-100" style="top: 50px; background: #fffefe;">
                <div id="search-content" class="text-center"></div>
              </div>
            </form>
            
            <ul class="list-unstyled float-left mb-0 nav-menu h-100 d-none d-xl-flex align-items-center">
              <li class="float-left h-100 d-flex align-items-center">
                <div class="mr-3" style="background-color: rgba(0,0,0,.2);width: 1px;height: 40px;"></div>
              </li>
              @if(Session::has('beangasm_frontend_buyer_id'))
              @php
                $after_login = DB::table('users')->where('id', Session::get('beangasm_frontend_buyer_id'))->first();
              @endphp
              <li class="float-left h-100 d-flex align-items-center">
                <a href="{{ route('buyer-dashboard') }}" class="nav-link py-2 pr-3 pl-0 h-100 d-flex align-items-center account-head-sec"><img class="h-auto mr-2" src="{{url('assets/frontend/img/ic_account_circle_24px.png')}}"/><h6 class="mb-0" style="font-size: .9rem;">{{ $after_login->name }}</h6></a>
              </li>
              @else
              <li class="float-left h-100 d-flex align-items-center">
                <a href="#" class="nav-link py-2 pr-3 pl-0 h-100 d-flex align-items-center" data-toggle="modal" data-target="#people-pop-up-register"><h6 class="mb-0">Register</h6></a>
              </li>
              <li class="float-left h-100 d-flex align-items-center">
                <a href="#" class="nav-link py-2 pr-3 pl-0 h-100 d-flex align-items-center" data-toggle="modal" data-target="#people-pop-up-login"><h6 class="mb-0">Login</h6></a>
              </li>
              @endif
              <div class="mini-cart-content">
                @include('frontend::dekstop.checkout.cart.mini-cart-html')
              </div>
            </ul>
          </div>
        </div>
      </div>
      
    </div>

    <!-- <div class="w-100" style="height: 1px;background: rgba(0,0,0,.2);">

    </div> -->

    <!-- <div class="container h-100">
      <div class="row py-1">
        <div class="col-12 h-100 d-flex justify-content-between align-items-center">
          <div class="d-none d-md-inline-flex align-items-center nav-header h-100 ">
            <ul class="list-unstyled float-left mb-0 nav-menu h-100">
              
            </ul>
          </div>
        </div>
      </div>
    </div> -->
  </nav>

  <!-- <div id="header-m" class="" style="display: none;">
    <div class="row">
      <div class="col-12 text-center">
        <ul class="list-unstyled mb-0 nav-menu-m ">
          <li class=""><a href="{{ route('/') }}" class="nav-link py-3 px-3 d-flex align-items-center justify-content-center">Home</a></li>
          <li class=""><a href="{{ route('product') }}" class="nav-link py-3 px-3 d-flex align-items-center justify-content-center">Kategori</a></li>
          <li class=""><a href="{{ route('blog') }}" class="nav-link py-2 px-3 d-flex align-items-center justify-content-center">Blog</a></li>
          <li class=""><a href="{{ route('contact') }}" class="nav-link py-3 px-3 d-flex align-items-center justify-content-center">Contact</a></li>
        </ul>
      </div>
    </div>

  </div> -->
</header>
<div class="w-100 space-header"></div>
<!-- /Navbar Header -->

<!-- Pop Up People Login -->
<div class="modal" id="people-pop-up-login" tabindex="-1" role="dialog" aria-labelledby="people-pop-up-login" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content w-75">
      <!-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <form class="modal-body" method="POST" action="{{ route('post-buyer-login') }}">
        <a href="{{ route('/') }}" class="d-block text-center mb-2"><img class="text-center" src="{{url('assets/frontend/img/logo-v2.png')}}" width="100px" height="100px" /></a>
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <small>Masukan username atau email</small>
        <input type="text" name="login_username" class="form-control mb-0" />
        <small>Masukan password</small>
        <input type="password" name="login_password" class="form-control mb-2" />
        <input type="submit" class="btn primary text-white d-block w-100" value="Sign In">
      </form>
      <div class="modal-footer">
        <small>Belum punya akun beangasm ? <a href="{{ route('buyer-register') }}" class="text-primary">daftar disini</a></small>
      </div>
    </div>
  </div>
</div>

<!-- Pop Up People Register -->
<div class="modal" id="people-pop-up-register" tabindex="-1" role="dialog" aria-labelledby="people-pop-up-register" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content w-75">
      <!-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <form class="modal-body" method="POST" action="">
        <a href="{{ route('/') }}" class="d-block text-center mb-2"><img class="text-center" src="{{url('assets/frontend/img/logo-v2.png')}}" width="100px" height="100px" /></a>
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <small>Display Name</small>
        <input type="text" name="register_name" class="form-control mb-0" />
        <small>Username</small>
        <input type="text" name="register_username" class="form-control mb-0" />
        <small>Email</small>
        <input type="text" name="register_email" class="form-control mb-0" />
        <small>Password</small>
        <input type="password" name="register_password" class="form-control mb-0" />
        <small>Confirm Password</small>
        <input type="password" name="register_confirm_password" class="form-control mb-2" />
        <input type="submit" class="btn primary text-white d-block w-100" value="Sign Up">
      </form>
      <div class="modal-footer">
        <small>Sudah punya akun beangasm ? <a href="{{ route('buyer-register') }}" class="text-primary">login disini</a></small>
      </div>
    </div>
  </div>
</div>