<?php
Route::group( [
    'middleware' => [ 'web', 'panel' ],
    'namespace'  => '\Kaban\Components\Admin\Users\Controllers',
    'prefix'     => 'admin/acl/users',
    'as'         => 'admin.acl.users'
], function () {
    Route::get( '/{link?}', [
        'as'   => 'index',
        'uses' => 'UsersController@index'
    ] )
         ->where( 'link', '[^.]*' );

    Route::post( '/search', [
        'as'   => 'search',
        'uses' => 'CategoriesController@search'
    ] );
    Route::post( '/all', [
        'as'   => 'all',
        'uses' => 'UsersController@all'
    ] );
} );
//Route::get('/{link?}', 'AuthenticationBaseController@showForm')
//    ->where('link', '[^.]*')
//    ->name('auth.form')
//    ->middleware('guest');
