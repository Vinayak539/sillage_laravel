<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->intended('/adhni753');
                }
                break;

            case 'user':
                if (Auth::guard($guard)->check()) {
                    return redirect()->intended('/myaccount');
                }
                break;

            default:
                return redirect()->intended('/');
                break;
        }

        return $next($request);
    }
}
