<?php


namespace Kaban\Core\Controllers;


use App\Http\Controllers\Controller;

class SiteBaseController extends Controller {

    public function index() {
        return view( 'SiteBase::index' );
    }
}
