<?php

use Illuminate\Support\Facades\Route;
use Neeraj1005\Cms\Http\Controllers\CmsCategoryController;
use Neeraj1005\Cms\Http\Controllers\CmsHomeController;
use Neeraj1005\Cms\Http\Controllers\PostController;

Route::get('/', [CmsHomeController::class, 'index'])->name('home.cms');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('posts', PostController::class);

    Route::name('posts.')->group(function() {
        Route::resource('categories', CmsCategoryController::class);
    });
});

Route::get('/{post}', [CmsHomeController::class, 'show'])->name('home.cms.show');