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



/* Route API Master*/
//Pengguna API
Route::post('login', 'master\PenggunaController@login');
Route::post('register', 'master\PenggunaController@register');
Route::get('pengguna', 'master\PenggunaController@index');
Route::post('pengguna', 'master\PenggunaController@create');
Route::put('pengguna/{id}', 'master\PenggunaController@update');
Route::delete('pengguna/{id}', 'master\PenggunaController@delete');

//Muzaki API
Route::get('muzaki', 'master\MuzakiController@index');
Route::post('muzaki', 'master\MuzakiController@create');
Route::put('muzaki/{id}', 'master\MuzakiController@update');
Route::delete('muzaki/{id}', 'master\MuzakiController@delete');

//Mustahik API
Route::get('mustahik', 'master\MustahikController@index');
Route::post('mustahik', 'master\MustahikController@create');
Route::put('mustahik/{id}', 'master\MustahikController@update');
Route::delete('mustahik/{id}', 'master\MustahikController@delete');

//Kantor API
Route::get('kantor', 'master\KantorController@index');
Route::post('kantor', 'master\KantorController@create');
Route::put('kantor/{id}', 'master\KantorController@update');
Route::delete('kantor/{id}', 'master\KantorController@delete');

//Bank API
Route::get('bank', 'master\BankController@index');
Route::post('bank', 'master\BankController@create');
Route::put('bank/{id}', 'master\BankController@update');
Route::delete('bank/{id}', 'master\BankController@delete');

//Akun API
Route::get('akun', 'master\AkunController@index');
Route::post('akun', 'master\AkunController@create');
Route::put('akun/{id}', 'master\AkunController@update');
Route::delete('akun/{id}', 'master\AkunController@delete');

//Kas API
Route::get('kas', 'master\KasController@index');
Route::post('kas', 'master\KasController@create');
Route::put('kas/{id}', 'master\KasController@update');
Route::delete('kas/{id}', 'master\KasController@delete');

//Kategori API
Route::get('kategori', 'master\KategoriController@index');
Route::post('kaategori', 'master\KategoriController@create');
Route::put('kategori/{id}', 'master\KategoriController@update');
Route::delete('kategori/{id}', 'master\KategoriController@delete');

//Program API
Route::get('program', 'ProgramController@index');
Route::post('program', 'ProgramController@create');
Route::put('program/{id}', 'ProgramController@update');
Route::delete('program/{id}', 'ProgramController@delete');

/* Route API Transaksi*/

//Periode API
Route::get('periode', 'transaksi\PeriodeController@index');
Route::post('periode', 'transaksi\PeriodeController@create');
Route::put('periode/{id}', 'transaksi\PeriodeController@update');
Route::delete('periode/{id}', 'transaksi\PeriodeController@delete');

//Donasi API
Route::get('donasi', 'transaksi\DonasiController@index');
Route::post('donasi', 'transaksi\DonasiController@create');
Route::put('donasi/{id}', 'transaksi\DonasiController@update');
Route::delete('donasi/{id}', 'transaksi\DonasiController@delete');

//Detail Donasi API
Route::get('detaildonasi', 'transaksi\DetailDonasiController@index');
Route::post('detaildonasi', 'transaksi\DetailDonasiController@create');
Route::delete('detaildonasi', 'transaksi\DetailDonasiController@delete');

//Pengajuan API
Route::get('pengajuan', 'transaksi\PengajuanController@index');
Route::post('pengajuan', 'transaksi\PengajuanController@create');
Route::delete('pengajuan', 'transaksi\PengajuanController@delete');
