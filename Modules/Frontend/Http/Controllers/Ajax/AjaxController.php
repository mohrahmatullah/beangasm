<?php

namespace Modules\Frontend\Http\Controllers\Ajax;

use Request;
use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Anam\Phpcart\Cart;
use Modules\Frontend\Http\Controllers\Cart\CartController;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public $cart;
    public $controlcart;

    public function __construct() {
        $this->cart         =  new Cart();
        $this->controlcart     =  new CartController();
    }

    public function productAddToCart()
    {
        if(Request::isMethod('post') && Request::ajax() && Session::token() == Request::header('X-CSRF-TOKEN')){
          $input = Request::all();         
          $this->controlcart->add_to_cart($input['product_id'], $input['qty']);
        }
    }

    public function getMiniCartData(){
        if(Request::isMethod('post') && Request::ajax() && Session::token() == Request::header('X-CSRF-TOKEN')){
          $returnHTML = view('frontend::dekstop.checkout.cart.mini-cart-html')->render();
         
          return response()->json(array('status' => 'success', 'type' => 'mini_cart_data', 'html'=> $returnHTML));
        }
    }

    public function getCourierShipping(){
      if(Request::isMethod('post') && Request::ajax() && Session::token() == Request::header('X-CSRF-TOKEN')){
        $input = Request::all();
        $data['product_category'] = getProductCategory();
        $data['id_store'] = $input['id_store'];
        $get = get_store_details($input['id_store']);
        $data['store_details'] = json_decode($get->details);
        if(Session::get('beangasm_frontend_buyer_id')){
            $get_data_by_user_id = get_buyer_account_details_by_user_id(Session::get('beangasm_frontend_buyer_id'));
            $get_array_shift_data    =  array_shift($get_data_by_user_id);
            $data['login_user_account_data'] =  json_decode($get_array_shift_data['details']);
        }
        // dd($data);
        return view('frontend::dekstop.checkout.select-courier-shipping-html', $data);        
      }        
    }

    public function getSearchSuggestion(){
        $data = Request::all();
        $agent = new Agent();
        if ($agent->isMobile()) {
            if(isset($data['keyword'])){
              $cari = $data['keyword'];

              $product = DB::table('products')      
              ->where('title', 'LIKE', '%'.$cari.'%')
              ->where(['status' => 1])
              ->where('stock_qty','!=',0)
              ->where('delete_status','!=',1)
              ->select('title','slug')->get();

              $store = DB::table('users')      
              ->where('users.display_name', 'LIKE', '%'.$cari.'%')
              ->where(['users.user_status' => 1])
              ->leftjoin('role_user','role_user.user_id','users.id')
              ->where('role_user.role_id','3')
              ->select('users.display_name','users.name')->get();

              return view('frontend::mobile.includes.search-content', compact('product','store', 'cari'));
            }
            else{
              return response()->json(array('error_no_entered' => FALSE));
            }
        }else{
            if(isset($data['keyword'])){
                $cari = $data['keyword'];

                $product = DB::table('products')      
                ->where('title', 'LIKE', '%'.$cari.'%')
                ->where(['status' => 1])
                ->where('stock_qty','!=',0)
                ->where('delete_status','!=',1)
                ->select('title','slug')->get();

                $store = DB::table('users')      
                ->where('users.display_name', 'LIKE', '%'.$cari.'%')
                ->where(['users.user_status' => 1])
                ->leftjoin('role_user','role_user.user_id','users.id')
                ->where('role_user.role_id','3')
                ->select('users.display_name','users.name')->get();
                // $arr = get_defined_vars();
                // dd($arr);
                return view('frontend::dekstop.includes.search-content', compact('product','store', 'cari'));
            }
            else{
                return response()->json(array('error_no_entered' => FALSE));
            }
        }
    }

    public function getSearchStoreSuggestion(){
        $data = Request::all();
        $agent = new Agent();
        if ($agent->isMobile()) {
            if(isset($data['keyword'])){
              $cari = $data['keyword'];

              $store = DB::table('users')      
              ->where('users.display_name', 'LIKE', '%'.$cari.'%')
              ->where(['users.user_status' => 1])
              ->leftjoin('role_user','role_user.user_id','users.id')
              ->where('role_user.role_id','3')
              ->select('users.display_name','users.name')->get();

              return view('frontend::mobile.store.search-content', compact('store', 'cari'));
            }
            else{
              return response()->json(array('error_no_entered' => FALSE));
            }
        }else{
            if(isset($data['keyword'])){
                $cari = $data['keyword'];

                $store = DB::table('users')      
                ->where('users.display_name', 'LIKE', '%'.$cari.'%')
                ->where(['users.user_status' => 1])
                ->leftjoin('role_user','role_user.user_id','users.id')
                ->where('role_user.role_id','3')
                ->select('users.display_name','users.name')->get();

                return view('frontend::dekstop.store.search-content', compact('store', 'cari'));
            }
            else{
                return response()->json(array('error_no_entered' => FALSE));
            }
        }
    }
}
