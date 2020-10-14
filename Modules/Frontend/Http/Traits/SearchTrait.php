<?php

namespace Modules\Frontend\Http\Traits;
use Illuminate\Support\Facades\DB;

trait SearchTrait {
    public function getSearchProducts($input = null)
    {
        $search = (isset($input['q']) ? $input['q'] : '');

        $price_min = (isset($input['price_min']) ? $input['price_min'] : '');
        $price_max = (isset($input['price_max']) ? $input['price_max'] : '');

        $acidity_min = (isset($input['acidity_min']) ? $input['acidity_min'] : '');
        $acidity_max = (isset($input['acidity_max']) ? $input['acidity_max'] : '');

        $sweetness_min = (isset($input['sweetness_min']) ? $input['sweetness_min'] : '');
        $sweetness_max = (isset($input['sweetness_max']) ? $input['sweetness_max'] : '');

        $body_min = (isset($input['body_min']) ? $input['body_min'] : '');
        $body_max = (isset($input['body_max']) ? $input['body_max'] : '');

        $all = (isset($input['sort']) && $input['sort'] == 'all' && !$input);
        $terbaru = (isset($input['sort']) && $input['sort'] == 'terbaru');
        $termahal = (isset($input['sort']) && $input['sort'] == 'termahal');
        $termurah = (isset($input['sort']) && $input['sort'] == 'termurah');

        $get_post_data = DB::table('products')               
                        ->where('products.delete_status','0')
                        ->where('products.status','1')                        
                        ->select('products.*')
                        ->when($search, function($query, $search) {
                        return $query->where('products.title', 'LIKE', '%'.$search.'%');
                        })
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
                        ->when($terbaru, function($query, $terbaru) {
                        return $query->orderBy('products.created_at', 'DESC');
                        })
                        ->when($termahal, function($query, $termahal) {
                        return $query->orderBy('products.price', 'DESC');
                        })
                        ->when($termurah, function($query, $termurah) {
                        return $query->orderBy('products.price', 'ASC');
                        })
                        ->paginate(12);

        return $get_post_data;
    }

    public function getSearchStore($input = null)
    {
        $search = (isset($input['q']) ? $input['q'] : '');
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
                ->paginate(36, ['*'], 'store');

        return $store;
    }
}