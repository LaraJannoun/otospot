<?php

namespace App\Http\Middleware;
use App\Http\Controllers\Controller;

use Closure;
use Auth;

class SetAdminAsDefaultGuard extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard('admin')->check()){
            // Set Default Guard for Admin
            Auth::shouldUse('admin');
        }
        return $next($request);
    }
}