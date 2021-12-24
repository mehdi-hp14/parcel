<?php

use Kaban\Components\Site\Home\Controllers\HomeController;
use Kaban\Components\Site\Home\Controllers\ReportController;
use Kaban\Models\Role;

Route::group( [
    'middleware' => [ 'web'],
    'namespace'  => '\Kaban\Components\Site\Home\Controllers',
    'prefix' => '/'
], function () {

    Route::get( '/', [
        'as'   => 'site.home',
        'uses' => 'HomeController@index'
    ] );

    Route::get( '/xx', function () {
        auth()->guard('adminGuard')->loginUsingId(2);
        echo 'mehdi';
//        echo phpinfo();
    } )->name( 'home2' );

    Route::post( '/contact', [HomeController::class,'contact'] )->name( 'contact' );

    Route::get( '/admin/report/search-users', [ReportController::class,'searchUser'])->name( 'site.report.search-users' );
    Route::get( '/admin/report/search-users', [ReportController::class,'searchUser'])->name( 'site.report.search-users' );
    Route::post( '/admin/report/email-to-report-users', [ReportController::class,'emailToReportUsers'])->name( 'site.report.email-to-report-users' );
    Route::post( '/admin/report/save-shipping-info', [ReportController::class,'saveShippingInfo'])->name( 'site.report.save-shipping-info' );
    Route::get( '/admin/report/{type}', [ReportController::class,'report'])->name( 'admin.report' );
//    Route::get( '/', function () {
//        $user = request()->user(); //getting the current logged in customer
//    dd( $customer );
//    $customer = \Kaban\Models\User::find( 2 );
//    dd( $customer, $customer->hasRole( 'create-tasks' ) ); //will return true, if customer has role
//    $customer->givePermissionsTo( 'create-tasks' );// will return permission, if not null
//    dd( $customer->can( 'create-tasks' ) ); // will return true, if customer has permission
//    echo phpinfo();


//    $dev_role = Role::where( 'slug', 'developer' )->first();
//    $customer->roles()->attach( $dev_role );

//        return view( 'welcome' );
//    } );
} );
