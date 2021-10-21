<?php

namespace Kaban\Core\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Kaban\General\Enums\EAdminRank;

class SuperAdmin {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     *
     * @return mixed
     */
    public function handle( $request, Closure $next, $guard = null ) {
        if ( $admin = Auth::guard( 'adminGuard' )->user() ) {
                if($admin->rank < EAdminRank::superAdmin){
                    return redirect( config('general.ADMIN_DASHBOARD_PAGE'));
                }
        }

        return $next( $request );
    }
}
