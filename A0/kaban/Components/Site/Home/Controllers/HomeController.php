<?php


namespace Kaban\Components\Site\Home\Controllers;


use Illuminate\Http\Request;
use Kaban\Core\Controllers\SiteBaseController;

class HomeController extends SiteBaseController {
    public function index() {
        return view( 'SiteHome::bizland' );
    }


    public function contact(Request $request) {
//        dd($request->all());
        $details = [

            'title' => 'Mail from ItSolutionStuff.com',

            'body' => 'This is for testing email using smtp'

        ];



//    Mail::raw('hello!')->
        \Mail::to(config('mail.from.address'))->send(new \App\Mail\TestMail($details));

//    to('mmhp16@gmail.com')->;
        //\Artisan::call("migrate");
        dd($request->all());
        return view( 'SiteHome::bizland' );
    }
}
