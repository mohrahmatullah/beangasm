<div class="suggestion-src text-left">
	<ul class="list-unstyled mb-0">
		@if(count($store) > 0)
		  @foreach($store as $key)
		  <li class="text-grey">
		  	<a href="{{ route('detail-list-store', $key->name) }}">{{ $key->display_name }}</a>
		  </li>
		  @endforeach
		@else
			<li class="text-grey text-center"><b>Oops, toko nggak ditemukan</b></li>
		@endif
	</ul>            
</div>