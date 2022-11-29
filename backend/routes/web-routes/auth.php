<?php

Route::prefix('/auth/')->group(function () {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
	Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
	
	Route::group(['middleware' => ['auth:api']], function () {
		Route::get('logout-user', [App\Http\Controllers\AuthController::class, 'log_out_user']);
		Route::get('auth-user', [App\Http\Controllers\AuthController::class, 'auth_user']);
		Route::post('update-account', [App\Http\Controllers\AuthController::class, 'update_account']);
		Route::post('update-password', [App\Http\Controllers\AuthController::class, 'update_password']);
		Route::post('update-profile-pic', [App\Http\Controllers\AuthController::class, 'update_profile_pic']);
		Route::get('logout', [App\Http\Controllers\AuthController::class, 'log_out_user']);
	});
});