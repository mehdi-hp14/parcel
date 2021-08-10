<?php

namespace Kaban\Core\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kaban\Core\Services\ACL;
use Kaban\Models\Agency;

class Authorize
{
    /**
     * Authorize constructor.
     */
    public function __construct()
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param ACL $ACL
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $route = $request->route();


        /** @var ACL $ACL */
        $ACL = app(ACL::class);

        $routeName = $route->getName();
        if (!$ACL->canSee($routeName)) {
            //dd($routeName);
            $panelName = \Auth::user()->role->panel;
            \Flash::error(trans('admin.acl.users.not_authorized_to', ['route' => $routeName]));
            return redirect($panelName);
        }


        return $next($request);
    }
}
