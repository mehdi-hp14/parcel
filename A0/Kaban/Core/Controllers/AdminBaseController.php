<?php


namespace Kaban\Core\Controllers;


use App\Http\Controllers\Controller;

class AdminBaseController extends Controller {

    public function index() {
        return view( 'AdminBase::index' );
    }
}
