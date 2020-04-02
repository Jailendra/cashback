<?php

namespace App\Http\Middleware;

use Closure;

class checkSubscription
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
        if ($request->user() && ! $request->user()->stripe_id) {
            // This user is not a paying customer...
            return redirect('subscriptions')->with('message','You do\'t have any subscription plan yet!' );
        }
        return $next($request);
    }
}
