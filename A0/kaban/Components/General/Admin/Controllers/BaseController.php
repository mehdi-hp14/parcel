<?php

namespace Kaban\Components\General\Admin\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('adminGuard');
    }

    public function getAdmin()
    {
        dd(auth()->user()->toArray());
    }

}
