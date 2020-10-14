<div id="select-courier-shipping-html{{ $id_store }}" class="list-group position-absolute text-uppercase w-100" style="z-index: 1"> 
  @if(bestSeller($id_store))
  <a href="#" data-id_store="{{ $id_store }}" data-selected="Pick Up at Two Coffee Beans | Rp. 0" data-shipping_method_courier="Pick Up at Two Coffee Beans" data-shipping_method_etd="0" data-shipping_method_service="Pick Up at Two Coffee Beans" data-shipping_method_description="Pick Up at Two Coffee Beans" data-cost_value="0" class="list-group-item list-group-item-action courierSelect">Pick Up at Two Coffee Beans | Rp. 0</a>
  @endif
  @foreach( getShippingOptionBySellerID($id_store, $store_details->profile_details->city_id, $login_user_account_data->address_details->account_shipping_town_or_city_id, totalProductWeight($id_store) ) as $ongkirfee)
    @foreach($ongkirfee['costs'] as $costs)
      @foreach($costs['cost'] as $cost)
      <a href="#" data-id_store="{{ $id_store }}" data-selected="{{ $ongkirfee['code'] }} ({{ $costs['service']}}) | {{ $cost['etd'] }} Day(s) | {{ money($cost['value']) }}" data-shipping_method_courier="{{ $ongkirfee['code'] }}" data-shipping_method_etd="{{ substr($cost['etd'], -1) }}" data-shipping_method_service="{{ $costs['service']}}" data-shipping_method_description="{{ $costs['description']}}" data-cost_value="{{ $cost['value'] }}" class="list-group-item list-group-item-action courierSelect">{{ $ongkirfee['code'] }} ({{ $costs['service']}}) | {{ $cost['etd'] }} Day(s) | {{ money($cost['value']) }}</a>
      @endforeach
    @endforeach
  @endforeach
</div>

<script mtype="text/javascript" src="{{url('assets/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.courierSelect').on('click', function() {
      const id_store = $(this).data('id_store');
      const selected = $(this).data('selected');
      const cost_value = $(this).data('cost_value');
      const shipping_method_courier = $(this).data('shipping_method_courier');
      const shipping_method_etd = $(this).data('shipping_method_etd');
      const shipping_method_service = $(this).data('shipping_method_service');
      const shipping_method_description = $(this).data('shipping_method_description');
      // console.log(cost_value);
      $('#select-courier-shipping-html'+id_store).hide();
      $(document).find("#courier-dropdown"+id_store).val(selected);
      $(document).find("#shippingMethodCost"+id_store).val(cost_value);
      $(document).find("#shippingMethodCourier"+id_store).val(shipping_method_courier);
      $(document).find("#shippingMethodEtd"+id_store).val(shipping_method_etd);
      $(document).find("#shippingMethodService"+id_store).val(shipping_method_service);
      $(document).find("#shippingMethodServiceDescription"+id_store).val(shipping_method_description);
      $(document).find("#shippingMethodOption"+id_store).val('selected');

      document.getElementById("item-shipping-cost"+id_store).innerHTML = rupiah(cost_value, 'Rp ');
      document.getElementById("pSubtotal_per_store"+id_store).innerHTML = rupiah(parseInt($('.old_pSubtotal_per_store'+id_store).val()) + parseInt(cost_value), 'Rp ');

      let array_cost_shipping = document.querySelectorAll('.shipping_method_cost');
      let total_array_cost_shipping = 0;
      for(let i=0; i<array_cost_shipping.length; i++){
        if(parseInt(array_cost_shipping[i].value)){
            total_array_cost_shipping += parseInt(array_cost_shipping[i].value);
        }
      }
      document.getElementById("psubtotalShippingCost-step2").innerHTML = rupiah(total_array_cost_shipping, 'Rp ');
      document.getElementById("psubtotalShippingCost-step3").innerHTML = rupiah(total_array_cost_shipping, 'Rp ');
      document.getElementById("totalShippingCost").value = total_array_cost_shipping;
      
      document.getElementById('grandTotal-step2').innerHTML = rupiah(parseInt($('#cart_subtotal_page_1_wihtout_rupiah').val()) + parseInt(total_array_cost_shipping) + parseInt($('.pUniqueCode').val()) , 'Rp ');      

      if ($("#customSwitch1").is(':checked')) {
        document.getElementById('input-grandTotal-step3').value = (parseInt($('#cart_subtotal_page_1_wihtout_rupiah').val()) + parseInt(total_array_cost_shipping) + parseInt($('.pUniqueCode').val()) - parseInt($('#bean-points-value').val()) );
        document.getElementById('grandTotal-step3').innerHTML = rupiah(document.getElementById('input-grandTotal-step3').value , 'Rp ');
      }
      else {
        document.getElementById('input-grandTotal-step3').value = parseInt($('#cart_subtotal_page_1_wihtout_rupiah').val()) + parseInt(total_array_cost_shipping) + parseInt($('.pUniqueCode').val());
        document.getElementById('grandTotal-step3').innerHTML = rupiah(document.getElementById('input-grandTotal-step3').value , 'Rp ');        
      }

      $("html, body").delay(1000).animate({
        scrollTop: $('#courier-dropdown'+id_store).offset().top - 90 
      }, 2000);

    });
  });   
</script>