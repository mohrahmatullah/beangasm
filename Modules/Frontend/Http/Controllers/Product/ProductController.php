<?php

namespace Modules\Frontend\Http\Controllers\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Cookie;
use Modules\Frontend\Http\Traits\ProductsTrait;

class ProductController extends Controller
{
    use ProductsTrait;
    public function index( Request $req)
    {
      $agent = new Agent();
      if ($agent->isMobile()) {
        $data['input'] = $req->all();        
        $data['product_category'] = getProductCategory();
        if(isset($data['input']['type'])){
          if($data['input']['type'] == 'featured'){
            $data['products'] = $this->getFeatureProducts($data['input']['type'], $data['input']);
          }elseif(($data['input']['type'] == 'best-sales')){
            $data['products'] = $this->getBestSalesProducts($data['input']['type'], $data['input']);
          }elseif(($data['input']['type'] == 'whats-new')){
            $data['products'] = $this->getWhatsNewProducts($data['input']['type'], $data['input']);
          }elseif(($data['input']['type'] == 'recomended-products')){
            $data['products'] = $this->getRecomendedProducts();
          }           
        }else{
          $data['products'] = $this->getProducts($data['input']);
          if(isset($data['input']['category'])){
            $data['sub_cat'] = $this->subCategories($data['input']);
          }
        }
        
        if($req->ajax()) {
          return view('layouts.mobile-view-load-more-products', $data);
        }
        // $arr = get_defined_vars();
        // dump($arr);
        return view('frontend::mobile.product.index', $data);
      }else{
        $data['input'] = $req->all();        
        $data['product_category'] = getProductCategory();
        if(isset($data['input']['type'])){
          if($data['input']['type'] == 'featured'){
            $data['products'] = $this->getFeatureProducts($data['input']['type'], $data['input']);
          }elseif(($data['input']['type'] == 'best-sales')){
            $data['products'] = $this->getBestSalesProducts($data['input']['type'], $data['input']);
          }elseif(($data['input']['type'] == 'whats-new')){
            $data['products'] = $this->getWhatsNewProducts($data['input']['type'], $data['input']);
          }elseif(($data['input']['type'] == 'recomended-products')){
            $data['products'] = $this->getRecomendedProducts();
          }          
        }else{
          $data['products'] = $this->getProducts($data['input']);
          if(isset($data['input']['category'])){
            $data['sub_cat'] = $this->subCategories($data['input']);
          }          
        }
        
        // $arr = get_defined_vars();
        // dd($arr);
        return view('frontend::dekstop.product.index', $data);
      }
        
    }

    public function details( $slug )
    {
      $agent = new Agent();
      if ($agent->isMobile()) {
          Cookie::queue('p_slg', $slug, 60);
          $data['product_category'] = getProductCategory();
          $get_product = DB::table('products')->where(['slug' => $slug, 'status' => 1, 'delete_status' => 0])->first();
          $data['single_product_details']  =  $this->getProductDataById( $get_product->id ); 
          $data['related_items']           =   $this->getRelatedItems( $get_product->id, $get_product->author_id );
          $data['category_by_item']        = $this->getCatItems( $get_product->id )['0']['name_category'];
          $data['comments_rating_details'] =  get_comments_rating_details( $get_product->id, 'product' );
          $get_stock_qty = DB::table('product_extras')->where(['product_id' => $get_product->id, 'key_name' => '_product_manage_stock_qty'])->first();           
          if(!empty($get_stock_qty)){                   
            $data['product_stock_qty'] = $get_stock_qty->key_value;
          } else{
            $data['product_stock_qty'] = $get_product->stock_qty;
          }
          $data['product_stock_availability'] = $get_product->stock_availability;
          // $data['arrar']           =   $this->getTagItems( $get_product->id);
          // $arr = get_defined_vars();
          // dd($arr);
          return view('frontend::mobile.product.details', $data);
      }else{
          Cookie::queue('p_slg', $slug, 60);
          $data['product_category'] = getProductCategory();
          $get_product = DB::table('products')->where(['slug' => $slug, 'status' => 1, 'delete_status' => 0])->first();
          $data['single_product_details']  =  $this->getProductDataById( $get_product->id ); 
          $data['related_items']           =   $this->getRelatedItems( $get_product->id, $get_product->author_id );
          $data['category_by_item']        = $this->getCatItems( $get_product->id )['0']['name_category'];
          $data['tag_by_item']        = $this->getTagItems( $get_product->id );
          $data['comments_rating_details'] =  get_comments_rating_details( $get_product->id, 'product' );
          $get_stock_qty = DB::table('product_extras')->where(['product_id' => $get_product->id, 'key_name' => '_product_manage_stock_qty'])->first();           
          if(!empty($get_stock_qty)){                   
            $data['product_stock_qty'] = $get_stock_qty->key_value;
          } else{
            $data['product_stock_qty'] = $get_product->stock_qty;
          }
          $data['product_stock_availability'] = $get_product->stock_availability;
          // $data['arrar']           =   $this->getTagItems( $get_product->id);
          // $arr = get_defined_vars();
          // dd($arr);
          return view('frontend::dekstop.product.details', $data);
      }
        
    }

}
