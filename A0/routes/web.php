<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Kaban\Components\General\Auth\Controllers\AgentResetPasswordController;
use Kaban\Components\General\Agent\Controllers\BaseController;
use Kaban\Components\General\Auth\Controllers\AgentsLoginController;
use Kaban\Components\General\Auth\Controllers\ForgotPasswordController;

$segments = ['site'];
foreach ($segments as $segment) {
    foreach (scandir(__DIR__ . '/' . $segment) as $file) {
        if ($file != '.' && $file != '..') {
            require_once(__DIR__ . '/' . $segment . '/' . $file);
        }
    }
}

//Auth::routes();
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/x', function () {
    $lines = array();
    $fp = fopen(storage_path("logs/laravel.log"), "r");
    while (!feof($fp)) {
        $line = fgets($fp, 4096);
        array_push($lines, $line);
        if (count($lines) > 560)
            array_shift($lines);
    }
    fclose($fp);

    dd($lines);
    $file = escapeshellarg(storage_path("logs/laravel.log"));
    $line = 'tail -n 30 $file';

    dd($line);

    dd($log);
    echo phpinfo();
})->name('home2');


Route::get('/rom1367', function () {
    auth()->loginUsingId(10);
    echo phpinfo();
})->name('home2');


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'agents'], function () {

});


//dummy
Route::get('/roles', 'PermissionController@Permission');

Route::get('/users-list', 'HomeController@usersList')->name('usersList');

Route::get('/migrate', function () {
    \Artisan::call("migrate");
})->name('migrate');

Route::get('/mail', function () {
    $details = [

        'name' => 'Mname',
        'email' => 'email',
        'subject' => 'meqsage',
        'message' => 'meqsage',

        'body' => 'This is for testing email using smtp'

    ];

    $html = '<b>My email</b>';
    \Mail::send([], [], function (Message $message) use ($html) {
        $message->to('mmhp16@gmail.com')
            ->subject('my subject')
            ->from('my@email.com')
            ->setBody($html, 'text/html');
    });
    return 221;

    \Mail::to('mmhp16@gmail.com')->send(new \App\Mail\Contact($details));
//    Mail::raw('hello!')->

//    to('mmhp16@gmail.com')->;
    //\Artisan::call("migrate");
})->name('migrate');

//Route::get( '{sadasd}', function (){
//    return '132';
//dd(213);
//} );
//Route::any('/{any}', function (){
////        ret
////    return '132';
//dd(Route::current());
//})->where('any', '.*');



