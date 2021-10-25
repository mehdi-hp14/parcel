<?php
Route::group( [
    'middleware' => [ 'web', 'panel' ],
    'namespace'  => '\Kaban\Components\Admin\Permissions\Controllers',
    'prefix'     => 'admin/permissions',
    'as'         => 'admin.permissions.'
], function () {

    Route::get( '/{link?}', [
        'as'   => 'permissions.index',
        'uses' => 'PermissionsController@index'
    ] )
         ->where( 'link', '[^.]*' );

    Route::post( '/permissions/store', [
        'as'   => 'permissions.store',
        'uses' => 'PermissionsController@store'
    ] );
    Route::post( '/permissions/{id}/destroy', [
        'as'   => 'permissions.delete',
        'uses' => 'PermissionsController@destroy'
    ] );
    Route::post( '/permissions/all', [
        'as'   => 'permissions.all',
        'uses' => 'PermissionsController@all'
    ] );
} );
//Route::get('/{link?}', 'AuthenticationBaseController@showForm')
//    ->where('link', '[^.]*')
//    ->name('auth.form')
//    ->middleware('guest');
