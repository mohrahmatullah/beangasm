<li class="float-left h-100 d-flex align-items-center position-relative mcard-l" id="cart-html">
  <a href="#" class="nav-link py-2 px-3 h-100 d-flex align-items-center position-relative show-mini-cart">
    <img src="{{url('assets/frontend/img/bag-l.png')}}" width="18" height="18" />
    @if(Cart::count() > 0)
      <div class="third d-inline-flex position-absolute text-white mcart-notif">{!! Cart::count() !!}</div>
    @endif
  </a>
  <div class="position-absolute white mcart-s" id="list_popover">
    @if( Cart::count() >0 )
    <ul class="list-unstyled">
      @foreach(Cart::items() as $index => $items)
      <li>
        <div class="row mx-0 align-items-center">
          <div class="col-3 px-1">
            <a href="{{ route('detail-product', get_product_slug($items->id)) }}">
              <img src="{{ config('app.url_media').$items->img_src }}" class="w-100 mcart-img" />
            </a>
          </div>
          <div class="col-8 px-1 d-inline-flex align-self-start flex-column">
            <h6 class="mb-0 mcart-title"><a href="{{ route('detail-product', get_product_slug($items->id)) }}">{!! $items->name !!}</a></h6>
            <div class="text-primary mcart-price">{!! price_html( get_product_price_html_by_filter( Cart::getRowPrice($items->quantity, get_role_based_price_by_product_id($items ->id, $items->price))) ) !!}</div>
            <div class="mcart-jml">{!! $items->quantity !!} X @ {!! ($items->total_weight) !!} gr</div>
          </div>
          <div class="col-1 px-1">
            <a class="btn w-100 mcart-del p-0 text-center" href="{{ route('removed-item-from-cart', $index)}}">
              <img src="{{url('assets/frontend/img/garbage.png')}}" alt="">
            </a>
          </div>
        </div>
        <hr class="my-2" />
      </li>
      @endforeach
      <li class="d-flex justify-content-between mb-2">
        <div class="d-inline-flex text-grey fw-500 mcart-title">Total :</div>
        <div class="d-inline-flex fw-500 text-primary mcart-price">{!! price_html( get_product_price_html_by_filter(Cart::getTotal()) ) !!}</div>
      </li>
      <hr class="my-2" />
      <li>
        <a href="{{ route('checkout-page') }}" class="d-block btn-bean w-100 fw-500 text-white third text-center">Checkout</a>
      </li>
    </ul>
    @else
    <ul class="list-unstyled">
      <li>
        <div class="row mx-0 align-items-center">
          <div class="d-flex justify-content-center align-items-center">
            <img src="{{url('assets/frontend/img/cart_empty.png')}}" class="w-100 h-auto" />
          </div>
        </div>
      </li>
    </ul>        
    @endif
  </div>  
</li>