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
Route::get('/hehe',[\App\Http\Controllers\PostController::class,'index']);
Route::get('/create',[\App\Http\Controllers\PostController::class,'create']);
Route::get('/', function () {
    return view('welcome');
});
