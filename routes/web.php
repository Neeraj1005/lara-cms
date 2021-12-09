<?php

use Illuminate\Support\Facades\Route;
use Neeraj1005\Cms\Http\Controllers\Api\CmsPostApiController;
use Neeraj1005\Cms\Http\Controllers\CmsCategoryController;
use Neeraj1005\Cms\Http\Controllers\CmsHomeController;
use Neeraj1005\Cms\Http\Controllers\CmsMediaController;
use Neeraj1005\Cms\Http\Controllers\CmsMenuController;
use Neeraj1005\Cms\Http\Controllers\CmsReportController;
use Neeraj1005\Cms\Http\Controllers\CmsSeoController;
use Neeraj1005\Cms\Http\Controllers\CmsSettingController;
use Neeraj1005\Cms\Http\Controllers\PostController;


Route::prefix('api')->group(function () {
    Route::name('api.')->group(function () {
        Route::get('posts', [CmsPostApiController::class, 'index'])->name('latestpost');
        Route::get('posts/{post}', [CmsPostApiController::class, 'show'])->name('postdetail');
    });
});

if (config('cms.frontend_url')) {
    Route::get('/', [CmsHomeController::class, 'index'])->name('home.cms');
}

Route::get('/rss', [CmsHomeController::class, 'rssFeed'])->name('home.rss');
Route::get('/sitemap', [CmsHomeController::class, 'sitemap'])->name('sitemap');

/**
 * Backend Url
 */
Route::group(['middleware' => ['auth']], function () {
    Route::resource('posts', PostController::class);
    Route::name('posts.')->group(function () {
        Route::resource('categories', CmsCategoryController::class)->except(['show']);
    });
    Route::get('reports', [CmsReportController::class, 'index'])->name('report.index');

    Route::name('cms.')->group(function () {
        Route::post('imageupload', [PostController::class, 'imageUpload'])->name('imageupload');
        Route::get('settings', CmsSettingController::class)->name('settings');
        Route::post('seo-cms', [CmsSeoController::class, 'seoStore'])->name('seo');
        Route::resource('menus', CmsMenuController::class)->except(['show']);
        Route::resource('media', CmsMediaController::class);
    });
});

if (config('cms.frontend_url')) {
    Route::get('/{post}', [CmsHomeController::class, 'show'])->name('home.cms.show');
}
