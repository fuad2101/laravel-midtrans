<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController;

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
    return view('welcome');
});

//Route::get('donasi','DonasiController@index');
//Route::view('/donasi','donation');

Route::controller(DonasiController::class)->group(function(){
    Route::get('/donasi','index');
    Route::post('/donasi','store');
});
