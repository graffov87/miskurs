<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MaterialController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::pattern('postUrl', '[a-z\-\d]+');

Route::get('/', function () {
    $array = ['title' => "Богословские образовательные курсы для мирян",'description' => "Богословские образовательные курсы для мирян"];
    return view('welcome', $array);
});
Route::get('/material', [MaterialController::class, 'index']);
Route::get('/posts', [PostController::class, 'posts']);
Route::get('/{postUrl}', [PostController::class, 'index']);
