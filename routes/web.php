<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\WebMDController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('movie.list');
});

//  Route::resource('scraper', ScraperController::class);
//  Route::get('/movies', [MovieController::class, 'index'])->name('movie.list');

Route::get('/scrape/webMD', [WebMDController::class, 'index']);
Route::get('/scrape/webMD/blog-list', [WebMDController::class, 'categoryBlogs']);