<?php

Route::group(['middleware' => ['auth:api']], function () {
	// blogs
	Route::prefix('/blogs/')->group(function () {
		Route::post('create', [App\Http\Controllers\App\BlogsController::class, 'create_blog']);
		Route::post('search', [App\Http\Controllers\App\BlogsController::class, 'search_blog']);	
		Route::post('update/{id}', [App\Http\Controllers\App\BlogsController::class, 'update_blog']);
		Route::get('/', [App\Http\Controllers\App\BlogsController::class, 'blogs']);
		Route::get('/{id}', [App\Http\Controllers\App\BlogsController::class, 'blog_details']);
		Route::post('update_image/{id}', [App\Http\Controllers\App\BlogsController::class, 'update_image']);
		Route::get('/status/{id}', [App\Http\Controllers\App\BlogsController::class, 'change_status']);
		Route::get('/delete/{id}', [App\Http\Controllers\App\BlogsController::class, 'delete_blog']);
	});
});