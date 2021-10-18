<?php

namespace Kaban\Components\General\Agent\Controllers;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kaban\Models\Agent;
use Illuminate\Support\Facades\Hash;

class AgentsLoginController
{
    use AuthenticatesUsers;

    public function agentLoginPage()
    {
        return view('GeneralAgent::agentLogin');
    }

    public function agentLoginAttempt(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $lastUrl = \auth()->guard('agentGuard')->user()->lastUrl;
//dd($lastUrl);
            if ($lastUrl) {
                $nextLink = config('general.CP_URL') . '?' . http_build_query([
                        'Param1' => $lastUrl->idHash,
                        'Param2' => $lastUrl->fromHash,
                        'Param3' => $lastUrl->toHash,
                    ]);
//                dd($nextLink);
                return redirect($nextLink);
            }
            return redirect(config('general.AGENT_PROFILE_PAGE'));

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function agentLogoutAttempt ()
    {
        auth()->guard('agentGuard')->logout();

        return redirect('/');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    protected function guard()
    {
        return Auth::guard('agentGuard');
    }

}
