<?php

namespace Modules\Frontend\Http\Controllers\Checkout;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Steevenz\Rajaongkir;
use Session;
use Anam\Phpcart\Cart;
use Illuminate\Support\Facades\DB;
use Modules\Frontend\Entities\Post;
use Modules\Frontend\Entities\PostExtra;
use Modules\Frontend\Entities\VendorOrder;
use Modules\Frontend\Entities\OrdersItem;
use Jenssegers\Agent\Agent;

class CheckoutController extends Controller
{
    public $rajaongkir;
    public $cart;

    public function __construct() {
        $this->rajaongkir = new Rajaongkir('a0079286b01e3b6d68ddfb09f4239698', Rajaongkir::ACCOUNT_PRO);
        $this->cart                 =  new Cart();
    }

    public function checkoutPageContent()
    {
      $agent = new Agent();
      if ($agent->isMobile()) {
        $data['product_category'] = getProductCategory();
        $data['product_cart'] = _group_by($this->cart->getItems(),'store_id');
        if(!Session::has('beangasm_frontend_buyer_id')){
            $data['is_buyer_login'] = false;
        }
        if(Session::has('beangasm_frontend_buyer_id')){
            $data['is_buyer_login'] = true;
            $get_data_by_user_id = get_buyer_account_details_by_user_id(Session::get('beangasm_frontend_buyer_id'));
            $get_array_shift_data    =  array_shift($get_data_by_user_id);
            $data['login_user_account_data'] =  json_decode($get_array_shift_data['details']);
        }
        
        $data['unique_code'] = rand(10,200);
        $data['login_user_account_info'] = get_current_frontend_user_info();
        if(!isset($data['login_user_account_info']['total_points'])){
          $data['login_user_account_info']['total_points'] = '0';
        }

        return view('frontend::mobile.checkout.checkout', $data);
      }else{
        // $shippingOption = $this->rajaongkir->getCost(['city' => 152], ['city' => 300], 500, 'jne');
        // $rt = array(
        //           'code' => 'Pick Up at Two Coffee Beans',
        //           'name' => 'Pick Up at Two Coffee Beans',
        //           'costs' => array([
        //                         'service' => '',
        //                         'description' => 'Pick Up at Two Coffee Beans',
        //                         'cost' => array([
        //                                     'value' => 0,
        //                                     'etd'   => '',
        //                                     'note'  => ''
        //                                   ])
        //                       ])
        //       );
        $data['product_category'] = getProductCategory();
        $data['product_cart'] = _group_by($this->cart->getItems(),'store_id');
        if(!Session::has('beangasm_frontend_buyer_id')){
            $data['is_buyer_login'] = false;
        }
        if(Session::has('beangasm_frontend_buyer_id')){
            $data['is_buyer_login'] = true;
            $get_data_by_user_id = get_buyer_account_details_by_user_id(Session::get('beangasm_frontend_buyer_id'));
            $get_array_shift_data    =  array_shift($get_data_by_user_id);
            $data['login_user_account_data'] =  json_decode($get_array_shift_data['details']);
        }
        
        $data['unique_code'] = rand(10,200);
        $data['login_user_account_info'] = get_current_frontend_user_info();
        if(!isset($data['login_user_account_info']['total_points'])){
          $data['login_user_account_info']['total_points'] = '0';
        }
        // $array = array('apple', 'orange', 'strawberry', 'blueberry', 'kiwi');
        // // unset($array);
        // $ro = json_encode(ar($array));
        // $arr = get_defined_vars();
        // dump($arr);
        return view('frontend::dekstop.checkout.checkout', $data);
      }
        
    }

    public function doCheckoutProcess( Request $request){
        $data = $request->all();

        // if(Session::get('checkout_post_details')){
        //     Session::forget('checkout_post_details');
        //     // Session::put('checkout_post_details', json_encode($this->checkoutData));
        // }
        // else{
        //     // Session::put('checkout_post_details', json_encode($this->checkoutData));
        // }
        if($data['payment_option'] === 'bacs'){
            $order = $this->save_checkout_data( $data );
            // $arr = get_defined_vars(); dd($order['order_id']);
            return \Redirect::route('frontend-order-received', array('order_id' => $order['order_id'], 'order_key' => $order['process_id']));
        }elseif($data['payment_option'] === 'others'){
            $order = $this->save_checkout_data();
            return \Redirect::route('frontend-order-payment', array('order_id' => $order_id['order_id']));
        }

    }

    public function save_checkout_data( $data ){
      // $arr = get_defined_vars();
      // dd($arr);
        $post           =     new Post;                
        $postMeta       =     new PostExtra;
        $request        =     new Request;
        $orderItems     =     new OrdersItem;

        $checkout_details;

        $shipping_address = get_shipping_address_by_user_id(Session::get('beangasm_frontend_buyer_id'));
        if(isset($shipping_address)){
          $account_shipping_title = $shipping_address->account_shipping_title;
          $account_shipping_company_name = $shipping_address->account_shipping_company_name;
          $account_shipping_receiver_name = $shipping_address->account_shipping_receiver_name;
          $account_shipping_email_address = $shipping_address->account_shipping_email_address;
          $account_shipping_phone_number = $shipping_address->account_shipping_phone_number;
          $account_shipping_adddress_line_1 = $shipping_address->account_shipping_adddress_line_1;
          $account_shipping_adddress_line_2 = $shipping_address->account_shipping_adddress_line_2;
          $account_shipping_select_country = $shipping_address->account_shipping_select_country;
          $account_shipping_province_id = $shipping_address->account_shipping_province_id;
          $account_shipping_province = $shipping_address->account_shipping_province;
          $account_shipping_town_or_city_id = $shipping_address->account_shipping_town_or_city_id;
          $account_shipping_town_or_city = $shipping_address->account_shipping_town_or_city;
          $account_shipping_subdistrict = $shipping_address->account_shipping_subdistrict;
          $account_shipping_urban_village = $shipping_address->account_shipping_urban_village;
          $account_shipping_zip_or_postal_code = $shipping_address->account_shipping_zip_or_postal_code;
          $account_shipping_fax_number = $shipping_address->account_shipping_fax_number;
        }

        $shipping_address_data                = array(
                                                  'account_shipping_title' => $account_shipping_title,
                                                  'account_shipping_company_name' => $account_shipping_company_name,
                                                  'account_shipping_receiver_name' => $account_shipping_receiver_name,
                                                  'account_shipping_email_address' => $account_shipping_email_address,
                                                  'account_shipping_phone_number' => $account_shipping_phone_number,
                                                  'account_shipping_adddress_line_1' => $account_shipping_adddress_line_1,
                                                  'account_shipping_adddress_line_2' => $account_shipping_adddress_line_2,
                                                  'account_shipping_select_country' => $account_shipping_select_country,
                                                  'account_shipping_province_id' => $account_shipping_province_id,
                                                  'account_shipping_province' => $account_shipping_province,
                                                  'account_shipping_town_or_city_id' => $account_shipping_town_or_city_id,
                                                  'account_shipping_town_or_city' => $account_shipping_town_or_city,
                                                  'account_shipping_subdistrict' => $account_shipping_subdistrict,
                                                  'account_shipping_urban_village' => $account_shipping_urban_village,
                                                  'account_shipping_zip_or_postal_code' => $account_shipping_zip_or_postal_code,
                                                  'account_shipping_fax_number' => $account_shipping_fax_number
                                                );        

        $post->post_author_id         =   Session::get('beangasm_frontend_buyer_id');
        $post->post_content           =   'Customer Shop Order';
        $post->post_title             =   'shop order';
        $post->post_slug              =   'shop-order';  
        $post->parent_id              =   0;
        $post->post_status            =   1;
        $post->post_type              =   'shop_order';
        $order_expired_date = date('Y-m-d H:i:s', strtotime($post->created_at . ' +6 hour'));
        $order_process_key = time().mt_rand().rand();

        if($post->save()){
            // $order_array = array(
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_currency',
            //                     'key_value'     =>  get_frontend_selected_currency(),
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_customer_ip_address',
            //                     'key_value'     =>  $request->ip(),
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_customer_user_agent',
            //                     'key_value'     =>  $request->header('User-Agent'),
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_customer_user',
            //                     'key_value'     =>  serialize('login'),
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_customer_shipping_address',
            //                     'key_value'     =>  serialize($shipping_address_data),
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_customer_email',
            //                     'key_value'     =>  $data['shipping_user_email'],
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_store_email',
            //                     'key_value'     =>  '',
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_expired_date',
            //                     'key_value'     =>  $order_expired_date,
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_shipping_method',
            //                     'key_value'     =>  '',
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_shipping_service',
            //                     'key_value'     =>  '',
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_shipping_service_description',
            //                     'key_value'     =>  '',
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_shipping_etd',
            //                     'key_value'     =>  '',
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_shipping_cost',
            //                     'key_value'     =>  '',
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_final_order_shipping_cost',
            //                     'key_value'     =>  $data['totalShippingCost'],
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_payment_method',
            //                     'key_value'     =>  $data['payment_option'],
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_payment_method_title',
            //                     'key_value'     =>  $data['payment_option'],
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_tax',
            //                     'key_value'     =>  '',
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_final_order_tax',
            //                     'key_value'     =>  '',
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_total',
            //                     'key_value'     =>  $data['final_subtotal'],
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),      
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_unique_code',
            //                     'key_value'     =>  $data['final_unique_code'],
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_bean_points_used',
            //                     'key_value'     =>  $data['bean_points_used'],
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_final_order_total',
            //                     'key_value'     =>  $data['grandTotal'],
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             /*      
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_notes',
            //                     'key_value'     =>  $checkout_details->order_note,
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             */
            //              array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_status',
            //                     'key_value'     =>  'pending-payment',
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             /* 
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_discount',
            //                     'key_value'     =>  $discount,
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_final_order_discount',
            //                     'key_value'     =>  get_product_price_html_by_filter($discount),
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),

            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_coupon_code',
            //                     'key_value'     =>  $discount_code,
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   ),
            //             */
            //             // array(
            //             //         'post_id'       =>  $post->id,
            //             //         'key_name'      =>  '_order_coupon_code',
            //             //         'key_value'     =>  $coupon_code,
            //             //         'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //             //         'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //             //       ),
            //             // array(
            //             //         'post_id'       =>  $post->id,
            //             //         'key_name'      =>  '_is_order_coupon_applyed',
            //             //         'key_value'     =>  $is_coupon_applyed,
            //             //         'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //             //         'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //             //       ),
            //             // array(
            //             //         'post_id'       =>  $post->id,
            //             //         'key_name'      =>  '_final_order_discount',
            //             //         'key_value'     =>  $final_discount,
            //             //         'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //             //         'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //             //       ),
            //             // array(
            //             //         'post_id'       =>  $post->id,
            //             //         'key_name'      =>  '_final_discount_shipping_cost',
            //             //         'key_value'     =>  $final_discount_shipping_cost,
            //             //         'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //             //         'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //             //       ),
            //             // array(
            //             //         'post_id'       =>  $post->id,
            //             //         'key_name'      =>  '_final_cashback_bean_points',
            //             //         'key_value'     =>  $final_cashback_bean_points,
            //             //         'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //             //         'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //             //       ),
            //             array(
            //                     'post_id'       =>  $post->id,
            //                     'key_name'      =>  '_order_process_key',
            //                     'key_value'     =>  $order_process_key,
            //                     'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
            //                     'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
            //                   )    
            // );
            // PostExtra::insert($order_array);

            // $get_items = $this->cart->getItems()->toArray();
            // foreach ($get_items as $itemss) {
            //     $itemss->quantity = $data['cart_quantity'][$itemss->id];
            //     $itemss->weight = $data['total_weight_per_product'][$itemss->id];
            //     $itemss->total_weight = $data['total_weight_per_product'][$itemss->id];
            //     $itemss->price = $data['total_harga_per_product'][$itemss->id];
            //     $itemss->order_price = $data['total_harga_per_product'][$itemss->id];
            //     $itemss->total_price = $data['total_harga_per_product'][$itemss->id];
            //     $itemss->order_notes = $data['order_notes'][$itemss->id];
            // }
            // $orderItems->order_id         =   $post->id;
            // $orderItems->order_data       =   json_encode( $get_items );
            // $orderItems->save();
            $product_cart = _group_by($this->cart->getItems(),'store_id');
            foreach ($product_cart as $group_id_store => $value) {
                $data_post_subs = array(
                    'post_author_id' => Session::get('beangasm_frontend_buyer_id'),
                    'post_content' => 'Customer Shop Order',
                    'post_title' => 'shop order',
                    'post_slug' => 'shop-order',
                    'parent_id' => $post->id,
                    'post_status' => 1,
                    'post_type' => 'shop_order'
                );
                $post_subs = Post::create($data_post_subs);        
                
                // $order_array_sub = array(
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_order_currency',
                //                 'key_value'     =>  get_frontend_selected_currency(),
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_customer_ip_address',
                //                 'key_value'     =>  $request->ip(),
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_customer_user_agent',
                //                 'key_value'     =>  $request->header('User-Agent'),
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_customer_user',
                //                 'key_value'     =>  serialize('login'),
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_customer_shipping_address',
                //                 'key_value'     =>  serialize($shipping_address_data),
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_customer_email',
                //                 'key_value'     =>  $data['shipping_user_email'],
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_store_email',
                //                 'key_value'     =>  get_email($group_id_store),
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_order_expired_date',
                //                 'key_value'     =>  $order_expired_date,
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_order_shipping_method',
                //                 'key_value'     =>  $data['shipping_method_courier'][$group_id_store],
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_order_shipping_service',
                //                 'key_value'     =>  $data['shipping_method_service'][$group_id_store],
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_order_shipping_service_description',
                //                 'key_value'     =>  $data['shipping_method_service_description'][$group_id_store],
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_order_shipping_etd',
                //                 'key_value'     =>  $data['shipping_method_etd'][$group_id_store],
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_order_shipping_cost',
                //                 'key_value'     =>  $data['shipping_method_cost'][$group_id_store],
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_final_order_shipping_cost',
                //                 'key_value'     =>  $data['shipping_method_cost'][$group_id_store],
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_payment_method',
                //                 'key_value'     =>  $data['payment_option'],
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_payment_method_title',
                //                 'key_value'     =>  $data['payment_option'],
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_order_tax',
                //                 'key_value'     =>  '',
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_final_order_tax',
                //                 'key_value'     =>  '',
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_order_total',
                //                 'key_value'     =>  $data['order_total'][$group_id_store],
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),      
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_unique_code',
                //                 'key_value'     =>  '',
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_bean_points_used',
                //                 'key_value'     =>  '',
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_final_order_total',
                //                 'key_value'     =>  $data['final_order_total_per_store'][$group_id_store],
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         /*      
                //         array(
                //                 'post_id'       =>  $post->id,
                //                 'key_name'      =>  '_order_notes',
                //                 'key_value'     =>  $checkout_details->order_note,
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         */
                //          array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_order_status',
                //                 'key_value'     =>  'pending-payment',
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         /* 
                //         array(
                //                 'post_id'       =>  $post->id,
                //                 'key_name'      =>  '_order_discount',
                //                 'key_value'     =>  $discount,
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         array(
                //                 'post_id'       =>  $post->id,
                //                 'key_name'      =>  '_final_order_discount',
                //                 'key_value'     =>  get_product_price_html_by_filter($discount),
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),

                //         array(
                //                 'post_id'       =>  $post->id,
                //                 'key_name'      =>  '_order_coupon_code',
                //                 'key_value'     =>  $discount_code,
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               ),
                //         */
                //         // array(
                //         //         'post_id'       =>  $post->id,
                //         //         'key_name'      =>  '_order_coupon_code',
                //         //         'key_value'     =>  $coupon_code,
                //         //         'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //         //         'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //         //       ),
                //         // array(
                //         //         'post_id'       =>  $post->id,
                //         //         'key_name'      =>  '_is_order_coupon_applyed',
                //         //         'key_value'     =>  $is_coupon_applyed,
                //         //         'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //         //         'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //         //       ),
                //         // array(
                //         //         'post_id'       =>  $post->id,
                //         //         'key_name'      =>  '_final_order_discount',
                //         //         'key_value'     =>  $final_discount,
                //         //         'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //         //         'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //         //       ),
                //         // array(
                //         //         'post_id'       =>  $post->id,
                //         //         'key_name'      =>  '_final_discount_shipping_cost',
                //         //         'key_value'     =>  $final_discount_shipping_cost,
                //         //         'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //         //         'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //         //       ),
                //         // array(
                //         //         'post_id'       =>  $post->id,
                //         //         'key_name'      =>  '_final_cashback_bean_points',
                //         //         'key_value'     =>  $final_cashback_bean_points,
                //         //         'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //         //         'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //         //       ),
                //         array(
                //                 'post_id'       =>  $post_subs->id,
                //                 'key_name'      =>  '_order_process_key',
                //                 'key_value'     =>  $order_process_key,
                //                 'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                //                 'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                //               )    
                // );
                // PostExtra::insert($order_array_sub);

                // $get_package_details = get_package_details_by_vendor_id($group_id_store);
                // $data_vendor_orders = array(
                //     'order_id' => $post_subs->id,
                //     'vendor_id' => $group_id_store,
                //     'order_total' => $data['order_total'][$group_id_store],
                //     'net_amount' => ($get_package_details->vendor_commission / 100) * $data['order_total'][$group_id_store],
                //     'order_status' => 'pending-payment'
                // );
                // VendorOrder::create($data_vendor_orders);
                
                foreach($value as $itemss){
                  $itemss->quantity = $data['cart_quantity'][$itemss->id];
                  $itemss->weight = $data['total_weight_per_product'][$itemss->id];
                  $itemss->total_weight = $data['total_weight_per_product'][$itemss->id];
                  $itemss->price = $data['total_harga_per_product'][$itemss->id];
                  $itemss->order_price = $data['total_harga_per_product'][$itemss->id];
                  $itemss->total_price = $data['total_harga_per_product'][$itemss->id];
                  $itemss->order_notes = $data['order_notes'][$itemss->id]; 
                }

                $data_orders_item = array(
                    'order_id' => $post_subs->id,
                    'order_data' => json_encode( _group_by($value, 'id') )
                );
                // OrdersItem::create($data_orders_item);
            }            
            return array('order_id' => $post->id, 'process_id' => $order_process_key);
        }

      //   $arr = get_defined_vars();
      // dd($arr);
    }

    public function thankyouPageContent( $order_id, $order_key ){
        $data['product_category'] = getProductCategory();
        $data['order_id'] = $order_id;
        $data['order_key'] = $order_key;
        return view('frontend::dekstop.checkout.thank-you.thank-you-payment-bacs', $data);
    }

    public function getShippingOptionBySellerID($seller_id, $originCityID, $destinationCityID, $totalProductWeightGram){
        $shippingOption = array();
        $jne_only = array("18", "143", "37", "241", "383", "424", "716", "971", "1028", "1157", "1083", "1717", "748", "813", "2001");
        //Beangasm, Pop Crack Bang, Consignment, Gustavo Coffee Roastery, Common Grounds Coffee Roasters, Bloom Coffee Project, Monomania Coffee Roastery, People Temple.id, Moonshine, Missiburoaster, Coffeea Circulor, Robbery Coffee, Supreme Roastworks, Tumach Roastery

        $jnt_only = array("1122"); // Titik Temu Roastery

        $tiki_only = array("333"); // Toko Kopi Mantap

        $jne_and_jnt = array("412", "665", "1154"); //Andrew's Roastworks, Moksa Coffee, The Dancing Tongue Club
        
        $jne_and_tiki = array("348", "1978"); // 9 Cups Coffee, Hobb's Coffee Roaster

        $jne_jnt_sicepat = array("1578", "1975"); // Vins Coffee, Arcanist

        $jne_sicepat = array("1563", "1642", "1535"); // Dailio Roaster, Sky nine coffee, NARAKOPI

        if(in_array($seller_id, $jne_only)){
            $shippingOption = [$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne')];
        } else if(in_array($seller_id, $jne_and_jnt)){
            $shippingOption = [$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne'),$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jnt')];
        } else if(in_array($seller_id, $jne_and_tiki)){
            $shippingOption = [$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne'),$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'tiki')];
        } else if(in_array($seller_id, $jnt_only)){
            $shippingOption = [$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jnt')];
        } else if(in_array($seller_id, $tiki_only)){
            $shippingOption = [$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'tiki')];
        } else if(in_array($seller_id, $jne_jnt_sicepat)){
            $shippingOption = [$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne'),$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jnt'), $this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'sicepat')];
        } else if(in_array($seller_id, $jne_sicepat)){
            $shippingOption = [$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne'),$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'sicepat')];
        } else{
            $shippingOption = [$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne'),$this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jnt'), $this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'tiki'), $this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'pos'), $this->rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'sicepat')];
        }

        return $shippingOption;
    }
}
