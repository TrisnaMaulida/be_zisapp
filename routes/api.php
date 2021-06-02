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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', 'PenggunaController@login');
Route::post('register', 'PenggunaController@register');
Route::get('pengguna', 'PenggunaController@index');
Route::post('pengguna', 'PenggunaController@create');
Route::put('/pengguna/{id}', 'PenggunaController@update');
Route::delete('/pengguna/{id}', 'PenggunaController@delete');
