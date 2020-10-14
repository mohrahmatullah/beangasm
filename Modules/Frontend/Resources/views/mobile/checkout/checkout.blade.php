@extends('frontend::mobile.includes.default')
@section('title', 'Checkout | Beangasm')
@section('content')

<!-- Main Content -->
<main>
  <form method="post" action="" enctype="multipart/form-data">
    @csrf
    <section id="step1" class="dt-ord-s mt-3">
      @if( Cart::count() > 0 )
      <div class="container">
        <div class="row">
          <div class="col-12 col-xl-8">
            <div class="py-2 px-3 mb-2" style="background: #f5f5f5;">
              <h5 class="mb-0">Produk Pilihan</h5>
            </div>

            @php $i = 0; @endphp          
            @foreach($product_cart as $group => $c)
              <div class="chk-c py-2 px-3 mb-2 fs-1">
                <h5 class="fw-500 mb-0 text-capitalize">{!! get_store_name($group) !!}</h5>
              </div> 
              @foreach($c as $items)
              <div class="chk-c p-2 mb-2">
                <div class="chk-rec position-absolute m-2">
                  <a href="{{ route('removed-item-from-cart', $items->id) }}">
                    <img src="{{url('assets/frontend/img/garbage.png')}}" alt="">
                  </a>              
                </div>
                <div class="chk-prd d-flex">
                  <div class="chk-img mb-3">
                    <img src="{{ config('app.url_media').$items->img_src }}"/>
                  </div>
                  <div class="chk-bdy w-100 mb-3 pl-3 pr-4">
                    <h5 class="mb-2">{!! $items->name !!}</h5>
                    <div class="chk-bdy-pr mb-1 fw-500" id="total_harga_page_1_{{ $items->id }}">{!! money(  get_product_price_html_by_filter(Cart::getRowPrice($items->quantity, $items->price) )) !!}</div>
                    <input type="hidden" class="total_harga" name="total_harga_per_product[{{ $items->id }}]" id="total_harga_page_1_wihtout_rupiah_{{ $items->id }}" value="{{ get_product_price_html_by_filter(Cart::getRowPrice($items->quantity, $items->price) ) }}">
                    <div class="mb-1" id="total_weight_page_1_format_{{ $items->id }}">@ {!! ($items->weight * $items->quantity) !!} gr</div>
                    <input type="hidden" name="total_weight_per_product[{{ $items->id }}]" id="total_weight_page_1_{{ $items->id }}" value="{{ ($items->weight * $items->quantity) }}">
                  </div>
                </div>
                <hr class="my-1" />
                <div class="form-group mb-0">
                  <div class="row align-items-center">
                    <div class="col-12 col-lg-6 mb-2">
                      <label for="exampleFormControlTextarea1" class="fw-500">Catatan untuk penjual (opsional) :</label>
                      <textarea rows="1" class="chk-msg item-input-notes" name="order_notes[{{ $items->id }}]" data-id_products="{{ $items->id }}" id="item-input-notes-{{ $items->id }}" placeholder="berikan catatan disini"></textarea>
                    </div>
                    <div class="col-12 col-lg-6 mb-2">
                      <div class="row mx-0 align-items-center">
                        <div class="col-12 pl-0 pl-lg-3 text-right">
                          <div class="inf-lnk d-flex align-items-center justify-content-start justify-content-lg-end">
                            <ul class="list-unstyled lnk-stok d-inline-flex mb-0 mr-0">
                              @php
                                $get_product = DB::table('products')->where('id', $items->id)->where('status', '1')->first();
                                $get_stock_qty = DB::table('product_extras')->where('product_id', $items->id)->where('key_name', '_product_manage_stock_qty')->first();

                                if(!empty($get_stock_qty)){                   
                                  $product_stock_qty = $get_stock_qty->key_value;
                                } else{
                                  $product_stock_qty = $get_product->stock_qty;  
                                }
                                $product_stock_availability = $get_product->stock_availability;
                              @endphp
                              <li class="stok-itm">
                                <a href="#" class="dec-qty-items" data-id_products="{{ $items->id }}" data-id_store="{{ $group }}" data-product_price="{{ $items->price }}" data-product_weight="{{ $items->weight }}" data-stock_item_min="1">
                                  <img class="of-cover" src="{{url('assets/frontend/img/-.png')}}"  />
                                </a>
                              </li>
                              <li class="stok-itm">
                                <input readonly type="text" value="{{ $items->quantity }}" name="cart_quantity[{{ $items->id }}]" value="{{ $items->quantity }}" id="itemsQty_1_{{ $items->id }}" min="1" max="@if(isset($product_stock_qty) && ($product_stock_qty != "0") && ($product_stock_availability == "in_stock")){{$product_stock_qty}}@else{{10}}@endif"/>
                              </li>
                              <li class="stok-itm">
                                <a href="#" class="inc-qty-items" data-id_products="{{ $items->id }}" data-id_store="{{ $group }}" data-product_price="{{ $items->price }}" data-product_weight="{{ $items->weight }}" data-stock_item_max="@if(isset($product_stock_qty) && ($product_stock_qty != "0") && ($product_stock_availability == "in_stock")){{$product_stock_qty}}@else{{10}}@endif">
                                  <img class="of-cover" src="{{url('assets/frontend/img/+.png')}}" />
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @php $i++; @endphp
              @endforeach
            @endforeach
          </div>
          <div class="col-12 col-xl-4">
            <div class="py-2 px-3 mb-2" style="background: #f5f5f5;">
              <h5 class="mb-0">Rincian Harga</h5>
            </div>
            <div class="chk-c py-2 px-3 mb-2">
              <ul class="list-unstyled">
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Cart Sub Total :</div>
                  <div class="d-inline-flex fw-500 text-primary" id="cart_subtotal_page_1">{!! money( Cart::getTotal() ) !!}</div>
                  <input type="hidden" name="final_subtotal" id="cart_subtotal_page_1_wihtout_rupiah" value="{!! Cart::getTotal() !!}">
                </li>
                {{--<li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Tax :</div>
                  <div class="d-inline-flex fw-500 text-primary">{!! money( Cart::getTax() ) !!}</div>
                </li>--}}
                <hr />
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Beans Points :</div>
                  <div class="d-inline-flex fw-500 text-primary">{!! money( $login_user_account_info['total_points'] ) !!}</div>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <div onclick="goStep2()" class="btn-bean mt-2 w-100 text-uppercase fw-500 text-center">
                    Proceed to Checkout
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      @else
      <div class="container">
        <div class="d-flex justify-content-center align-items-center">
          <img src="{{url('assets/frontend/img/cart_empty.png')}}" class="w-100 h-auto" />
        </div>
      </div>
      @endif
    </section>

    <section id="step2" class="dt-ord-s mt-3">
      <div class="container">
        <div class="row">
          <div class="col-12 col-xl-8">
            <div class="alert alert-warning" role="alert" style="display: none;" id="alertAuth">
              Please sign up/sign in to continue the proceed checkout !
            </div>
            <div class="alert alert-warning" role="alert" style="display: none;" id="alertAddress">
              Please add your shipping address !
            </div>
            <div class="py-2 px-3 mb-2" style="background: #f5f5f5;">
              <h5 class="mb-0">Alamat Pengiriman</h5>
            </div>
            @if(Session::get('beangasm_frontend_buyer_id'))
              @if(isset($login_user_account_data) && isset($login_user_account_data->address_details) && !empty($login_user_account_data->address_details))
              <div class="chk-c py-2 px-3 mb-2">
                <div>
                  <input id="address_akun_0" type="radio" name="address" class="mr-2 position-absolute chk-ck" /><label for="address_akun_0" class="d-inline-block ml-4 fw-500 mb-0">Alamat Rumah</label>
                </div>
                <div class="pl-4">
                  <p>
                    {!! $login_user_account_data->address_details->account_shipping_adddress_line_1 !!}, 
                     @if($login_user_account_data->address_details->account_shipping_adddress_line_2)
                      {!! $login_user_account_data->address_details->account_shipping_adddress_line_2 !!}, 
                    @endif
                    {!! $login_user_account_data->address_details->account_shipping_urban_village !!}, 
                    {!! $login_user_account_data->address_details->account_shipping_subdistrict !!}, 
                    {!! $login_user_account_data->address_details->account_shipping_town_or_city !!}, 
                    {!! $login_user_account_data->address_details->account_shipping_province !!}, 
                    {!! $login_user_account_data->address_details->account_shipping_zip_or_postal_code !!},
                    {!! $login_user_account_data->address_details->account_shipping_select_country !!}
                  </p>
                  <p>
                    Penerima : {!! $login_user_account_data->address_details->account_shipping_receiver_name !!} <br />
                    Phone : {!! $login_user_account_data->address_details->account_shipping_phone_number !!} <br />
                    Email : {!! $login_user_account_data->address_details->account_shipping_email_address !!}
                  </p>
                  <a href="" class="text-primary">Edit alamat</a>
                </div>
              </div>
              @else
              <div class="chk-c py-2 px-3 mb-2">
                <div class="pl-4">
                  <p class="mb-0">
                    Anda belum menambahkan alamat
                  </p>
                  <a href="" class="text-primary">Tambah alamat</a>
                </div>
              </div>
              @endif
            @else
            <div class="chk-c py-2 px-3 mb-2">
              <div class="fw-500 text-center">Silahkan login untuk melanjutkan</div>
            </div>          
            <div class="chk-c py-2 px-3 mb-2">
              <div class="row">
                <div class="col-12 col-md-6 text-center mb-2">
                  <div class="fw-500">login untuk melanjutkan</div>
                  <a href="{{ route('buyer-login') }}" class="btn-bean mt-3 w-100 text-uppercase fw-500 text-white d-block">login dengan akun anda</a>
                </div>
                <div class="col-12 col-md-6 text-center mb-2">
                  <div class="fw-500">belum mempunyai akun ?</div>
                  <a href="{{ route('buyer-register') }}" class="btn-bean mt-3 w-100 text-uppercase fw-500 text-white d-block">buat akun baru anda</a>
                </div>
              </div>
            </div>
            @endif
            <div class="py-2 px-3 mb-2" style="background: #f5f5f5;">
              <h5 class="mb-0">Detail Order</h5>
            </div>
            <input type="hidden" class="countLoopProductCart" value="{{ sizeof($product_cart) }}">   
            @foreach($product_cart as $group => $c)             
              <div class="chk-c py-2 px-3 mb-2 fs-1 justify-content-between align-items-center">
                <div class="row">
                  <div class="col-lg-6">
                    <h5 class="fw-500 mb-2">{!! get_store_name($group) !!}</h5>
                  </div>
                  @if(Session::get('beangasm_frontend_buyer_id') && isset($login_user_account_data) && isset($login_user_account_data->address_details) && !empty($login_user_account_data->address_details))
                  <div class="col-lg-6">
                    <input data-id_store="{{ $group }}" id="courier-dropdown{{ $group }}" type="button" class="form-control text-uppercase courier-dropdown" value="Please select courier">     
                    <input type="hidden" id="shippingMethodCost{{ $group }}" class="shipping_method_cost" name="shipping_method_cost[{{ $group }}]" value="0">
                    <input type="hidden" id="shippingMethodEtd{{ $group }}" name="shipping_method_etd[{{ $group }}]" value="">
                    <input type="hidden" id="shippingMethodOption{{ $group }}" class="shippingMethodOption{{ $loop->index }}" name="shipping_method_option[{{ $group }}]" value="0">
                    <input type="hidden" id="shippingMethodCourier{{ $group }}" name="shipping_method_courier[{{ $group }}]" value="0">
                    <input type="hidden" id="shippingMethodService{{ $group }}" name="shipping_method_service[{{ $group }}]" value="">
                    <input type="hidden" id="shippingMethodServiceDescription{{ $group }}" name="shipping_method_service_description[{{ $group }}]" value="">
                    <input type="hidden" id="shippingUserEmail" name="shipping_user_email" value="{{$login_user_account_info['user_email']}}">
                    <div class="position-relative courier-shipping-html{{ $group }}"></div>
                    <div class="position-relative">
                      <div class="alert alert-warning position-absolute text-center w-100" role="alert" style="display: none;" id="alertShippingMethod{{ $loop->index }}">
                        Please choise courier
                      </div>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
              @php
                $total_beans = 0;
                $total_harga_beans_per_store = 0;
              @endphp
              @foreach($c as $items)
                <div class="chk-c p-2 mb-2">
                  
                  <div class="chk-prd d-flex">
                    <div class="chk-img mb-3">
                      <img src="{{ config('app.url_media').$items->img_src }}"/>
                    </div>
                    <div class="chk-bdy w-100 mb-3 pl-3 pr-4">
                      <h5 class="mb-2">{!! $items->name !!}</h5>
                      <div class="chk-bdy-pr mb-1 fw-500" id="total_harga_page_2_{!! $items->id !!}">{!! money(  get_product_price_html_by_filter(Cart::getRowPrice($items->quantity, $items->price) )) !!}</div>
                      <input type="hidden" id="total_harga_page_2_wihtout_rupiah_{{ $items->id }}" value="{{ get_product_price_html_by_filter(Cart::getRowPrice($items->quantity, $items->price) ) }}">
                      <div class="mb-1">
                        <span id="itemsQty_2_{!! $items->id !!}">{{ $items->quantity }}</span> bean 
                        <span id="total_weight_page_2_format_{{ $items->id }}">{!! ($items->weight * $items->quantity) !!} gr</span>
                        <input type="hidden" id="total_weight_page_2_{{ $items->id }}" value="{{ ($items->weight * $items->quantity) }}">
                      </div>
                    </div>
                  </div>
                  <hr class="my-1" />
                  <div class="form-group mb-0">
                    <div class="row align-items-center">
                      <div class="col-12 col-lg-6 mb-2">
                        <label for="exampleFormControlTextarea1" class="fw-500">Catatan untuk penjual (opsional) :</label>
                        <p class="mb-0" id="notes-product-{{ $items->id }}">-</p>
                      </div>
                    </div>

                  </div>
                </div>                
                @php 
                  $i++;
                  $total_beans += $items->quantity;
                  $total_harga_beans_per_store += get_product_price_html_by_filter(Cart::getRowPrice($items->quantity, $items->price) );
                @endphp
              @endforeach

              <div class="row">
                <div class="col-12">
                  <div class="accordion mb-3" id="accordFlt">
                    <div class="card accord">

                      <div class="card-header accord" id="accordFltHead">
                        <h2 class="mb-0">
                          <button class="btn btn-link d-flex w-100 justify-content-between align-items-center h-td-none" type="button" data-toggle="collapse" data-target="#accord-sub-total-{{ $group }}" aria-expanded="true" aria-controls="collapseOne">
                            <div class="row align-items-center w-100">
                              <div class="col-6">
                                <h6 class="mb-1 text-grey fw-400 arial-ss text-left">Sub Total</h6>
                              </div>
                              <div class="col-6 text-right">
                                <p id="pSubtotal_per_store{{ $group }}" class="mb-0 text-primary fs-1 fw-600 arial-ss">{!! money( $total_harga_beans_per_store ) !!}</p>
                                <input type="hidden" name="final_order_total_per_store[{{ $group }}]" class="old_pSubtotal_per_store{{ $group }}" value="{!! $total_harga_beans_per_store !!}">
                              </div>
                            </div>
                            <img class="arrow-flt-accord of-cover" src="{{url('assets/frontend/img/arrow-r-b.svg')}}" />
                          </button>
                        </h2>
                      </div>
                  
                      <div id="accord-sub-total-{{ $group }}" class="collapse" aria-labelledby="accordFltHead" data-parent="#accordFlt">
                        <div class="card-body accord">
                          <ul class="list-unstyled">
                            <li>
                              <div class="row align-items-center">
                                <div class="col-6">
                                  <h6 class="mb-1 text-grey fw-400 arial-ss fs-08">Harga (<span id="total_itemsQty_2_{{ $group }}">{{ $total_beans }}</span> bean) </h6>
                                </div>
                                <div class="col-6 text-right">
                                  
                                  <p id="pSubtotal{{ $group }}" class="mb-0 text-primary fw-600 arial-ss fs-08">{!! money( $total_harga_beans_per_store ) !!}</p>
                                  
                                  <input name="order_total[{{ $group }}]" type="hidden" id="old_pSubtotal" class="old_pSubtotal{{ $group }}" value="{!! $total_harga_beans_per_store !!}">
                                </div>
                              </div>
                            </li>
                            @if(Session::get('beangasm_frontend_buyer_id') && isset($login_user_account_data) && isset($login_user_account_data->address_details) && !empty($login_user_account_data->address_details))
                            <li>
                              <div class="row align-items-center">
                                <div class="col-6">
                                  <h6 class="mb-1 text-grey fw-400 arial-ss fs-08">Shipping Cost</h6>
                                </div>
                                <div class="col-6 text-right">
                                  
                                  <p id="item-shipping-cost{{ $group }}" class="mb-0 text-primary fw-600 arial-ss fs-08">-</p>
                                </div>
                              </div>
                            </li>
                            @endif
                          </ul>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <div class="col-12 col-xl-4">
            <div class="py-2 px-3 mb-2" style="background: #f5f5f5;">
              <h5 class="mb-0">Rincian Harga</h5>
            </div>
            <div class="chk-c py-2 px-3 mb-2">
              <ul class="list-unstyled">
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Cart Sub Total :</div>
                  <div class="d-inline-flex fw-500 text-primary" id="cart_subtotal_page_2">{!! money( Cart::getTotal() ) !!}</div>
                  <input type="hidden" class="getTotal" value="{{ Cart::getTotal() }}">
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Tax :</div>
                  <div class="d-inline-flex fw-500 text-primary">{!! money( Cart::getTax() ) !!}</div>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Total Shipping Cost :</div>
                  <div class="d-inline-flex fw-500 text-primary" id="psubtotalShippingCost-step2">Rp. 0</div>
                  <input type="hidden" name="totalShippingCost" id="totalShippingCost" value="0">
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Unique Code :</div>
                  <div class="d-inline-flex fw-500 text-primary">{!! money( $unique_code ) !!}</div>
                  <input type="hidden" name="final_unique_code" class="pUniqueCode" value="{{ $unique_code }}">
                </li>
                <hr />
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Beans Points :</div>
                  <div class="d-inline-flex fw-500 text-primary">{!! money( $login_user_account_info['total_points'] ) !!}</div>
                </li>
                <hr />
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Grand Total :</div>
                  <div class="d-inline-flex fw-500 text-primary" id="grandTotal-step2">{{ money(Cart::getTotal() + $unique_code) }}</div>
                </li>
                <li class="d-flex justify-content-between ">
                  @if($is_buyer_login == false)
                  <div class="btn-bean mt-2 w-100 text-uppercase fw-500 text-center show-alert-auth">
                    Proceed to Checkout
                  </div>   
                  @elseif(empty($login_user_account_data->address_details))
                  <div class="btn-bean mt-2 w-100 text-uppercase fw-500 text-center show-alert-address">
                    Proceed to Checkout
                  </div>             
                  @else
                  <div class="btn-bean mt-2 w-100 text-uppercase fw-500 text-center goStep3">
                    Proceed to Checkout
                  </div>
                  @endif
                </li>
                <li class="d-flex justify-content-between ">
                  <div onclick="goStep1()" class="btn-bean mt-2 w-100 text-uppercase fw-500 text-primary white text-center">
                    Back to Cart
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="step3" class="dt-ord-s mt-3">
      <div class="container">
        <div class="row">
          <div class="col-12 col-xl-8">
            <div class="py-2 px-3 mb-2" style="background: #f5f5f5;">
              <h5 class="mb-0">Pilih Metode Pembayaran</h5>
            </div>
            <div class="chk-c py-2 px-3 mb-2">
              <div>
                <input id="payment_method_0" type="radio" name="payment_option" checked value="bacs" class="mr-2 position-absolute chk-ck" /><label for="payment_method_0" class="d-inline-block ml-4 fw-500 mb-0">Transfer Bank BCA</label>
              </div>
              <div class="pl-4">
                <label for="payment_method_0" class="mb-0">
                  (Manual Confirmation)
                </label>
              </div>
            </div>
            <div class="chk-c py-2 px-3 mb-2">
              <div>
                <input id="payment_method_1" type="radio" name="payment_option" value="others" class="mr-2 position-absolute chk-ck" /><label for="payment_method_1" class="d-inline-block ml-4 fw-500 mb-0">Metode Pembayaran Lain</label>
              </div>
              <div class="pl-4">
                <label for="payment_method_1" class="mb-0">
                  (Bank Mandiri, Bank BNI, Bank Permata, Gopay, Alfamart)
                </label>
              </div>
            </div>
           
          </div>
          <div class="col-12 col-xl-4">
            <div class="py-2 px-3 mb-2" style="background: #f5f5f5;">
              <h5 class="mb-0">Rincian Harga</h5>
            </div>
            <div class="chk-c py-2 px-3 mb-2">
              <ul class="list-unstyled">
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Cart Sub Total :</div>
                  <div class="d-inline-flex fw-500 text-primary" id="cart_subtotal_page_3">{!! money( Cart::getTotal() ) !!}</div>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Tax :</div>
                  <div class="d-inline-flex fw-500 text-primary">{!! money( Cart::getTax() ) !!}</div>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Shipping Cost :</div>
                  <div class="d-inline-flex fw-500 text-primary" id="psubtotalShippingCost-step3">Rp. 0</div>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Unique Code :</div>
                  <div class="d-inline-flex fw-500 text-primary">{!! money( $unique_code ) !!}</div>
                </li>
                <hr />
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Beans Points :</div>
                  <div class="d-inline-flex fw-500 text-primary">{!! money( $login_user_account_info['total_points'] ) !!}</div>
                  <input type="hidden" name="bean_points" id="bean-points-value" value="{{ $login_user_account_info['total_points'] }}">
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <label class="d-inline-flex text-grey mb-0" for="customSwitch1">Use Beans Points</label>
                  <div class="d-inline-flex">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="customSwitch1">
                      <label class="custom-control-label" for="customSwitch1"></label>
                    </div>
                  </div>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Beans Points Used :</div>
                  <div class="d-inline-flex fw-500 text-primary" id="used-beans-points">Rp. 0</div>
                  <input type="hidden" name="bean_points_used" id="used-beans-points-value" value="">
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Beans Points Remaining :</div>
                  <div class="d-inline-flex fw-500 text-primary" id="beans-points-remaining">{!! money( $login_user_account_info['total_points'] ) !!}</div>
                </li>
                <hr />
                @if(sizeof($product_cart) == 1)
                <li class="">
                  <label for="coupon" class="text-grey">Coupon Code :</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-coupon text-uppercase fw-400 text-grey" placeholder="Enter code" aria-label="Enter code" aria-describedby="apply-coupon" name="coupon">
                    <div class="input-group-append">
                      <div class="input-group-text text-uppercase primary text-white coupon-btn fw-500">Apply</div>
                    </div>
                  </div>
                </li>
                @else
                <li class="">
                  <label for="coupon" class="text-grey">Coupon Code :</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-coupon text-uppercase fw-400 text-grey" placeholder="Enter code" aria-label="Enter code" aria-describedby="apply-coupon" name="coupon">
                    <div class="input-group-append">
                      <div class="input-group-text text-uppercase primary text-white coupon-btn fw-500" id="alert-apply-coupon">Apply</div>
                    </div>
                  </div>
                </li>
                @endif
                <hr />
                <li class="d-flex justify-content-between mb-2">
                  <div class="d-inline-flex text-grey">Grand Total :</div>
                  <div class="d-inline-flex fw-500 text-primary" id="grandTotal-step3"></div>
                  <input type="hidden" name="grandTotal" id="input-grandTotal-step3" value="0">
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <button type="submit" class="btn-bean mt-2 w-100 text-uppercase fw-500">
                    Place Order
                  </button>
                </li>
                <li class="d-flex justify-content-between ">
                  <div onclick="goStep2()" class="btn-bean mt-2 w-100 text-uppercase fw-500 text-primary white text-center">
                    Back to Checkout
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
  <section id="step4" class="dt-ord-s mt-3">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-xl-8">
          <div class="chk-c py-3 px-3 mb-2 text-center">
            <h1>Terima Kasih</h1>
            <div class="mb-2">Mohon selesaikan pembayaran untuk no pesanan <span class="text-third fw-500">090902882</span></div>
            <div class="mb-2 st4-time">23 : 58 : 40</div>
            <div class="mb-2 text-grey">(Sebelum selasa 15 oktober 2019 pukul 13:17 WIB)</div>
          </div>
          <div class="chk-c py-3 px-3 mb-2 text-center">
            <div class="mb-2 text-grey">Jumlah yang di transfer</div>
            <div class="mb-2 st4-price">Rp 657.000.<span>329</span></div>
            <div class="mb-2">Mohon di transfer hingga 3 digit terakhir</div>
            <button class="btn text-third"><u>Salin Jumlah</u></button>
          </div>
          <div class="chk-c py-3 px-3 mb-2 text-center">
            <div class="mb-2 text-grey">Nomor Rekening</div>
            <div class="mb-2 st4-rek d-flex align-items-center justify-content-center fw-500"><img class="h-auto mr-2" src="{{url('assets/frontend/img/st4-bca.png')}}"/> 992 9390 342</div>
            <div class="mb-2 fw-500">a/n PT Kopikitasemua</div>
            <button class="btn text-third"><u>Salin No.Rek</u></button>
          </div>
          <a href="" class="d-block btn-bean w-100 fw-500 text-white third mb-2 text-center">Lihat Status Pemesanan</a>
          <a href="" class="d-block btn-bean w-100 fw-500 text-third white mb-2 text-center border-2-third">Upload Bukti Pembayaran</a>
          <a href="" class="d-block btn-bean w-100 fw-500 text-third white mb-2 text-center">Kembali ke halaman Home</a>
        </div>
      </div>
    </div>
  </section>

  <section id="step4-2" class="dt-ord-s mt-3">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-xl-8">
          <div class="chk-c py-3 px-3 mb-2 text-center">
            <h1>Terima Kasih</h1>
            <div class="mb-2">Pesanan anda segera di kemas</div>
          </div>
          <a href="" class="d-block btn-bean w-100 fw-500 text-white third mb-2 text-center">Lihat Status Pemesanan</a>
          <a href="" class="d-block btn-bean w-100 fw-500 text-third white mb-2 text-center border-2-third">Upload Bukti Pembayaran</a>
          <a href="" class="d-block btn-bean w-100 fw-500 text-third white mb-2 text-center">Kembali ke halaman Home</a>
        </div>
      </div>
    </div>
  </section>

</main>
<!-- /Main Content -->

@endsection