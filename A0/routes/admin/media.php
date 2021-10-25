<?php
Route::group( [
    'middleware' => [ 'web', 'panel' ],
    'namespace'  => '\Kaban\Components\Admin\Media\Controllers'
], function () {
    Route::group( [ 'prefix' => 'admin' ], function () {
        Route::group( [ 'prefix' => 'contents', 'as' => 'admin.contents.' ], function () {
            Route::post( '/media/upload', [
                'as'   => 'media.upload',
                'uses' => 'MediaController@upload'
            ] );
            Route::post( '/media/get-all', [
                'as'   => 'media.getAll',
                'uses' => 'MediaController@getAll'
            ] );
            Route::post( '/media/all', [
                'as'   => 'media.all',
                'uses' => 'MediaController@all'
            ] );
            Route::post( '/media/remove', [
                'as'   => 'media.destroy',
                'uses' => 'MediaController@destroy'
            ] );
        } );
    } );
} );
//Route::get('/{link?}', 'AuthenticationBaseController@showForm')
//    ->where('link', '[^.]*')
//    ->name('auth.form')
//    ->middleware('guest');
