<?php


namespace Kaban\Components\Site\Home\Controllers;


use Illuminate\Http\Request;
use Kaban\Core\Controllers\SiteBaseController;

class HomeController extends SiteBaseController {
    public function index() {
        return view( 'SiteHome::bizland' );
    }
}
