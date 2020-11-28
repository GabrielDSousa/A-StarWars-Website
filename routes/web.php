<?php

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

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('planets');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/planets', function () {
    return view('planets');
})->name('planets');

Route::middleware(['auth:sanctum', 'verified'])->get('/ships', function () {
    return view('ships');
})->name('ships');

Route::middleware(['auth:sanctum', 'verified'])->get('/favorites', function () {
    return view('favorites');
})->name('favorites');
