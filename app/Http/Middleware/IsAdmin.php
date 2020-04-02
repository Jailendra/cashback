<?php

/*
 * @Author: Jailendra Rajawat
 * @IsAdmin middleware
 * @Date:   2017-08-25
 * @Last Modified by:   Jailendra Rajawat
 * @Last Modified: 2017-08-30
 */

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class IsAdmin
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
        if(!empty(auth()->guard('admin')->id())){
            return $next($request);
        }else{
            return redirect('admin/login')->with('status', 'Please login from admin side!');
        }
        
    }
}
