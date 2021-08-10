<?php
Route::group( [
    'middleware' => [ 'web', 'panel' ],
    'namespace'  => '\Kaban\Components\Admin\Posts\Controllers'
], function () {
    Route::group( [ 'prefix' => 'admin' ], function () {
        Route::group( [ 'prefix' => 'contents', 'as' => 'admin.contents.' ], function () {

            Route::post( '/posts/store', [
                'as'   => 'posts.store',
                'uses' => 'PostsController@store'
            ] );
            Route::post( '/posts/search', [
                'as'   => 'posts.search',
                'uses' => 'PostsController@search'
            ] );
            Route::post( '/posts/search-tags', [
                'as'   => 'posts.searchTags',
                'uses' => 'PostsController@searchTags'
            ] );
            Route::post( '/posts/{id}/edit', [
                'as'   => 'posts.edit',
                'uses' => 'PostsController@edit'
            ] );
            Route::post( '/posts/{id}/update', [
                'as'   => 'posts.update',
                'uses' => 'PostsController@update'
            ] );
            Route::post( '/posts/{id}/destroy', [
                'as'   => 'posts.delete',
                'uses' => 'PostsController@destroy'
            ] );
            Route::post( '/posts/all', [
                'as'   => 'posts.all',
                'uses' => 'PostsController@all'
            ] );
        } );
    } );
} );
//Route::get('/{link?}', 'AuthenticationBaseController@showForm')
//    ->where('link', '[^.]*')
//    ->name('auth.form')
//    ->middleware('guest');
