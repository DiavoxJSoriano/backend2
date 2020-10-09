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

Route::resource('user', 'App\Http\Controllers\UserController');
Route::post('delete-users', 'App\Http\Controllers\UserController@destroyMany')->name("user.destruct");

Route::get('get-users', 'App\Http\Controllers\HomeController@manage');

