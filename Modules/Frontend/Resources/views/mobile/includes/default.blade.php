<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    @include('frontend::mobile.includes.essentialmeta')

    <!-- Import CSS -->
    @include('frontend::mobile.includes.essentialcss')

  </head>
  <body>
    <input type="hidden" name="base_url" id="base_url" value="{{ config('app.url') }}">
    @include('frontend::mobile.includes.header')

    @yield('content')
    @include('frontend::mobile.includes.footer')

    @include('frontend::mobile.includes.essentialjs')
    <div id="shadow-layer"></div>
    <div class="add-to-cart-loader">
      <img src="{{ url('assets/frontend/img/ajax-loader.gif') }}" id="img-load" />
      <div class="cart-updating-msg">Wait - Your Cart Updating...</div>
    </div>
  </body>
</html>