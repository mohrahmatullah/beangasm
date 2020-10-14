<div class="suggestion-src-m text-left">
  <ul class="list-unstyled mb-3">
	@if(count($store) > 0)
	  <li class="text-grey"><b>Store</b></li>
	  @foreach($store as $key)
	  <li class="text-grey">
	  	<a href="{{ route('detail-list-store', $key->name) }}" class="d-flex align-items-center">
	  		<img src="{{url('assets/frontend/img/search-grey.png')}}" class="mr-2" width="15px" height="15px" /> {{ $key->display_name }}
	  	</a>
	  </li>
	  @endforeach
	@else
	<br><br>
	<li class="text-grey text-center"><b>Oops, toko nggak ditemukan</b></li>
	@endif
  </ul>           
</div>