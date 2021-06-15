<?php

use App\Http\Controllers\AkunController;
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

//Pengguna API
Route::post('login', 'PenggunaController@login');
Route::post('register', 'PenggunaController@register');
Route::get('pengguna', 'PenggunaController@index');
Route::post('pengguna', 'PenggunaController@create');
Route::put('pengguna/{id}', 'PenggunaController@update');
Route::delete('pengguna/{id}', 'PenggunaController@delete');

//Muzaki API
Route::get('muzaki', 'MuzakiController@index');
Route::post('muzaki', 'MuzakiController@create');
Route::put('muzaki/{id}', 'MuzakiController@update');
Route::delete('muzaki/{id}', 'MuzakiController@delete');

//Mustahik API
Route::get('mustahik', 'MustahikController@index');
Route::post('mustahik', 'MustahikController@create');
Route::put('mustahik/{id}', 'MustahikController@update');
Route::delete('mustahik/{id}', 'MustahikController@delete');

//Kantor API
Route::get('kantor', 'KantorController@index');
Route::post('kantor', 'KantorController@create');
Route::put('kantor/{id}', 'KantorController@update');
Route::delete('kantor/{id}', 'KantorController@delete');

//Bank API
Route::get('bank', 'BankController@index');
Route::post('bank', 'BankController@create');
Route::put('bank/{id}', 'BankController@update');
Route::delete('bank/{id}', 'BankController@delete');

//Akun API
Route::get('akun', 'AkunController@index');
Route::post('akun', 'AkunController@create');
Route::put('akun/{id}', 'AkunController@update');
Route::delete('akun/{id}', 'AkunController@delete');
