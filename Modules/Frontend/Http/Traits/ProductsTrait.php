<?php

namespace Modules\Frontend\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Session;
use Illuminate\Support\Facades\Cookie;

trait ProductsTrait {
    public function getProducts($input = null)
    {
        $price_min = (isset($input['price_min']) ? $input['price_min'] : '');
        $price_max = (isset($input['price_max']) ? $input['price_max'] : '');

        $acidity_min = (isset($input['acidity_min']) ? $input['acidity_min'] : '');
        $acidity_max = (isset($input['acidity_max']) ? $input['acidity_max'] : '');

        $sweetness_min = (isset($input['sweetness_min']) ? $input['sweetness_min'] : '');
        $sweetness_max = (isset($input['sweetness_max']) ? $input['sweetness_max'] : '');

        $body_min = (isset($input['body_min']) ? $input['body_min'] : '');
        $body_max = (isset($input['body_max']) ? $input['body_max'] : '');

        // $category = (isset($input['category']) ? $input['category'] : '');
        // $sub_category = (isset($input['sub_category']) ? $input['sub_category'] : '');

        $all = (isset($input['sort']) && $input['sort'] == 'all' && !$input);
        $terbaru = (isset($input['sort']) && $input['sort'] == 'terbaru');
        $termahal = (isset($input['sort']) && $input['sort'] == 'termahal');
        $termurah = (isset($input['sort']) && $input['sort'] == 'termurah');

        $get_post_data = DB::table('products')               
                        ->where('products.delete_status','0')
                        ->where('products.status','1')                        
                        ->select('products.*','terms.slug as slugcategory')
                        ->when($price_min, function($query, $price_min) {
                        return $query->where('products.price', '>=', $price_min);
                        })
                        ->when($price_max, function($query, $price_max) {
                        return $query->where('products.price', '<=', $price_max);
                        })
                        ->when($acidity_min, function($query, $acidity_min) {
                        return $query->where('products.acidity', '>=', $acidity_min);
                        })
                        ->when($acidity_max, function($query, $acidity_max) {
                        return $query->where('products.acidity', '<=', $acidity_max);
                        })
                        ->when($sweetness_min, function($query, $sweetness_min) {
                        return $query->where('products.sweetness', '>=', $sweetness_min);
                        })
                        ->when($sweetness_max, function($query, $sweetness_max) {
                        return $query->where('products.sweetness', '<=', $sweetness_max);
                        })
                        ->when($body_min, function($query, $body_min) {
                        return $query->where('products.body', '>=', $body_min);
                        })
                        ->when($body_max, function($query, $body_max) {
                        return $query->where('products.body', '<=', $body_max);
                        })
                        ->when($all, function($query, $all) {
                        return $query->orderBy('products.stock_qty', 'DESC');
                        })
                        ->when($terbaru, function($query, $terbaru) {
                        return $query->orderBy('products.created_at', 'DESC');
                        })
                        ->when($termahal, function($query, $termahal) {
                        return $query->orderBy('products.price', 'DESC');
                        })
                        ->when($termurah, function($query, $termurah) {
                        return $query->orderBy('products.price', 'ASC');
                        })
                        ->leftjoin('object_relationships', 'object_relationships.object_id', 'products.id')
                        ->leftjoin('terms','terms.term_id','object_relationships.term_id')
                        // ->when($category, function($query, $category) {
                        // return $query->where(['terms.slug' => $category, 'terms.type' => 'product_cat']);
                        // })
                        ->where(function($query) use ($input) {
                          if(isset($input['category'])){
                            if(isset($input['sub_category'])) {
                              $query->where(['terms.term_id' => $input['sub_category'], 'terms.type' => 'product_cat']);
                            }else{
                              $query->where(['terms.slug' => $input['category'], 'terms.type' => 'product_cat']);
                            }
                          }
                        })
                        ->paginate(12);

        return $get_post_data;
    }

    public function getFeatureProducts($type = Null, $input = null){  
     if($type){
      $price_min = (isset($input['price_min']) ? $input['price_min'] : '');
      $price_max = (isset($input['price_max']) ? $input['price_max'] : '');

      $acidity_min = (isset($input['acidity_min']) ? $input['acidity_min'] : '');
      $acidity_max = (isset($input['acidity_max']) ? $input['acidity_max'] : '');

      $sweetness_min = (isset($input['sweetness_min']) ? $input['sweetness_min'] : '');
      $sweetness_max = (isset($input['sweetness_max']) ? $input['sweetness_max'] : '');

      $body_min = (isset($input['body_min']) ? $input['body_min'] : '');
      $body_max = (isset($input['body_max']) ? $input['body_max'] : '');

      $features_items =   DB::table('products')
                                   ->select('products.*')
                                   ->join(DB::raw("(SELECT product_id FROM product_extras WHERE key_name = '_product_enable_as_features' AND key_value = 'yes') T1") , 'products.id', '=', 'T1.product_id')
                                   ->where('products.delete_status','0')
                                   ->where('products.status','1')
                                   ->when($price_min, function($query, $price_min) {
                                    return $query->where('products.price', '>=', $price_min);
                                    })
                                    ->when($price_max, function($query, $price_max) {
                                    return $query->where('products.price', '<=', $price_max);
                                    })
                                    ->when($acidity_min, function($query, $acidity_min) {
                                    return $query->where('products.acidity', '>=', $acidity_min);
                                    })
                                    ->when($acidity_max, function($query, $acidity_max) {
                                    return $query->where('products.acidity', '<=', $acidity_max);
                                    })
                                    ->when($sweetness_min, function($query, $sweetness_min) {
                                    return $query->where('products.sweetness', '>=', $sweetness_min);
                                    })
                                    ->when($sweetness_max, function($query, $sweetness_max) {
                                    return $query->where('products.sweetness', '<=', $sweetness_max);
                                    })
                                    ->when($body_min, function($query, $body_min) {
                                    return $query->where('products.body', '>=', $body_min);
                                    })
                                    ->when($body_max, function($query, $body_max) {
                                    return $query->where('products.body', '<=', $body_max);
                                    })
                                   ->orderBy('products.stock_availability','ASC')
                                   ->orderBy('products.updated_at','DESC')
                                   ->paginate(12);
      }else{
        $features_items =   DB::table('products')
                                   ->select('products.*')
                                   ->join(DB::raw("(SELECT product_id FROM product_extras WHERE key_name = '_product_enable_as_features' AND key_value = 'yes') T1") , 'products.id', '=', 'T1.product_id')
                                   ->where('products.delete_status','0')
                                   ->where('products.status','1')
                                   ->orderBy('products.stock_availability','ASC')
                                   ->orderBy('products.updated_at','DESC')
                                   ->paginate(24, ['*'], 'featured');
      }  
        return $features_items;
    }

    public function getBestSalesProducts($type = null, $input = null){
        if($type){
          $price_min = (isset($input['price_min']) ? $input['price_min'] : '');
          $price_max = (isset($input['price_max']) ? $input['price_max'] : '');

          $acidity_min = (isset($input['acidity_min']) ? $input['acidity_min'] : '');
          $acidity_max = (isset($input['acidity_max']) ? $input['acidity_max'] : '');

          $sweetness_min = (isset($input['sweetness_min']) ? $input['sweetness_min'] : '');
          $sweetness_max = (isset($input['sweetness_max']) ? $input['sweetness_max'] : '');

          $body_min = (isset($input['body_min']) ? $input['body_min'] : '');
          $body_max = (isset($input['body_max']) ? $input['body_max'] : '');

          $get_best_sales = DB::table('product_extras')
                              ->select('products.*', 'product_id', DB::raw('max(cast(key_value as SIGNED INTEGER)) as max_number'))
                              ->where('key_name', '_total_sales')
                              ->join('products', 'product_extras.product_id', 'products.id')
                              ->where('products.delete_status','0')
                              ->where('products.status','1')
                              ->where('products.stock_qty', '>' ,'0')
                              ->when($price_min, function($query, $price_min) {
                              return $query->where('products.price', '>=', $price_min);
                              })
                              ->when($price_max, function($query, $price_max) {
                              return $query->where('products.price', '<=', $price_max);
                              })
                              ->when($acidity_min, function($query, $acidity_min) {
                              return $query->where('products.acidity', '>=', $acidity_min);
                              })
                              ->when($acidity_max, function($query, $acidity_max) {
                              return $query->where('products.acidity', '<=', $acidity_max);
                              })
                              ->when($sweetness_min, function($query, $sweetness_min) {
                              return $query->where('products.sweetness', '>=', $sweetness_min);
                              })
                              ->when($sweetness_max, function($query, $sweetness_max) {
                              return $query->where('products.sweetness', '<=', $sweetness_max);
                              })
                              ->when($body_min, function($query, $body_min) {
                              return $query->where('products.body', '>=', $body_min);
                              })
                              ->when($body_max, function($query, $body_max) {
                              return $query->where('products.body', '<=', $body_max);
                              })
                              ->groupBy('product_id')
                              ->orderBy('max_number', 'desc')
                              ->paginate(12);
        }else{
          $get_best_sales = DB::table('product_extras')
                              ->select('products.*', 'product_id', DB::raw('max(cast(key_value as SIGNED INTEGER)) as max_number'))
                              ->where('key_name', '_total_sales')
                              ->join('products', 'product_extras.product_id', 'products.id')
                              ->where('products.delete_status','0')
                              ->where('products.status','1')
                              ->where('products.stock_qty', '>' ,'0')
                              ->groupBy('product_id')
                              ->orderBy('max_number', 'desc')
                              ->take(4)
                              ->get();
        }
        return $get_best_sales;
    }

    public function getWhatsNewProducts($type = null, $input = null){
        if($type){
          $price_min = (isset($input['price_min']) ? $input['price_min'] : '');
          $price_max = (isset($input['price_max']) ? $input['price_max'] : '');

          $acidity_min = (isset($input['acidity_min']) ? $input['acidity_min'] : '');
          $acidity_max = (isset($input['acidity_max']) ? $input['acidity_max'] : '');

          $sweetness_min = (isset($input['sweetness_min']) ? $input['sweetness_min'] : '');
          $sweetness_max = (isset($input['sweetness_max']) ? $input['sweetness_max'] : '');

          $body_min = (isset($input['body_min']) ? $input['body_min'] : '');
          $body_max = (isset($input['body_max']) ? $input['body_max'] : '');

          $get_whats_new = DB::table('products')
                              ->select('products.*')
                              ->join('product_logs', 'product_logs.product_id', 'products.id')
                              ->where(['product_logs.user_id' => 1, 'product_logs.action' => 'update', 'product_logs.description' => 'update visibility to enable', 'products.status' => 1, 'products.delete_status' => 0])
                              ->where('products.stock_qty','!=',0)
                              ->when($price_min, function($query, $price_min) {
                              return $query->where('products.price', '>=', $price_min);
                              })
                              ->when($price_max, function($query, $price_max) {
                              return $query->where('products.price', '<=', $price_max);
                              })
                              ->when($acidity_min, function($query, $acidity_min) {
                              return $query->where('products.acidity', '>=', $acidity_min);
                              })
                              ->when($acidity_max, function($query, $acidity_max) {
                              return $query->where('products.acidity', '<=', $acidity_max);
                              })
                              ->when($sweetness_min, function($query, $sweetness_min) {
                              return $query->where('products.sweetness', '>=', $sweetness_min);
                              })
                              ->when($sweetness_max, function($query, $sweetness_max) {
                              return $query->where('products.sweetness', '<=', $sweetness_max);
                              })
                              ->when($body_min, function($query, $body_min) {
                              return $query->where('products.body', '>=', $body_min);
                              })
                              ->when($body_max, function($query, $body_max) {
                              return $query->where('products.body', '<=', $body_max);
                              })
                              ->groupBy('product_logs.product_id')
                              ->paginate(12);
        }else{
          $get_whats_new  = DB::table('products')
                              ->select('products.*')
                              ->join('product_logs', 'product_logs.product_id', 'products.id')
                              ->where(['product_logs.user_id' => 1, 'product_logs.action' => 'update', 'product_logs.description' => 'update visibility to enable', 'products.status' => 1, 'products.delete_status' => 0])
                              ->where('products.stock_qty','>',0)
                              ->groupBy('product_logs.product_id')
                              ->take(24)
                              ->get();
        }
        return $get_whats_new;
    }

    public function getRecomendedProducts(){
      if(Session::has('beangasm_frontend_buyer_id')){
        $products = DB::table('posts')
                        ->where('posts.post_author_id',Session::get('beangasm_frontend_buyer_id'))
                        ->where('posts.post_type','shop_order')
                        ->orderBy('posts.created_at', 'DESC')
                        ->leftjoin('orders_items','orders_items.order_id','posts.id')
                        ->select('orders_items.order_data','orders_items.order_id')
                        ->get();
        if(count($products) > 0){
          $merge_p = $this->productBySession($products);
          $get_post_data = $this->paginate($merge_p, 18);
        }else{
          if(Cookie::has('p_slg')){
            $merge_p = $this->cokkieProductBySlug();
            $get_post_data = $this->paginate($merge_p, 18);
          }else{
            $get_post_data = $this->getProducts();
          }
        }
        
      }elseif(Cookie::get('p_slg')){
    		$merge_p = $this->cokkieProductBySlug();
        $get_post_data = $this->paginate($merge_p, 18);
      }elseif(!Cookie::get('p_slg') && !Session::has('beangasm_frontend_buyer_id')){
      	$get_post_data = $this->getProducts();
      }     
      
      return $get_post_data;
    }

    public function getRelatedItems( $product_id, $author_id )
    {
        $get_product = DB::table('products')
        ->where('products.id', '!=', $product_id)
        ->where(['products.status' => 1, 'products.delete_status' => 0, 'products.author_id' => $author_id])
        ->orderBy('products.updated_at', 'DESC')
        // ->leftjoin('object_relationships','object_relationships.object_id','products.id')
        // ->whereIn('object_relationships.term_id', [6,35,41,67,81,142,143] )
        // ->whereIn('object_relationships.term_id', $this->getTagItems( $product_id ) )  
        ->take(4)     
        ->get();


        return $get_product;
    }

    public function getTagItems( $product_id )
    {
        $selected = array();
        $selected_tag = DB::table('object_relationships')
                      ->where('object_relationships.object_id', $product_id)
                      ->leftjoin('terms','terms.term_id', 'object_relationships.term_id')
                      ->where(['terms.type' => 'product_tag', 'terms.status' => 1])
                      ->select('terms.term_id','terms.name')        
                      ->get();
        if(count($selected_tag) > 0){
            $tag_id = array();
            foreach($selected_tag as $s)
            {      
                $data = $s->term_id;
              array_push($tag_id, $data);
            }
            $selected = $tag_id;
        }
        return $selected;        
    }

    public function getCatItems( $product_id )
    {
        $selected = array();
        $selected_cat = DB::table('object_relationships')
                      ->where('object_relationships.object_id', $product_id)
                      ->leftjoin('terms','terms.term_id', 'object_relationships.term_id')
                      ->where(['terms.type' => 'product_cat', 'terms.status' => 1])
                      ->select('terms.term_id','terms.name')        
                      ->first();
        $data['id_category'] = $selected_cat->term_id;
        $data['name_category'] = $selected_cat->name;
        array_push($selected, $data);

        return $selected;        
    }

    public function CatItems( $product_id )
    {
        $selected = array();
        $selected_cat = DB::table('object_relationships')
                      ->where('object_relationships.object_id', $product_id)
                      ->leftjoin('terms','terms.term_id', 'object_relationships.term_id')
                      ->where(['terms.type' => 'product_cat', 'terms.status' => 1])
                      ->select('terms.term_id')        
                      ->first();
        $data = $selected_cat->term_id;
        array_push($selected, $data);

        return $selected;        
    }

    public function paginate($items, $perPage, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => \Request::url(),
            'query' => \Request::query()
        ]);
    }

    function getPaginator($items, $request, $paginate)
    {
        $total = count($items); // total count of the set, this is necessary so the paginator will know the total pages to display
        $page = $request->page ? $request->page : 1; // get current page from the request, first page is null
        $perPage = $paginate; // how many items you want to display per page?
        $offset = ($page - 1) * $perPage; // get the offset, how many items need to be "skipped" on this page

        $items = array_slice($items, $offset, $perPage); // the array that we actually pass to the paginator is sliced

        return new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query()
        ]);
    }

    public function getProductDataById( $product_id ){
        $post_array       =   array();
        $get_post         =   DB::table('products')->where('id', $product_id)->first();
        $get_post_meta    =   DB::table('product_extras')->where('product_id', $product_id)->get();
        
        if(!empty($get_post)){
          $post_array['id']                       =  $get_post->id;
          $post_array['author_id']                =  $get_post->author_id;
          $post_array['post_content']             =  $get_post->content;
          $post_array['post_title']               =  $get_post->title;
          $post_array['post_slug']                =  $get_post->slug;
          $post_array['post_status']              =  $get_post->status;
          $post_array['post_sku']                 =  $get_post->sku;
          $post_array['post_regular_price']       =  $get_post->regular_price;
          $post_array['post_sale_price']          =  $get_post->sale_price;
          $post_array['post_price']               =  $get_post->price;
          $post_array['post_weight']              =  $get_post->weight;
          $post_array['post_acidity']             =  $get_post->acidity;
          $post_array['post_sweetness']           =  $get_post->sweetness;
          $post_array['post_body']                =  $get_post->body;
          $post_array['post_stock_qty']           =  $get_post->stock_qty;
          $post_array['post_stock_availability']  =  $get_post->stock_availability;
          $post_array['post_type']                =  $get_post->type;
          $post_array['post_image_url']           =  $get_post->image_url;
          $post_array['post_delete_status']       =  $get_post->delete_status;

          if(!empty($get_post_meta)){
            foreach($get_post_meta as $val){
              if($val->key_name == '_product_related_images_url'){
                $post_array[$val->key_name] = json_decode($val->key_value);
                $post_array['product_related_img_json'] = $val->key_value;
              }
              elseif($val->key_name == '_product_custom_designer_panel_size' || $val->key_name == '_product_video_feature_panel_size' ||  $val->key_name == '_product_selected_categories' || $val->key_name == '_product_selected_tags'){
                $post_array[$val->key_name] = unserialize($val->key_value);  
              }
              elseif($val->key_name == '_product_custom_designer_data'){
                $post_array[$val->key_name] = json_decode($val->key_value);
                $post_array['product_custom_designer_json'] = $val->key_value;
              }
              elseif($val->key_name == '_product_custom_designer_settings'){
                $post_array[$val->key_name] = unserialize($val->key_value);
              }
              elseif($val->key_name == '_product_compare_data' || $val->key_name == '_product_color_filter_data'){
                $post_array[$val->key_name] = unserialize($val->key_value);
              }
              elseif($val->key_name == '_role_based_pricing'){
                $post_array[$val->key_name] = unserialize($val->key_value);
              }
              elseif($val->key_name == '_downloadable_product_files'){
                $post_array[$val->key_name] = unserialize($val->key_value);
              }
              else{
                $post_array[$val->key_name] = $val->key_value;  
              }
            }
          }
        }
        
        return $post_array;
    }

    public function subCategories( $input ){
      $category = DB::table('terms')->where(['slug' => $input['category'] ])->select('term_id')->first();
      $sub_category = DB::table('terms')->where(['parent' => $category->term_id])->get();
      return $sub_category;
    }

    public function productBySession( $products ){
      foreach ($products as $key) {
        $data_products[] = json_decode($key->order_data);
      }
      foreach ($data_products as $key => $value) {
        foreach ($value as $p) {
          $data_post[] = $p;
        }
      }
      foreach ($data_post as $value) {
        $prd[] = DB::table('products')               
                  ->where('id',$value->id)               
                  ->where('delete_status','0')
                  ->where('status','1')                        
                  ->select('products.*')
                  ->first();
      }
      $filter_p = array_filter($prd); /*Memfilter array yang bukan null*/
      $at_p = array_slice($filter_p, 0, 1); /*Membatasi dengan 1 array*/
      $limit_p = array_slice($filter_p, 0, 1);
      $shipt_p = array_shift($limit_p); /*Menghilangkan nilai awal array*/
      $item_by_tag = DB::table('products')               
                  ->where('products.delete_status','0')
                  ->where('products.status','1') 
                  ->where('products.id','!=', $shipt_p->id)                       
                  ->select('products.*')
                  ->leftjoin('object_relationships', 'object_relationships.object_id', 'products.id')
                  ->wherein('object_relationships.term_id', $this->getTagItems($shipt_p->id))
                  ->take(18)
                  ->get()->toArray();
      $item_by_cat = DB::table('products')               
                  ->where('products.delete_status','0')
                  ->where('products.status','1') 
                  ->where('products.id','!=', $shipt_p->id)                       
                  ->select('products.*')
                  ->leftjoin('object_relationships', 'object_relationships.object_id', 'products.id')
                  ->wherein('object_relationships.term_id', $this->CatItems($shipt_p->id))
                  ->take(17)
                  ->get()->toArray();

      $merge_p = array_merge((array)$at_p, (array)$item_by_tag, (array)$item_by_cat);

      return $merge_p;
    }

    public function cokkieProductBySlug(){
      $cookie = DB::table('products')               
                  ->where('products.delete_status','0')
                  ->where('products.status','1')                        
                  ->select('products.*')
                  ->where('products.slug', 'LIKE', '%'.Cookie::get('p_slg').'%')
                  ->first();
      $array_cookie = array($cookie);
      $item_by_tag = DB::table('products')               
                  ->where('products.delete_status','0')
                  ->where('products.status','1') 
                  ->where('products.id','!=', $cookie->id)                       
                  ->select('products.*')
                  ->leftjoin('object_relationships', 'object_relationships.object_id', 'products.id')
                  ->wherein('object_relationships.term_id', $this->getTagItems($cookie->id))
                  ->take(18)
                  ->get()->toArray();
      $item_by_cat = DB::table('products')               
                  ->where('products.delete_status','0')
                  ->where('products.status','1') 
                  ->where('products.id','!=', $cookie->id)                       
                  ->select('products.*')
                  ->leftjoin('object_relationships', 'object_relationships.object_id', 'products.id')
                  ->wherein('object_relationships.term_id', $this->CatItems($cookie->id))
                  ->take(17)
                  ->get()->toArray();

      $merge_p = array_merge((array)$array_cookie, (array)$item_by_tag, (array)$item_by_cat);

      return $merge_p;
    }
}