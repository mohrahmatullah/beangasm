<div class="suggestion-src-m text-left">
  <ul class="list-unstyled mb-0">
    @if(count($product) > 0)
	  <li class="text-grey mb-2"><b>Product</b></li>
	  @foreach($product as $key)
	  <li class="text-grey mb-1">
	  	<a href="{{ route('detail-product', $key->slug) }}" class="d-flex align-items-center">
	  		<img src="{{url('assets/frontend/img/search-grey.png')}}" class="mr-2" width="15px" height="15px" /> {{ $key->title }}
	  	</a>
	  </li>
	  @endforeach
	@endif
	  <br />
	@if(count($store) > 0)
	  <li class="text-grey mb-2"><b>Store</b></li>
	  @foreach($store as $key)
	  <li class="text-grey mb-1">
	  	<a href="{{ route('detail-list-store', $key->name) }}" class="d-flex align-items-center">
	  		<img src="{{url('assets/frontend/img/search-grey.png')}}" class="mr-2" width="15px" height="15px" /> {{ $key->display_name }}
	  	</a>
	  </li>
	  @endforeach
	@endif
	@if(count($store) <= 0 || count($product) <= 0)
	<br><br>
	<li class="text-grey text-center"><b>Oops, {{ (count($product) <= 0) ? 'product' : '' }} {{ (count($store) <= 0 && count($product) <= 0) ? 'dan' : ''}} {{ (count($store) <= 0) ? 'toko' : '' }} nggak ditemukan</b></li>
	@endif
  </ul>           
</div>