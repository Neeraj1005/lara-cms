<?php

use Illuminate\Support\Facades\Route;
use Neeraj1005\Cms\Http\Controllers\PostController;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::prefix('cms')->group(function () {
        Route::resource('posts', PostController::class);
    });
});
