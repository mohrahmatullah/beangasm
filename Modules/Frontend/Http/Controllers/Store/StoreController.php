<?php

namespace Modules\Frontend\Http\Controllers\Store;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Jenssegers\Agent\Agent;

class StoreController extends Controller
{

  public function index( Request $req )
  {
    $agent = new Agent();
    $input = $req->all();
    if ($agent->isMobile()) {
      $data['product_category'] = getProductCategory();
      $data['store'] = $this->getStore( $input );
      $data['input'] = $input;
      if($req->ajax()) {
        return view('layouts.mobile-view-load-more-list-store', $data);
      }
      // $arr = get_defined_vars();
      // dd($arr);
      return view('frontend::mobile.store.index', $data);
    }else{
      $data['product_category'] = getProductCategory();
      $data['store'] = $this->getStore( $input );
      $data['input'] = $input;
      // $arr = get_defined_vars();
      // dd($arr);
      return view('frontend::dekstop.store.index', $data);
    }
    
  }

  public function details( $author, Request $req )
  {    
    $agent = new Agent();
    if ($agent->isMobile()) {
      $input = $req->all();
      $data = $this->getStore(  $input, $author );
      if($req->ajax()) {
        return view('layouts.mobile-view-load-more-products', $data);
      }
      // $arr = get_defined_vars();
      // dd($arr);
      return view('frontend::mobile.store.details', $data);
    }else{
      $input = $req->all();
      $data = $this->getStore( $input, $author );
      // $arr = get_defined_vars();
      // dd($arr);
      return view('frontend::dekstop.store.details', $data);
    }    
  }

  public function getStore( $input = null, $author = null )
  {
  	if($author){
      $store['product_category'] = getProductCategory();
  		$store['store'] = DB::table('users')
            							->select('users.id','users.display_name','users.name','users.user_photo_url','role_user.created_at as member_since')
            							->leftjoin('role_user','role_user.user_id','users.id')
          	  						->where('users.name', $author )
	                        ->first();
      $store['input'] = $input;

      $all = (isset($input['sort']) && $input['sort'] == 'all' && !$input);
      $terbaru = (isset($input['sort']) && $input['sort'] == 'terbaru');
      $termahal = (isset($input['sort']) && $input['sort'] == 'termahal');
      $termurah = (isset($input['sort']) && $input['sort'] == 'termurah');

      $category = (isset($input['category']) ? $input['category'] : '');

  		$store['products'] = DB::table('products')
	  						           ->where('products.author_id', $store['store']->id )             
	                        ->where('products.delete_status','0')
	                        ->where('products.status','1')
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
                          ->where('terms.type', 'product_cat')
                          ->when($category, function($query, $category) {
                          return $query->where(['terms.slug' => $category, 'terms.type' => 'product_cat']);
                          })
	                        ->select('products.*')
	                        ->paginate(12);
  	}else{
      $search = isset($input['search']) ? $input['search'] : null;
  		$store = DB::table('users')
			  	->select('users.display_name','users.name','users.user_photo_url','users_details.details','role_user.created_at as member_since')
			  	->leftjoin('role_user','role_user.user_id','users.id')
			  	->leftjoin('users_details','users_details.user_id','users.id')
			  	->where('users_details.details','LIKE','%profile_details%')
			  	->where('users.user_status',1)
			  	->where('role_user.role_id',3)
          ->when($search, function($query, $search) {
            return $query->where('users.display_name', 'LIKE', '%'.$search.'%');
          })
			  	->groupby('users.id')
			  	->orderby('users.display_name', 'ASC')
			  	->paginate(36);
  	}  	

    return $store;
  }

}
