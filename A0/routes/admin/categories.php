<?php
Route::group( [
    'middleware' => [ 'web', 'panel' ],
    'namespace'  => '\Kaban\Components\Admin\Categories\Controllers'
], function () {
    Route::group( [ 'prefix' => 'admin' ], function () {
        Route::group( [ 'prefix' => 'contents', 'as' => 'admin.contents.' ], function () {
            Route::get( '/{link?}', [
                'as'   => 'categories.index',
                'uses' => 'CategoriesController@index'
            ] )
                 ->where( 'link', '[^.]*' );

            Route::post( '/categories/store', [
                'as'   => 'categories.store',
                'uses' => 'CategoriesController@store'
            ] );
            Route::post( '/categories/search', [
                'as'   => 'categories.search',
                'uses' => 'CategoriesController@search'
            ] );
            Route::post( '/categories/{id}/edit', [
                'as'   => 'categories.edit',
                'uses' => 'CategoriesController@edit'
            ] );
            Route::post( '/categories/{id}/update', [
                'as'   => 'categories.update',
                'uses' => 'CategoriesController@update'
            ] );
            Route::post( '/categories/{id}/destroy', [
                'as'   => 'categories.delete',
                'uses' => 'CategoriesController@destroy'
            ] );
            Route::post( '/categories/all', [
                'as'   => 'categories.all',
                'uses' => 'CategoriesController@all'
            ] );
        } );
    } );
} );
//Route::get('/{link?}', 'AuthenticationBaseController@showForm')
//    ->where('link', '[^.]*')
//    ->name('auth.form')
//    ->middleware('guest');
