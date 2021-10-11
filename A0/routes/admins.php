<?php

use Kaban\Components\General\Admin\Controllers\AdminLoginController;
use Kaban\Components\General\Admin\Controllers\AdminProfileController;
use Kaban\Components\General\Admin\Controllers\AdminRegisterController;
use Kaban\Components\General\Admin\Controllers\AdminResetPasswordController;
use Kaban\Components\General\Admin\Controllers\BaseController;
use Kaban\Components\General\Admin\Controllers\ForgotPasswordController;

Route::get( '/test', function (){
    dd(21);
});
Route::get( '/login', [AdminLoginController::class,'adminLoginPage'] )->middleware('guest')->name( 'adminLoginPage' );
Route::get( '/password/email', [AdminResetPasswordController::class,'showLinkRequestForm'] )->middleware('guest:adminGuard')->name( 'password.admin.email' );
Route::post('/password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.admin.email');

Route::get( '/password/reset', [AdminResetPasswordController::class,'showResetForm'] )->middleware('guest:adminGuard')->name( 'password.admin.reset' );
Route::post( '/password/update', [AdminResetPasswordController::class,'reset'] )->middleware('guest:adminGuard')->name( 'password.admin.update' );

Route::get('register', [AdminRegisterController::class,'showRegistrationForm'])->name('adminsRegister');
Route::post('register', [AdminRegisterController::class,'register'])->name( 'admin.register' );

Route::get( '/logout', [AdminLoginController::class,'adminLogoutAttempt'] )->middleware('auth:adminGuard')->name( 'admin.logout' );


Route::post( '/login', [AdminLoginController::class,'adminLoginAttempt'] )/*->middleware('guest:adminGuard')*/->name( 'adminLoginAttempt' );
//Route::get( '/me', [BaseController::class,'getAdmin'] )->middleware('auth:adminGuard')->name( 'getAdmin' );

Route::get( '/me', [AdminProfileController::class,'adminProfilePage'] )->middleware('auth:adminGuard')->name( 'admin.profile.index' );
Route::post( '/me', [AdminProfileController::class,'update'] )->middleware('auth:adminGuard')->name( 'admin.profile.update' );
