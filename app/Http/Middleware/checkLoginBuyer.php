<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class checkLoginBuyer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('beangasm_frontend_buyer_id')){
            return $next($request);
        }
    
        return redirect()->route('buyer-login');
    }
}
