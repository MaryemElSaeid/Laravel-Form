<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('form', 'App\Http\Controllers\UserController@index');
Route::get('form/{id}', 'App\Http\Controllers\UserController@show');
Route::post('form', 'App\Http\Controllers\UserController@store');
Route::put('form/{id}', 'App\Http\Controllers\UserController@update');
Route::delete('form/{id}', 'App\Http\Controllers\UserController@delete');
