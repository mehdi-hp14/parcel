<?php

use Kaban\Components\General\Auth\Controllers\AgentResetPasswordController;
use Kaban\Components\General\Agent\Controllers\BaseController;
use Kaban\Components\General\Auth\Controllers\AgentsLoginController;
use Kaban\Components\General\Auth\Controllers\ForgotPasswordController;

$segments = [ 'site'];
foreach ( $segments as $segment ) {
    foreach ( scandir( __DIR__ . '/' . $segment ) as $file ) {
        if ( $file != '.' && $file != '..' ) {
            require_once( __DIR__ . '/' . $segment . '/' . $file );
        }
    }
}

Auth::routes();

Route::get( '/x', function () {
//    return \Illuminate\Support\Facades\Redirect::route('agentLoginPage');
//    return redirect(route('agentLoginPage'));

    echo phpinfo();
} )->name( 'home2' );

Route::get( '/home', 'HomeController@index' )->name( 'home' );

Route::group(['prefix'=>'agents'],function (){

});


//dummy
Route::get( '/roles', 'PermissionController@Permission' );

Route::get( '/users-list', 'HomeController@usersList' )->name( 'usersList' );

Route::get( '/migrate', function (){
    \Artisan::call("migrate");
} )->name( 'migrate' );

//Route::get( '{sadasd}', function (){
//    return '132';
//dd(213);
//} );
//Route::any('/{any}', function (){
////        ret
////    return '132';
//dd(Route::current());
//})->where('any', '.*');



