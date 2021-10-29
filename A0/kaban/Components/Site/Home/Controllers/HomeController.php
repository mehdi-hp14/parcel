<?php


namespace Kaban\Components\Site\Home\Controllers;


use App\Mail\Contact;
use Illuminate\Http\Request;
use Kaban\Core\Controllers\SiteBaseController;

class HomeController extends SiteBaseController {
    public function index() {
        return view( 'SiteHome::bizland' );
    }

    public function contact(Request $request) {
        $request->validate([
            'name'=>'required',
            'subject'=>'required',
            'message'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'g-recaptcha-response' => 'recaptcha',
        ]);
        $req = $request->only(['name','email','subject','message']);

        \Mail::to(config('mail.from.address'))->send(new Contact($req));

        return response()->json(['msg'=>'successfully sent','status'=>'ok']);
    }
}
