<?php

use Illuminate\Support\Facades\Route;
use Neeraj1005\Cms\Http\Controllers\PostController;

Route::group(['middleware' => ['auth']], function () {
    Route::resource('posts', PostController::class);
});
