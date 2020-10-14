<?php

namespace Modules\Buyer\Http\Controllers\Dashboard;

use Carbon\Carbon;

use Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Frontend\Entities\Post;
use Modules\Frontend\Entities\PostExtra;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public $carbonObject;

    public function __construct(){ 
        $this->carbonObject         =  new Carbon();
    }

    public function index()
    {
        // $data = array();

        $data['login_user_details'] =  get_current_frontend_user_info();
        $data['product_category'] = getProductCategory();
        // $data['dashboard_data'] =  $dashboard_total;
        return view('buyer::dekstop.dashboard.index', $data);
    }

    public function wishlist()
    {
        $data['product_category'] = getProductCategory();
        $data['login_user_details'] =  get_current_frontend_user_info();
        return view('buyer::dekstop.dashboard.wishlist', $data);
    }

    public function coupon()
    {
        $data['product_category'] = getProductCategory();
        $data['login_user_details'] =  get_current_frontend_user_info();
        return view('buyer::dekstop.dashboard.coupon', $data);
    }

    public function profile()
    {
        $data['product_category'] = getProductCategory();
        $data['login_user_details'] =  get_current_frontend_user_info();
        return view('buyer::dekstop.dashboard.profile', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('buyer::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('buyer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('buyer::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
