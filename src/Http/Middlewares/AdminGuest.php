<?php

namespace Hlacos\LaraMvcms\Http\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminGuest
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
        if (Auth::admin()->get()) {
            if ($request->ajax()) {
                return response('Authorized.', 403);
            } else {
                return redirect()->route('lara-mvcms.dashboard');
            }
        }

        return $next($request);
    }
}
