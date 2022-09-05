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
Route::get('email',[\App\Http\Controllers\DemoController::class,'index'])->name('email');
Route::post('email',[\App\Http\Controllers\DemoController::class,'sendmail'])->name('sendmail');
Route::get('/', function () {
    return view('welcome');
});
