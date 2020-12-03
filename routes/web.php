<?php

use App\Http\Controllers\SwapiControlller;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::redirect("/planets", "/planets/1");
    Route::redirect("/", "/planets/1");
    Route::get('/planets/{page}', [SwapiControlller::class, 'planetsList'])->name('planets');
    Route::get('/planet', [SwapiControlller::class, 'planet'])->name('planet');

    Route::redirect("/starships", "/starships/1");
    Route::get('/starships/{page}', [SwapiControlller::class, 'starshipsList'])->name('starships');
    Route::get('/starship', [SwapiControlller::class, 'starship'])->name('starship');

    Route::get('/details/{type}/{id}/', [SwapiControlller::class, 'getDetails'])->name('detailsGet');
    Route::post('/save/{type}/{id}/', [SwapiControlller::class, 'save'])->name('save');
    Route::delete('/delete/{id}', [SwapiControlller::class, 'delete'])->name('delete');

    Route::get('/favorites', [SwapiControlller::class, 'favorites'])->name('favorites');
});

