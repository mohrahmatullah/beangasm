<?php

namespace Modules\Frontend\Http\Controllers\Search;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Modules\Frontend\Http\Traits\SearchTrait;

class SearchController extends Controller
{
    use SearchTrait;
    public function index( Request $req )
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            $data['input'] = $req->all();
            if (Request::capture()->except('page') && Request::capture()->except('store') && isset($data['input']['q'])) {
                $data['product_category'] = getProductCategory();        
                $data['products'] = $this->getSearchProducts($data['input']);
                $data['store'] = $this->getSearchStore($data['input']);
                if($req->ajax() && isset($data['input']['store'])) {
                    return view('layouts.mobile-view-load-more-list-store-str', $data);
                }
                if($req->ajax() && isset($data['input']['page'])) {
                    return view('layouts.mobile-view-load-more-products', $data);                    
                }                

                return view('frontend::mobile.search.index', $data);
            }else{
                return redirect()->route('/');
            } 
        }else{
            $data['input'] = $req->all();
            if (Request::capture()->except('page') && isset($data['input']['q'])) {
                $data['product_category'] = getProductCategory();        
                $data['products'] = $this->getSearchProducts($data['input']);
                $data['store'] = $this->getSearchStore($data['input']);

                return view('frontend::dekstop.search.index', $data);
            }else{
                return redirect()->route('/');
            } 
        }
        
        
    }

}
