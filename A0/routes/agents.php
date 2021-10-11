<?php

use Kaban\Components\General\Agent\Controllers\AgentProfileController;
use Kaban\Components\General\Agent\Controllers\AgentResetPasswordController;
use Kaban\Components\General\Agent\Controllers\AgentsLoginController;
use Kaban\Components\General\Agent\Controllers\ForgotPasswordController;

Route::get( '/login', [AgentsLoginController::class,'agentLoginPage'] )->middleware('guest')->name( 'agentLoginPage' );
Route::get( '/password/email', [AgentResetPasswordController::class,'showLinkRequestForm'] )->middleware('guest:agentGuard')->name( 'password.agent.email' );
Route::post('/password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.agent.email');

Route::get( '/password/reset', [AgentResetPasswordController::class,'showResetForm'] )->name( 'password.agent.reset' );
Route::post( '/password/update', [AgentResetPasswordController::class,'reset'] )->name( 'password.agent.update' );


Route::get( '/logout', [AgentsLoginController::class,'agentLogoutAttempt'] )->middleware('auth:agentGuard')->name( 'agent.logout' );


Route::post( '/login', [AgentsLoginController::class,'agentLoginAttempt'] )->name( 'agentLoginAttempt' );

Route::get( '/me', [AgentProfileController::class,'agentProfilePage'] )->middleware('auth:agentGuard')->name( 'agent.profile.index' );
Route::post( '/me', [AgentProfileController::class,'update'] )->middleware('auth:agentGuard')->name( 'agent.profile.update' );
