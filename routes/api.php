<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('tokenmware')->group(function () {

    Route::get('/jobs', [JobsController::class, 'index']);
    Route::get('job/{slug}', [JobsController::class, 'show']);
    Route::get('/jobs/category/{id}', [JobsController::class, 'byCategory']);
    Route::post('job/save', [JobsController::class, 'store']);
    Route::put('job/{slug}/update', [JobsController::class, 'update']);
    Route::post('/careers/apply', [JobsController::class, 'jobAplication']);
});


Route::post('/category/save', [CategoryController::class, 'store']);
Route::put('/category/{slug}/update', [CategoryController::class, 'update']);

Route::get('/posts/{page?}', [PostController::class, 'index']);
Route::get('post/{link_to_details}', [PostController::class, 'show']);
Route::get('popular-today', [PostController::class, 'popularPostsToday']);
Route::get('top-posts/{page?}', [PostController::class, 'topPosts']);
Route::get('random-posts/{page?}', [PostController::class, 'randomPosts']);
Route::get('latest-posts', [PostController::class, 'latestPosts']);
Route::post('posts/ajax-search', [PostController::class, 'ajaxSearch']);
Route::post('posts/search', [PostController::class, 'search']);

Route::post('newsletters', [NewsletterController::class, 'store']);

// Route::prefix('test')->group(function () {
//     Route::get('/posts/{page?}', [PostController::class, 'index']);
//     Route::get('post/{slug}', [PostController::class, 'show']);
//     Route::get('popular-today', [PostController::class, 'mostPopularPosts']);
//     Route::post('posts/ajax-search', [PostController::class, 'ajaxSearch']);
//     Route::post('posts/search', [PostController::class, 'search']);
// });
