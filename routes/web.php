<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return redirect()->route('movie.index');
});


Route::get('/movie', [\App\Http\Controllers\Movie\IndexController::class, 'show']) -> name('movie.index');

Route::get('/movie/{mID}', [\App\Http\Controllers\Movie\TitleController::class, 'show']) -> name('movie.title') ->where('mID', '[0-9]+');

Route::get('/movie/create', [\App\Http\Controllers\Movie\Create\IndexController::class, 'show']) -> name('movie.create.index') ->middleware('auth');

Route::post('/movie/create', [\App\Http\Controllers\Movie\Create\CreateController::class, 'create']) -> name('movie.create');

Route::get('/movie/update/{mID}', [\App\Http\Controllers\Movie\Update\IndexController::class, 'show']) -> name('movie.update.index') ->where('mID', '[0-9]+') ->middleware('auth');

Route::put('/movie/update/{mID}', [\App\Http\Controllers\Movie\Update\PutController::class, 'put']) -> name('movie.update.put') ->where('mID', '[0-9]+');

Route::get('/movie/delete/{mID}', [\App\Http\Controllers\Movie\Delete\IndexController::class, 'show']) ->name('movie.delete.index') ->where('mID', '[0-9]+') ->middleware('auth');

Route::delete('/movie/delete/{mID}', [\App\Http\Controllers\Movie\Delete\DeleteController::class, 'delete']) ->name('movie.delete') ->where('mID', '[0-9]+');

Route::match(['get', 'post'], '/movie/search',[\App\Http\Controllers\Movie\Search\IndexController::class, 'search']) -> name('movie.search');

Route::post('/movie/post/{mID}',[\App\Http\Controllers\Movie\Review\PostController::class, 'post']) -> name('movie.review.post') ->middleware('auth');

Route::post('/movie/genre/create',[\App\Http\Controllers\Movie\Genre\CreateController::class, 'create']) -> name('movie.genre.create');

Route::put('/movie/review/put/{mID}/{id}', [\App\Http\Controllers\Movie\Review\PutController::class, 'put']) ->name('movie.review.put') ->where('mID', '[0-9]+') ->where('id', '[0-9]+') ->middleware('auth');

Route::delete('/movie/review/delete/{mID}/{id}', [\App\Http\Controllers\Movie\Review\DeleteController::class, 'delete']) ->name('movie.review.delete') ->where('mID', '[0-9]+') ->where('id', '[0-9]+') ->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
