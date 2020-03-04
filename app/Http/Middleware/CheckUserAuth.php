<?php

namespace App\Http\Middleware;

use App\Model\Wishlist;
use Closure;

class CheckUserAuth
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

        $wishlists = Wishlist::where('user_id', auth('user')->check() ? auth('user')->user()->id : 0)->count();
        view()->share(['wishlists' => $wishlists]);
        return $next($request);
    }
}
