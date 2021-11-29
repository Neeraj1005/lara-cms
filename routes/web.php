<?php

use Illuminate\Support\Facades\Route;
use Neeraj1005\Cms\Http\Controllers\Api\CmsPostApiController;
use Neeraj1005\Cms\Http\Controllers\CmsCategoryController;
use Neeraj1005\Cms\Http\Controllers\CmsHomeController;
use Neeraj1005\Cms\Http\Controllers\CmsReportController;
use Neeraj1005\Cms\Http\Controllers\PostController;


Route::prefix('api')->group(function () {
    Route::name('api.')->group(function () {
        Route::get('posts', [CmsPostApiController::class, 'index'])->name('latestpost');
        Route::get('posts/{post}', [CmsPostApiController::class, 'show'])->name('postdetail');
    });
});

Route::get('/', [CmsHomeController::class, 'index'])->name('home.cms');
Route::get('/rss', [CmsHomeController::class, 'rssFeed'])->name('home.rss');
Route::get('/sitemap', [CmsHomeController::class, 'sitemap'])->name('sitemap');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('posts', PostController::class);
    Route::get('reports', [CmsReportController::class, 'index'])->name('report.index');

    Route::name('posts.')->group(function () {
        Route::resource('categories', CmsCategoryController::class)->except(['show']);
    });
});
Route::post('imageupload', [PostController::class, 'imageUpload'])->name('cms.imageupload');
Route::get('/{post}', [CmsHomeController::class, 'show'])->name('home.cms.show');
