<?php

namespace Modules\Store\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.index', $data);
    }

    public function myOrder()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.myorder', $data);
    }

    public function myOrderDetail()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.myorder-detail', $data);
    }

    public function wishlist()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.wishlist', $data);
    }

    public function coupon()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.coupon', $data);
    }

    public function profile()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.profile', $data);
    }

    public function myproduct()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.myproduct', $data);
    }

    public function orders()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.orders', $data);
    }

    public function orderDetail()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.order-detail', $data);
    }

    public function withdraw()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.withdraw', $data);
    }

    public function reviews()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.reviews', $data);
    }

    public function notification()
    {
        $data['product_category'] = getProductCategory();
        return view('store::dekstop.dashboard.notification', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('store::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function upload()
    {
        return view('store::dekstop.dashboard.upload');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store( Request $request )
    {
        if($request->hasFile('profile_image')) {
             
            //get filename with extension
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();
     
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
     
            //get file extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();
     
            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
     
            //Upload File to external server
            Storage::disk('sftp')->put($filenametostore, fopen($request->file('profile_image'), 'r+'));
     
            //Store $filenametostore in the database
        }
        echo "Image uploaded successfully.";
    }

    public function delete()
    {
        Storage::disk('sftp')->delete('KO2_5f1fe1b3b97d1.jpeg');
        echo "Image delete successfully.";
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('store::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('store::edit');
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
