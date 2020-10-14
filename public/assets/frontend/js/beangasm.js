	/* Script JS Pagging More */
	$(document).ready(function(){
	  $(document).on('click', '#loadmore',function(event)
	  {
	    event.preventDefault();
	    var page_url = $(this).attr('href');
	    getData(page_url);
	  });
	  $(document).on('click', '#loadmorestr',function(event)
	  {
	    event.preventDefault();
	    var page_url = $(this).attr('href');
	    getDataStr(page_url);
	  });
	});

	function getData( page_url ){
		var src = $('#base_url').val() + '/assets/frontend/img/ajax-loader.gif';
		$.ajax({
			url: page_url,
			type: "get",
			datatype: "html",
			beforeSend: function () {
			  $("#loadmore").html('<img src="'+src+'" width="30px" />');
			},
			success: function (data) {
				if(data != '') 
			      {
			          $("#load-more").remove();
				      $("#list-terkini-ajax").append(data);
				      // NProgress.done();
			      }
			      else
			      {
			          $('#loadmore').html("No Data");
			      }		  
			}                       
	 	})
		.fail(function(jqXHR, ajaxOptions, thrownError){
			alert('No response from server');
		});
	}

	function getDataStr( page_url ){
		var src = $('#base_url').val() + '/assets/frontend/img/ajax-loader.gif';
		$.ajax({
			url: page_url,
			type: "get",
			datatype: "html",
			beforeSend: function () {
			  $("#loadmorestr").html('<img src="'+src+'" width="30px" />');
			},
			success: function (data) {
				if(data != '') 
			      {
			          $("#load-more-str").remove();
				      $("#list-terkini-ajax-str").append(data);
				      // NProgress.done();
			      }
			      else
			      {
			          $('#loadmorestr').html("No Data");
			      }		  
			}                       
	 	})
		.fail(function(jqXHR, ajaxOptions, thrownError){
			alert('No response from server');
		});
	}

	/* \Script JS Pagging More */

	$(document).ready(function() {
	    $('#example').DataTable({
			    	//dom: '<"top"lBfrtip>',
		    dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>> <'row'<'col-sm-12'tr>> <'row'<'col-sm-5'i><'col-sm-7'p>>",
		    "order": [[ 1, "desc" ]],
		    buttons: [
		      {
		        extend: 'collection',
		        text: 'Export',
		        // buttons: [
		        //   'copy', 'csv', 'excel', 'pdf', 'print'
		        // ]
		        buttons: [
		                // {
		                //   extend: "copy",
		                //   className: "btn-sm"
		                // },
		                // {
		                //   extend: "csv",
		                //   className: "btn-sm"
		                // },
		                {
		                  extend: "excel",
		                  className: "btn-sm"
		                },
		                {
		                  extend: "pdfHtml5",
		                  className: "btn-sm",
		                  orientation: 'landscape'
		                },
		                {
		                  extend: "print",
		                  className: "btn-sm"
		                },
		              ]
		      }
		    ]
	    });
	} );

	$(document).ready(function(){
		$(window).scroll(function() {
			if ($(this).scrollTop() > 1110) {
				$('#sort-filter').fadeOut();
				$('#nav-menu').fadeIn();
			} else {
				$('#sort-filter').fadeIn();
				$('#nav-menu').fadeOut();
			}
		});

		$('.search-suggestion').on('input change', function(){
			var keyword = $('.search-suggestion').val();
		     $.ajax({
                url: $('#base_url').val() + '/ajax/get-search-suggestion-data',
                type: 'POST',
                cache: false,
                datatype: 'json',
                headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
                data: {keyword:keyword},
                beforeSend: function(){
				$('#search-content').html('<img src="assets/frontend/img/ajax-loader.gif" width="100px" />');
				},
                success: function(data){
                  console.log(data);
					if(data.error_no_entered == false){
						$('#search-content').html(null);
					}
					else{
					    $('#search-content').html(data);
					}
                },
                error:function(){}
            });
		});
		$('.suggestion-src-store').on('input change', function(){
			var keyword = $('.suggestion-src-store').val();
		     $.ajax({
                url: $('#base_url').val() + '/ajax/get-search-suggestion-store-data',
                type: 'POST',
                cache: false,
                datatype: 'json',
                headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
                data: {keyword:keyword},
                beforeSend: function(){
				$('#search-store-content').html('<img src="assets/frontend/img/ajax-loader.gif" width="100px" />');
				},
                success: function(data){
                  console.log(data);
					if(data.error_no_entered == false){
						$('#search-store-content').html(null);
					}
					else{
					    $('#search-store-content').html(data);
					}
                },
                error:function(){}
            });
		});

		if($('#product-category').length>0){
		  $('.sort-by-filter').on('change', function() {
	        window.location.href = replaceUrl(window.location.href, "sort", $(this).val());
	      });
	      $('.sort-by-filter-mobile').on('click', function() {
	        window.location.href = replaceUrl(window.location.href, "sort", $(this).data('val_sort'));
	      });    
	      $('.sort-by-acidity-min').on('change', function() {
	        window.location.href = replaceUrl(window.location.href, "acidity_min", $(this).val());
	      });
	      $('.sort-by-acidity-max').on('change', function() {
	        window.location.href = replaceUrl(window.location.href, "acidity_max", $(this).val());
	      });
	      $('.sort-by-sweetness-min').on('change', function() {
	        window.location.href = replaceUrl(window.location.href, "sweetness_min", $(this).val());
	      });
	      $('.sort-by-sweetness-max').on('change', function() {
	        window.location.href = replaceUrl(window.location.href, "sweetness_max", $(this).val());
	      });
	      $('.sort-by-body-min').on('change', function() {
	        window.location.href = replaceUrl(window.location.href, "body_min", $(this).val());
	      });
	      $('.sort-by-body-max').on('change', function() {
	        window.location.href = replaceUrl(window.location.href, "body_max", $(this).val());
	      });
	      $('.sort-by-sub-cat').on('change', function() {
	        window.location.href = replaceUrl(window.location.href, "sub_category", $(this).val());
	      });
	      $('.sort-by-sub-cat-mobile').on('click', function() {
	        window.location.href = replaceUrl(window.location.href, "sub_category", $(this).data('val_sort'));
	      }); 
	    }
	    function replaceUrl(url, paramName, paramValue){
		  if(paramValue == null)
		      paramValue = '';
		  var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)');
		  if(url.search(pattern)>=0){
		      return url.replace(pattern,'$1' + paramValue + '$2');
		  }
		  return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
		}

		$('.btn-number').click(function(e){
		      e.preventDefault();
		      
		      fieldName = $(this).attr('data-field');
		      type      = $(this).attr('data-type');
		      var input = $("input[name='"+fieldName+"']");
		      var currentVal = parseInt(input.val());
		      if (!isNaN(currentVal)) {
		          if(type == 'minus') {

		              if(currentVal > input.attr('min')) {
		                  input.val(currentVal - 1).change();
		              } 
		              if(parseInt(input.val()) == input.attr('min')) {
		                  $(this).attr('disabled', true);
		              }

		          } else if(type == 'plus') {

		              if(currentVal < input.attr('max')) {
		                  input.val(currentVal + 1).change();
		              }
		              if(parseInt(input.val()) == input.attr('max')) {
		                  $(this).attr('disabled', true);
		              }

		          }
		      } else {
		          input.val(0);
		      }
		});

		$('.add-to-checkout').click(function() {
		    var checkoutURL = '/checkout';
		    location.href = checkoutURL;
		});

		$('.add-to-cart-bg, .single-page-add-to-cart').on('click', function(e){
		    e.preventDefault();
		    var dataObj = {};
		    
		    dataObj['product_id'] = $(this).data('id');

		    if($('#quantity').length>0){
		      dataObj['qty'] = parseInt( $('#quantity').val() );
		    }
		    else{
		      dataObj['qty'] = 1;
		    }

		    // if($('#selected_variation_id').length>0 && $('#selected_variation_id').val()){
		    //   dataObj['variation_id'] = parseInt( $('#selected_variation_id').val() );
		    // }
		   console.log(dataObj);
		    
		    $('#shadow-layer, .add-to-cart-loader').show();
		    $.ajax({
		        url: $('#base_url').val() + '/ajax/add-to-cart',
		        type: 'POST',
		        cache: false,
		        datatype: 'json',
		        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
		        data: dataObj,

		        success: function(data){
		          console.log(data);
		          if(data && data == 'zero_price'){
		            $('#shadow-layer, .add-to-cart-loader').hide();
		            swal({
			          text: 'Price can not be zero.',
			          type: 'warning',
			          timer: 2000,
			          showCancelButton: false,
			          showConfirmButton: false
			        });
		          }
		          else if(data && data == 'out_of_stock'){
		            $('#shadow-layer, .add-to-cart-loader').hide();
		            swal({
			          text: 'Currently this product out of stock.',
			          type: 'warning',
			          timer: 2000,
			          showCancelButton: false,
			          showConfirmButton: false
			        });
		          }
		          else if(data && data == 'vendor_not_same'){
		            $('#shadow-layer, .add-to-cart-loader').hide();
		            swal({
			          text: 'You can not add multiple vendors product at a time in the cart, please add same vendor products.',
			          type: 'warning',
			          timer: 2000,
			          showCancelButton: false,
			          showConfirmButton: false
			        });
		          }
		          else if(data && data == 'item_added'){
		            $.ajax({
		                url: $('#base_url').val() + '/ajax/get-mini-cart-data',
		                type: 'POST',
		                cache: false,
		                datatype: 'json',
		                headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },

		                success: function(data){
		                  console.log(data);
		                  if(data.status && data.status == 'success' && data.type == 'mini_cart_data' && data.html){

		                    $('.mini-cart-content').html( data.html );
		                    $('#shadow-layer, .add-to-cart-loader').hide();
		                    $( "#cart-html").load(window.location.href + " #cart-html");

		                    if($('.show-mini-cart').length>0){
		                      $('.show-mini-cart').off('click').on('click', function(e){
		                        e.preventDefault();
		                        e.stopPropagation();

		                        $('#list_popover').fadeToggle();
		                        return false;
		                      });
		                    }
		                    swal({
					          text: 'Product has been added to cart.',
					          type: 'success',
					          timer: 2000,
					          showCancelButton: false,
					          showConfirmButton: false
					        });
					        
		                    $('#list_popover').fadeIn();
		                    $("html, body").animate({ scrollTop: 0 }, "slow");
		                    return false;
		                  }
		                },
		                error:function(){}
		            });
		          }
		        },
		        error:function(){}
		    });
		});

		$('.goStep1').on('click', function() {
			document.getElementById("step1").style.display = "flex";
			document.getElementById("step2").style.display = "none";
			document.getElementById("step3").style.display = "none";
			document.getElementById("step4").style.display = "none";
	    });
	    $('.goStep2').on('click', function() {
			document.getElementById("step1").style.display = "none";
			document.getElementById("step2").style.display = "flex";
			document.getElementById("step3").style.display = "none";
			document.getElementById("step4").style.display = "none";
	    });	    
	    $('.goStep3').on('click', function() {

			const countPC = $('.countLoopProductCart').val();
			for (let i = 0; i < countPC; i++) {

				if($('.shippingMethodOption'+i).val() === "0"){
					document.getElementById("alertShippingMethod"+i).style.display = "block";
					setTimeout(function() {
					  document.getElementById("alertShippingMethod"+i).style.display = "none"
					}, 2000);
				} else{
					document.getElementById("step1").style.display = "none";
					document.getElementById("step2").style.display = "none";
					document.getElementById("step3").style.display = "flex";
					document.getElementById("step4").style.display = "none";
				}

			}

	    });
	    $('.goStep4').on('click', function() {
			document.getElementById("step1").style.display = "none";
			document.getElementById("step2").style.display = "none";
			document.getElementById("step3").style.display = "none";
			document.getElementById("step4").style.display = "flex";
	    });

	    $('.show-alert-auth').on('click', function() {
			document.getElementById("alertAuth").style.display = "block";
			setTimeout(function() {
			  document.getElementById("alertAuth").style.display = "none"
			}, 3000);
	    });

	    $('.show-alert-address').on('click', function() {
			document.getElementById("alertAddress").style.display = "block";
			setTimeout(function() {
			  document.getElementById("alertAddress").style.display = "none"
			}, 3000);
	    });

	    $('.courier-dropdown').on('click', function(e){
		    e.preventDefault();
		    const dataObj = {};
		    
		    dataObj['id_store'] = $(this).data('id_store');
		   	
		   	// console.log(dataObj);
		    
		    $.ajax({
		        url: $('#base_url').val() + '/ajax/select-courier-to-shipping',
		        type: 'POST',
		        cache: false,
		        datatype: 'json',
		        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
		        data: dataObj,
		        beforeSend: function(){
			        // Show image container
			        $('.courier-shipping-html'+dataObj['id_store']).html('<div class="list-group position-absolute text-center w-100" style="z-index: 1"><a href="#" class="list-group-item list-group-item-action"><img src="assets/frontend/img/ajax-loader.gif" width="100px" /></a></div>');
			      },
		        success: function(data){
		        	// console.log(data);
					$('.courier-shipping-html'+dataObj['id_store']).html( data );
					// $('select').niceSelect();					
		        },
		        error:function(){}
		    });
		});

	    // let switchStatus = false;
		$("#customSwitch1").on('change', function() {
		    if ($(this).is(':checked')) {
		        // switchStatus = $(this).is(':checked');
		        // alert(switchStatus);// To verify
		        let totalstep3 = parseInt($('#input-grandTotal-step3').val()) - parseInt($('#bean-points-value').val());
		        if(totalstep3 <= 0){
		        	document.getElementById('grandTotal-step3').innerHTML = 'Rp. 0';
		        	document.getElementById('used-beans-points').innerHTML = rupiah($('#input-grandTotal-step3').val(), 'Rp ');
		        	document.getElementById('used-beans-points-value').value = $('#input-grandTotal-step3').val();
		        	document.getElementById('beans-points-remaining').innerHTML = rupiah(parseInt($('#bean-points-value').val()) - parseInt($('#input-grandTotal-step3').val()) , 'Rp ');
		        }else{
		        	document.getElementById('grandTotal-step3').innerHTML = rupiah(parseInt($('#input-grandTotal-step3').val()) - parseInt($('#bean-points-value').val()) , 'Rp ');
			        document.getElementById('used-beans-points').innerHTML = rupiah($('#bean-points-value').val() , 'Rp ');
			        document.getElementById('used-beans-points-value').value = $('#bean-points-value').val();
			        document.getElementById('beans-points-remaining').innerHTML = rupiah(0 , 'Rp ');
		        }
		    }
		    else {
		       // switchStatus = $(this).is(':checked');
		       // alert(switchStatus);// To verify
		       document.getElementById('grandTotal-step3').innerHTML = rupiah(parseInt($('#input-grandTotal-step3').val()) , 'Rp ');
		       document.getElementById('used-beans-points').innerHTML = rupiah(0 , 'Rp ');
		       document.getElementById('used-beans-points-value').value = 0;
		       document.getElementById('beans-points-remaining').innerHTML = rupiah($('#bean-points-value').val() , 'Rp ');
		    }
		});

		/*inc-qty-item*/
		$('.inc-qty-items').on('click', function() {
			const id_products = $(this).data('id_products');
			const id_store = $(this).data('id_store');
			const product_price = $(this).data('product_price');
			const product_weight = $(this).data('product_weight');
			if ($("#itemsQty_1_" + id_products).val() < $(this).data("stock_item_max")) {
				/*inc qty product */
				$("#itemsQty_1_" + id_products).val(parseInt($("#itemsQty_1_" + id_products).val())+1);
      			document.getElementById("itemsQty_2_" + id_products).innerHTML = $("#itemsQty_1_" + id_products).val();
      			/*inc total harga product per quantity*/
      			document.getElementById('total_harga_page_1_wihtout_rupiah_' + id_products).value = parseInt(document.getElementById('total_harga_page_1_wihtout_rupiah_' + id_products).value)+parseInt(product_price);
      			document.getElementById('total_harga_page_1_' + id_products).innerHTML = rupiah(document.getElementById('total_harga_page_1_wihtout_rupiah_' + id_products).value, 'Rp ');
      			document.getElementById('total_harga_page_2_wihtout_rupiah_' + id_products).value = parseInt(document.getElementById('total_harga_page_2_wihtout_rupiah_' + id_products).value)+parseInt(product_price);
      			document.getElementById('total_harga_page_2_' + id_products).innerHTML = rupiah(document.getElementById('total_harga_page_2_wihtout_rupiah_' + id_products).value, 'Rp ');
      			/*inc total weight product per quantity*/
      			document.getElementById('total_weight_page_1_' + id_products).value = parseInt(document.getElementById('total_weight_page_1_' + id_products).value)+parseInt(product_weight);
      			document.getElementById('total_weight_page_1_format_' + id_products).innerHTML = '@ ' + document.getElementById('total_weight_page_1_' + id_products).value + ' gr';
      			document.getElementById('total_weight_page_2_' + id_products).value = parseInt(document.getElementById('total_weight_page_2_' + id_products).value)+parseInt(product_weight);
      			document.getElementById('total_weight_page_2_format_' + id_products).innerHTML = document.getElementById('total_weight_page_2_' + id_products).value + ' gr';

      			/*inc total harga product dari salah satu toko*/
      			$(".old_pSubtotal" + id_store).val(parseInt($(".old_pSubtotal" + id_store).val())+parseInt(product_price));
      			document.getElementById('pSubtotal' + id_store).innerHTML = rupiah($(".old_pSubtotal" + id_store).val(), 'Rp ');
      			if(typeof $("#shippingMethodCost" + id_store).val() === 'undefined'){
      				$(".old_pSubtotal_per_store" + id_store).val(parseInt($(".old_pSubtotal" + id_store).val()));
  					document.getElementById('pSubtotal_per_store' + id_store).innerHTML = rupiah($(".old_pSubtotal_per_store" + id_store).val(), 'Rp ');
      			}else{
      				$(".old_pSubtotal_per_store" + id_store).val(parseInt($(".old_pSubtotal" + id_store).val()) + parseInt($("#shippingMethodCost" + id_store).val()));
  					document.getElementById('pSubtotal_per_store' + id_store).innerHTML = rupiah($(".old_pSubtotal_per_store" + id_store).val(), 'Rp ');
      			}      			

      			/*inc total qty product dari salah satu toko*/
      			document.getElementById('total_itemsQty_2_' + id_store).innerHTML = parseInt(document.getElementById('total_itemsQty_2_' + id_store).innerHTML)+1;
      			/*inc cart total dari semua toko*/
				let array_old_subtotal = document.querySelectorAll('#old_pSubtotal');
				let total_array_old_subtotal = 0;
				for(let i=0; i<array_old_subtotal.length; i++){
					if(parseInt(array_old_subtotal[i].value)){
					total_array_old_subtotal += parseInt(array_old_subtotal[i].value);
					}
				}
      			document.getElementById('cart_subtotal_page_1_wihtout_rupiah').value = total_array_old_subtotal;
      			document.getElementById('cart_subtotal_page_1').innerHTML = rupiah(document.getElementById('cart_subtotal_page_1_wihtout_rupiah').value, 'Rp ');
      			document.getElementById('cart_subtotal_page_2').innerHTML = rupiah(total_array_old_subtotal, 'Rp '); 
      			document.getElementById('cart_subtotal_page_3').innerHTML = rupiah(total_array_old_subtotal, 'Rp '); 

				document.getElementById('grandTotal-step2').innerHTML = rupiah(parseInt($('#cart_subtotal_page_1_wihtout_rupiah').val()) + parseInt($('#totalShippingCost').val()) + parseInt($('.pUniqueCode').val()) , 'Rp ');

				if ($("#customSwitch1").is(':checked')) {
					document.getElementById('input-grandTotal-step3').value = (parseInt($('#cart_subtotal_page_1_wihtout_rupiah').val()) + parseInt($('#totalShippingCost').val()) + parseInt($('.pUniqueCode').val()) - parseInt($('#bean-points-value').val()) );
					document.getElementById('grandTotal-step3').innerHTML = rupiah(document.getElementById('input-grandTotal-step3').value , 'Rp ');
				}
				else {
					document.getElementById('input-grandTotal-step3').value = parseInt($('#cart_subtotal_page_1_wihtout_rupiah').val()) + parseInt($('#totalShippingCost').val()) + parseInt($('.pUniqueCode').val());
					document.getElementById('grandTotal-step3').innerHTML = rupiah(document.getElementById('input-grandTotal-step3').value , 'Rp ');        
				}			
			}
	    });
		/*dec-qty-item*/
	    $('.dec-qty-items').on('click', function() {
			const id_products = $(this).data('id_products');
			const id_store = $(this).data('id_store');
			const product_price = $(this).data('product_price');
			const product_weight = $(this).data('product_weight');
			if ($("#itemsQty_1_" + id_products).val() > $(this).data("stock_item_min")) {
				/*dec qty product */
				$("#itemsQty_1_" + id_products).val(parseInt($("#itemsQty_1_" + id_products).val())-1);
				document.getElementById("itemsQty_2_" + id_products).innerHTML = $("#itemsQty_1_" + id_products).val();
				/*dec total harga product per quantity*/
      			document.getElementById('total_harga_page_1_wihtout_rupiah_' + id_products).value = parseInt(document.getElementById('total_harga_page_1_wihtout_rupiah_' + id_products).value)-parseInt(product_price);
      			document.getElementById('total_harga_page_1_' + id_products).innerHTML = rupiah(document.getElementById('total_harga_page_1_wihtout_rupiah_' + id_products).value, 'Rp ');
      			document.getElementById('total_harga_page_2_wihtout_rupiah_' + id_products).value = parseInt(document.getElementById('total_harga_page_2_wihtout_rupiah_' + id_products).value)-parseInt(product_price);
      			document.getElementById('total_harga_page_2_' + id_products).innerHTML = rupiah(document.getElementById('total_harga_page_2_wihtout_rupiah_' + id_products).value, 'Rp ');
      			/*dec total weight product per quantity*/
      			document.getElementById('total_weight_page_1_' + id_products).value = parseInt(document.getElementById('total_weight_page_1_' + id_products).value)-parseInt(product_weight);
      			document.getElementById('total_weight_page_1_format_' + id_products).innerHTML = '@ ' + document.getElementById('total_weight_page_1_' + id_products).value + ' gr';
      			document.getElementById('total_weight_page_2_' + id_products).value = parseInt(document.getElementById('total_weight_page_2_' + id_products).value)-parseInt(product_weight);
      			document.getElementById('total_weight_page_2_format_' + id_products).innerHTML = document.getElementById('total_weight_page_2_' + id_products).value + ' gr';

      			/*dec total harga product dari salah satu toko*/
      			$(".old_pSubtotal" + id_store).val(parseInt($(".old_pSubtotal" + id_store).val())-parseInt(product_price));
      			document.getElementById('pSubtotal' + id_store).innerHTML = rupiah($(".old_pSubtotal" + id_store).val(), 'Rp ');
      			if(typeof $("#shippingMethodCost" + id_store).val() === 'undefined'){
      				$(".old_pSubtotal_per_store" + id_store).val(parseInt($(".old_pSubtotal" + id_store).val()));
  					document.getElementById('pSubtotal_per_store' + id_store).innerHTML = rupiah($(".old_pSubtotal_per_store" + id_store).val(), 'Rp ');
      			}else{
      				$(".old_pSubtotal_per_store" + id_store).val(parseInt($(".old_pSubtotal" + id_store).val()) + parseInt($("#shippingMethodCost" + id_store).val()));
  					document.getElementById('pSubtotal_per_store' + id_store).innerHTML = rupiah($(".old_pSubtotal_per_store" + id_store).val(), 'Rp ');
      			}

				/*dec total qty product dari salah satu toko*/
				document.getElementById('total_itemsQty_2_' + id_store).innerHTML = parseInt(document.getElementById('total_itemsQty_2_' + id_store).innerHTML)-1;
				/*dec cart total dari semua toko*/
				let array_old_subtotal = document.querySelectorAll('#old_pSubtotal');
				let total_array_old_subtotal = 0;
				for(let i=0; i<array_old_subtotal.length; i++){
					if(parseInt(array_old_subtotal[i].value)){
					total_array_old_subtotal += parseInt(array_old_subtotal[i].value);
					}
				}
      			document.getElementById('cart_subtotal_page_1_wihtout_rupiah').value = total_array_old_subtotal;
      			document.getElementById('cart_subtotal_page_1').innerHTML = rupiah(document.getElementById('cart_subtotal_page_1_wihtout_rupiah').value, 'Rp ');
      			document.getElementById('cart_subtotal_page_2').innerHTML = rupiah(total_array_old_subtotal, 'Rp ');
      			document.getElementById('cart_subtotal_page_3').innerHTML = rupiah(total_array_old_subtotal, 'Rp ');

				document.getElementById('grandTotal-step2').innerHTML = rupiah(parseInt($('#cart_subtotal_page_1_wihtout_rupiah').val()) + parseInt($('#totalShippingCost').val()) + parseInt($('.pUniqueCode').val()) , 'Rp ');
				if ($("#customSwitch1").is(':checked')) {
					document.getElementById('input-grandTotal-step3').value = (parseInt($('#cart_subtotal_page_1_wihtout_rupiah').val()) + parseInt($('#totalShippingCost').val()) + parseInt($('.pUniqueCode').val()) - parseInt($('#bean-points-value').val()) );
					document.getElementById('grandTotal-step3').innerHTML = rupiah(document.getElementById('input-grandTotal-step3').value , 'Rp ');
				}
				else {
					document.getElementById('input-grandTotal-step3').value = parseInt($('#cart_subtotal_page_1_wihtout_rupiah').val()) + parseInt($('#totalShippingCost').val()) + parseInt($('.pUniqueCode').val());
					document.getElementById('grandTotal-step3').innerHTML = rupiah(document.getElementById('input-grandTotal-step3').value , 'Rp ');        
				}
      			
			}
	    });

	    $('.item-input-notes').on('input', function(){
	    	const id_products = $(this).data('id_products');
	    	document.getElementById('notes-product-' + id_products).innerHTML = document.getElementById('item-input-notes-' + id_products).value;
		});

	    $('#alert-apply-coupon').on('click', function(){
	    	swal({
	          text: 'Coupons cannot be used for multiple stores',
	          type: 'warning',
	          timer: 2000,
	          showCancelButton: false,
	          showConfirmButton: false
	        });
		});
	});
	$(document).ready(function(){
	  $('#list_popover').hide();
	  if($('.show-mini-cart').length>0){
	    $('.show-mini-cart').off('click').on('click', function(e){
	      e.preventDefault();
	      e.stopPropagation();
	      
	      $('#list_popover').fadeToggle();
	      return false;
	    });
	  }
	});

	function rupiah(angka, prefix){

		var reverse = angka.toString().split('').reverse().join(''),
		  ribuan  = reverse.match(/\d{1,3}/g);
		  ribuan  = ribuan.join('.').split('').reverse().join('');

		return prefix == undefined ? ribuan : (ribuan ? 'Rp. ' + ribuan : '');
	}