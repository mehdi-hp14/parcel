<?php

namespace Kaban\Components\General\Agent\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        auth()->setDefaultDriver('agentGuard');
    }

    public function getAgent()
    {
        dd(auth()->user()->toArray());
    }

}
