<?php

namespace Hlacos\LaraMvcms\Http\Middlewares;

use Closure;

class SetIsAdmin
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
        $request->isAdmin = true;

        return $next($request);
    }
}
