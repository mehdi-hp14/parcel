<?php
Route::group( [
    'middleware' => [ 'web', 'panel' ],
    'namespace'  => '\Kaban\Components\Admin\Roles\Controllers',
    'prefix'     => 'admin/roles',
    'as'         => 'admin.roles.'
], function () {

    Route::get( '/{link?}', [
        'as'   => 'roles.index',
        'uses' => 'RolesController@index'
    ] )
         ->where( 'link', '[^.]*' );

    Route::post( '/roles/{id}/edit', [
        'as'   => 'roles.edit',
        'uses' => 'RolesController@edit'
    ] );
    Route::post( '/roles/store', [
        'as'   => 'roles.store',
        'uses' => 'RolesController@store'
    ] );
    Route::post( '/roles/{id}/update', [
        'as'   => 'roles.update',
        'uses' => 'RolesController@update'
    ] );
    Route::post( '/roles/{id}/destroy', [
        'as'   => 'roles.delete',
        'uses' => 'RolesController@destroy'
    ] );
    Route::post( '/roles/all', [
        'as'   => 'roles.all',
        'uses' => 'RolesController@all'
    ] );
    Route::post( '/roles/search-permissions', [
        'as'   => 'roles.searchPermissions',
        'uses' => 'RolesController@searchPermissions'
    ] );
} );
//Route::get('/{link?}', 'AuthenticationBaseController@showForm')
//    ->where('link', '[^.]*')
//    ->name('auth.form')
//    ->middleware('guest');
