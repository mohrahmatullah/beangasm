<?php

namespace Modules\Frontend\Http\Controllers\Blog;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $data['product_category'] = getProductCategory();
        $data['blogs'] = $this->getBlog();
        // $arr = get_defined_vars();
        // dd($arr);
        return view('frontend::dekstop.blog.index', $data);
    }

    public function details( $slug )
    {
        $data = $this->getBlog($slug);
        // $arr = get_defined_vars();
        // dd($arr);
        return view('frontend::dekstop.blog.details', $data);
    }

    public function getBlog( $slug = null)
    {
        if($slug){
            $data['product_category'] = getProductCategory();
            $data['blogs'] = DB::table('posts')->where(['post_type' => 'post-blog', 'post_status' => 1, 'post_slug' => $slug])->orderBy('posts.updated_at', 'DESC')
                ->leftjoin('post_extras as a','a.post_id','posts.id')
                ->where('a.key_name','_featured_image')
                ->select('posts.post_title','posts.post_slug','posts.post_content','posts.updated_at','a.key_value as featured_image')
                ->first();
            $data['latest_blogs'] = DB::table('posts')->where(['post_type' => 'post-blog', 'post_status' => 1])->where('post_slug', '!=', $slug)->orderBy('posts.updated_at', 'desc')
                ->leftjoin('post_extras as a','a.post_id','posts.id')
                ->where('a.key_name','_featured_image')
                ->select('posts.post_title','posts.post_slug','posts.post_content','posts.updated_at','a.key_value as featured_image')->take(3)->get()->toArray();
            $data['latest_items'] =      DB::table('products')
                 ->select('products.*')
                 ->join(DB::raw("(SELECT product_id FROM product_extras WHERE key_name = '_product_enable_as_latest' AND key_value = 'yes') T1") , 'products.id', '=', 'T1.product_id')
                 ->where('products.delete_status','0')
                 ->where('products.status','1')
                 ->orderBy('products.stock_availability','ASC')
                 ->orderBy('products.updated_at','DESC')
                 ->take(4)
                 ->get()
                 ->toArray();
        }else{
            $data = DB::table('posts')->where(['post_type' => 'post-blog', 'post_status' => 1])->orderBy('posts.updated_at', 'DESC')
                ->leftjoin('post_extras as a','a.post_id','posts.id')
                ->where('a.key_name','_featured_image')
                ->select('posts.post_title','posts.post_slug','posts.post_content','posts.updated_at','a.key_value as featured_image')
                ->paginate(6);
        }
        return $data;
    }

}
