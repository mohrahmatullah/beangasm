<?php

namespace Modules\Frontend\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Cookie;
use Modules\Frontend\Http\Traits\ProductsTrait;

class HomeController extends Controller
{

    use ProductsTrait;
    
    public function index( Request $req)
    {
        $agent = new Agent();
        if ($agent->isMobile()) {
            $data['product_category'] = getProductCategory();
            $data['features_items'] = $this->getFeatureProducts();
            $data['whats_new'] = $this->getWhatsNewProducts();
            $data['best_sales'] = $this->getBestSalesProducts();
            $data['products'] = $this->getRecomendedProducts();
            if($req->ajax()) {
              return view('layouts.mobile-view-load-more-products', $data);
            }
            // $arr = get_defined_vars();
            // dd($arr);
            return view('frontend::mobile.home.index', $data);
        }else{
            $data['product_category'] = getProductCategory();
            $data['features_items'] = $this->getFeatureProducts();
            $data['whats_new'] = $this->getWhatsNewProducts();
            $data['best_sales'] = $this->getBestSalesProducts();
            $data['products'] = $this->getRecomendedProducts();

            // $arr = get_defined_vars();
            // dd($arr);
            return view('frontend::dekstop.home.index', $data);
        }
        
    }

    public function login()
    {
        return view('frontend::mobile.auth.login');
    }
    public function signup()
    {
        return view('frontend::mobile.auth.signup');
    }

}
