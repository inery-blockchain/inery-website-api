<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\Admin\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/symlinkcreateagain', function () {
    Artisan::call('storage:link');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('jobs/applications', [JobsController::class, 'jobApplications']);
    Route::resource('posts', PostController::class);
    Route::resource('jobs', JobsController::class);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'blogger']], function () {

    Route::resource('posts', PostController::class);
});

Auth::routes(['register' => false]);

// Route::get('/', function () {
//     if (Auth::check()) {

//         return redirect('admin/posts');
//     } else {

//         return view('/');
//     }
// })->middleware('auth');

Route::get('/', function () {
    return view('home');
})->middleware('auth');
