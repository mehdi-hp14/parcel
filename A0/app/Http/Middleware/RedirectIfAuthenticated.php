<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
        if (Auth::guard('agentGuard')->check()) {
            $lastUrl = Auth::guard('agentGuard')->user()->lastUrl;
            if($lastUrl){
                $nextLink = config('general.CP_URL').'?'.http_build_query([
                        'Param1'=>$lastUrl->idHash,
                        'Param2'=>$lastUrl->fromHash,
                        'Param3'=>$lastUrl->toHash,
                    ]);

                return redirect($nextLink);
            }
            return redirect(RouteServiceProvider::HOME);
        }

        if (Auth::guard('adminGuard')->check()) {
            return redirect(config('general.ADMIN_DASHBOARD_PAGE'));
        }

        return $next($request);

    }
}
