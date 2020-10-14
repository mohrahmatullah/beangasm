<?php

namespace Modules\Frontend\Http\Controllers\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Anam\Phpcart\Cart;
use Cookie;
use App\Http\Controllers\OptionController;
use Modules\Frontend\Http\Traits\ProductsTrait;

class CartController extends Controller
{
    use ProductsTrait;
    public $cart;

    public function __construct() {
        $this->cart                 =  new Cart();
    }
    public function add_to_cart($product_id = 0, $qty = 1){
        //check this product vendor already in cart start
        $cart_vendor_id = null;
        $new_vendor_id  = null;
        
        if(!empty($this->cart->items())){
          foreach($this->cart->items() as $item){
            $cart_vendor_id = get_author_id_by_product_id( $item->product_id );
            break;
          }
        }
        
        // $new_vendor_id = get_author_id_by_product_id( $product_id );
        // if(!is_null($cart_vendor_id) && !is_null($new_vendor_id)){
        //   if($cart_vendor_id !== $new_vendor_id){
        //     echo 'vendor_not_same';
        //     die();
        //   }
        // }
        //check this product vendor already in cart end
        
        $_this = new self;
        $product_id   = intval( $product_id );
        $quantity     = intval( $qty );

        $product_data             =  array();
        $product_cart_line_data   =  array();
        
        if($product_id > 0){
          $product_data = $_this->get_product_data_by_product_id( $product_id );
        }
        
        if(count($product_data) > 0){
          $product_cart_line_data = $product_data;
        }
        
        if($quantity > 0){
          $product_cart_line_data['product_line_quantity'] = $quantity;
        }
        
        if( count($product_cart_line_data) >0 ){
          $_this->set_cart_data( $product_cart_line_data );
        }
    }
    public function set_cart_data( $cart_data = array() ){
        if( count($cart_data) > 0 ){      
          $price = 0;
          $options = array();
          $img_src = config('app.url').'/public/images/no-image.png';
          $stock_availability = false;
          $tax = false;
          $is_qty_available = true;
          
          $get_pricing  = $this->getPricing($cart_data); 
               
           if(!is_null($get_pricing)){
             $price = $get_pricing;
           }
           else{
             $price  = $cart_data['product_price'];
           }

           if($cart_data['product_image']){
             $img_src = $cart_data['product_image'];
           }
           
           if($cart_data['product_manage_stock_availability'] == 'in_stock'){
             $stock_availability = TRUE;
           }
           
           if($cart_data['product_enable_taxes'] == 'yes'){
             $tax = true;
           }
           
           if($cart_data['product_manage_stock'] == 'yes'){
             if($cart_data['product_manage_stock_qty'] == 0){
               $is_qty_available = false;
             }
             
             if(isset($this->cart->get($cart_data['id'])->quantity)){
               $cat_qty = $this->cart->get($cart_data['id'])->quantity + $cart_data['product_line_quantity'];
               
               if($cat_qty > $cart_data['product_manage_stock_qty']){
                 $is_qty_available = false;
               }
             }
           }

          if( !$stock_availability || !$is_qty_available){
            echo 'out_of_stock';
            die();
          }

          $product_id = 0;
          
          $product_id = $cart_data['id'];
          
          $total_price = $cart_data['product_line_quantity'] * $price;
          $total_weight = $cart_data['product_line_quantity'] * $cart_data['product_weight'];
          
          $this->cart->add([
            'id'            =>  $product_id,
            'product_id'    =>  $cart_data['id'],
            'store_id'      =>  $cart_data['author_id'],
            'name'          =>  $cart_data['post_title'],
            'quantity'      =>  $cart_data['product_line_quantity'],
            'weight'        =>  $cart_data['product_weight'],
            'total_weight'  =>  ($cart_data['product_line_quantity'] * $cart_data['product_weight']),
            'price'         =>  $price,
            'order_price'   =>  get_product_price_html_by_filter($price),
            'total_price'   =>  ($cart_data['product_line_quantity'] * $price),
            'img_src'       =>  $img_src,
            'options'       =>  $options,
            'tax'           =>  $tax,
            'product_type'  =>  get_product_type( $cart_data['id'] )
          ]);
          
          if($this->cart->count() > 0){ 
            echo 'item_added';
          }
        }
    }

    public function get_product_data_by_product_id( $product_id = 0 ){
        $_this = new self;
        $product_data = array();
        
        if($product_id>0){
          $get_data = $this->getProductDataById( $product_id );
           
          $product_data['id']                                =  $get_data['id'];
          $product_data['author_id']                         =  $get_data['author_id'];
          $product_data['post_title']                        =  $get_data['post_title'];
          $product_data['post_status']                       =  $get_data['post_status'];
          $product_data['post_type']                         =  $get_data['post_type'];
          $product_data['product_image']                     =  $get_data['post_image_url'];
          $product_data['product_type']                      =  $get_data['post_type'];
          $product_data['product_sku']                       =  $get_data['post_sku'];
          $product_data['product_price']                     =  $get_data['post_price'];
          $product_data['product_sale_price_start_date']     =  $get_data['_product_sale_price_start_date'];
          $product_data['product_sale_price_end_date']       =  $get_data['_product_sale_price_end_date'];
          $product_data['product_manage_stock']              =  $get_data['_product_manage_stock'];
          $product_data['product_weight']                    =  $get_data['post_weight'];
          $product_data['product_manage_stock_qty']          =  $get_data['post_stock_qty'];
          $product_data['product_manage_stock_availability'] =  $get_data['post_stock_availability'];
          $product_data['product_enable_as_custom_design']   =  $get_data['_product_enable_as_custom_design'];
          $product_data['product_enable_taxes']              =  $get_data['_product_enable_taxes'];
          $product_data['is_role_based_pricing_enable']      =  $get_data['_is_role_based_pricing_enable'];
          $product_data['role_based_pricing']                =  $get_data['_role_based_pricing'];
          
          return $product_data;
        }
    }

    function getPricing($data = array()){
        $price = null;
        
        if(count($data) > 0){
          $get_current_user_data  =  get_current_frontend_user_info();
          
          if(is_frontend_user_logged_in() && isset($get_current_user_data['user_role_slug']) && ($data['is_role_based_pricing_enable'] == 'yes' || $data['is_role_based_pricing_enable'] == 1)){
            if( isset($data['role_based_pricing'][$get_current_user_data['user_role_slug']]) ){
              $regular_price = $data['role_based_pricing'][$get_current_user_data['user_role_slug']]['regular_price'];
              $sale_price = $data['role_based_pricing'][$get_current_user_data['user_role_slug']]['sale_price'];
              
              if(isset($regular_price) && $regular_price && isset($sale_price) && $sale_price && $regular_price > $sale_price){
                $price = $sale_price;
              }
              elseif(isset($regular_price) && $regular_price){
                $price = $regular_price;
              }
            }
          }
        }
        
        return $price;
    }

    public function doActionForRemoveItem( $item_id ){
        if($item_id){
          if( $this->cart->remove( $item_id ) ){
            return redirect()->back();
          }
        }
    }
}
