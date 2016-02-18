<?php

namespace Hlacos\LaraMvcms\Http\Middlewares;

use Illuminate\Support\Facades\Auth;
use Closure;
use Hlacos\LaraMvcms\Models\Permission;

class HasPermission
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $permissionName)
    {
        $permission = Permission::where('name', $permissionName)->first();
        if (!Auth::admin()->user()->hasPermission($permission)) {
            abort(403);
        }

        return $next($request);
    }

}
