<!-- Footer -->
<footer class="py-3 d-none d-xl-flex">
  <div class="container">

    <div class="row py-5">
      <div class="col-12 col-lg-4"> 
        <div class="brand-fot d-inline-block mb-lg-3"><img class="w-100 h-auto" src="{{url('assets/frontend/img/logo-v2w.png')}}"/></div>
        <p class="foot-desc">BEANGASM is a digital marketplace for anything coffee, also retailing coffees from roastery around the world. </p>            
      </div>
      <div class="col-12 col-lg-4">
        <h5 class="mb-lg-3 text-white"><strong>Beangasm</strong></h5>
        <ul class="list-unstyled mb-0 foot-menu">
          <li class=""><a href="{{ route('about') }}" class="foot-link mb-1 h-100 d-flex align-items-center">About</a></li>
          <li class=""><a href="{{ route('blog') }}" class="foot-link mb-1 h-100 d-flex align-items-center">Blog</a></li>
          <li class=""><a href="{{ route('contact') }}" class="foot-link mb-1 h-100 d-flex align-items-center">Contact</a></li>
          <li class=""><a href="#" class="foot-link mb-1 h-100 d-flex align-items-center">Policy And Privacy</a></li>
          <li class=""><a href="#" class="foot-link mb-1 h-100 d-flex align-items-center">Terms And Condition</a></li>
          <li class=""><a href="#" class="foot-link mb-1 h-100 d-flex align-items-center">Sitemap</a></li>
        </ul>     
      </div>
      <div class="col-12 col-lg-4">
        <div class="mb-lg-3">
          <h5 class="text-white"><strong>Contact Us</strong></h5>
          <!-- <p class="foot-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
          <ul class="list-unstyled mb-0 foot-menu d-flex">
            <li class=""><a href="https://api.whatsapp.com/send?phone=08118877719" target="_blank" class="foot-link py-2 mr-2 h-100 d-flex align-items-center"><div style="background: rgb(255,255,255);width: 45px;height: 45px;border-radius: 50px;text-align: center;padding: 7px;box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);"><img src="{{url('assets/frontend/img/wa-fot.svg')}}" class="h-auto" style="width: 22px;" /></div></a></li>
            <li class=""><a href="mailto:hi@beangasm.id" class="foot-link py-2 mr-2 h-100 d-flex align-items-center"><div style="background: rgb(255,255,255);width: 45px;height: 45px;border-radius: 50px;text-align: center;padding: 7px;box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);"><img src="{{url('assets/frontend/img/mail-fot.svg')}}" class="h-auto" style="width: 22px;" /></div></a></li>
          </ul>
        </div>
        <div class="mb-lg-3">
          <h5 class="text-white"><strong>Follow Us</strong></h5>
          <ul class="list-unstyled mb-0 foot-menu d-flex">
            <li class=""><a href="https://www.instagram.com/beangasm.id/" target="_blank" class="foot-link py-2 mr-2 h-100 d-flex align-items-center"><div style="background: rgb(255,255,255);width: 45px;height: 45px;border-radius: 50px;text-align: center;padding: 7px;box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);"><img src="{{url('assets/frontend/img/ig-fot.svg')}}" class="h-auto" style="width: 22px;" /></div></a></li>
          </ul>
        </div>
      </div>
    </div>

    <hr style="background: #fff;" />

    <div class="row">
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h6 class="foot-desc mb-0 fw-300">&copy; 2019 - Beangasm. All Rights reserved. Design by GGA </h6>
      </div>
    </div>
    
  </div>
</footer>
<!-- Footer -->

@if((!Request::is('product/*')))
<!-- Nav Menu -->
<div class="space-header d-xl-none"></div>
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
      @if(Request::is('product'))
      <a href="{{ route('product') }}" class="menu-link menu-link-m active">
        <span class="nav-m nav-new"></span>
        <div class="fw-500">What's New</div>
      </a>
      @else
      <a href="{{ route('product') }}" class="menu-link menu-link-m">
        <span class="nav-m nav-new"></span>
        <div class="fw-500">What's New</div>
      </a>
      @endif
    </div>
    <div class="col px-0 text-center">
      @if(Request::is('list-store') || Request::is('product/categories/*'))
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
      <a href="{{ route('/') }}" class="menu-link menu-link-m active">
        <span class="nav-m nav-cart"></span>
        <div class="fw-500">Cart</div>
      </a>
      @else
      <a href="{{ route('/') }}" class="menu-link menu-link-m">
        <span class="nav-m nav-cart"></span>
        <div class="fw-500">Cart</div>
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