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
Route::get('pengguna/{id}', 'master\PenggunaController@show');
Route::get('pengguna', 'master\PenggunaController@index');
Route::post('pengguna', 'master\PenggunaController@create');
Route::put('pengguna/{id}', 'master\PenggunaController@update');
Route::delete('pengguna/{id}', 'master\PenggunaController@delete');

//Muzaki API
Route::get('muzaki', 'master\MuzakiController@index');
Route::get('muzaki/{id}', 'master\MuzakiController@show');
Route::post('muzaki', 'master\MuzakiController@create');
Route::put('muzaki/{id}', 'master\MuzakiController@update');
Route::delete('muzaki/{id}', 'master\MuzakiController@delete');

//Mustahik API
Route::get('mustahik', 'master\MustahikController@index');
Route::post('mustahik', 'master\MustahikController@create');
Route::get('mustahik/{id}', 'master\MustahikController@show');
Route::put('mustahik/{id}', 'master\MustahikController@update');
Route::delete('mustahik/{id}', 'master\MustahikController@delete');

//Bank API
Route::get('bank', 'master\BankController@index');
Route::post('bank', 'master\BankController@create');
Route::put('bank/{id}', 'master\BankController@update');
Route::delete('bank/{id}', 'master\BankController@delete');

//Program API
Route::get('program', 'master\ProgramController@index');
Route::post('program', 'master\ProgramController@create');
Route::post('program/{id}', 'master\ProgramController@show');
Route::put('program/{id}', 'master\ProgramController@update');
Route::delete('program/{id}', 'master\ProgramController@delete');

//Kantor API
Route::get('kantor', 'master\KantorController@index');
Route::post('kantor', 'master\KantorController@create');
Route::put('kantor/{id}', 'master\KantorController@update');
Route::delete('kantor/{id}', 'master\KantorController@delete');

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


/* Route API Transaksi*/

//Periode API
Route::get('periode', 'transaksi\PeriodeController@index');
Route::post('periode', 'transaksi\PeriodeController@create');
Route::put('periode/{id}', 'transaksi\PeriodeController@update');
Route::delete('periode/{id}', 'transaksi\PeriodeController@delete');

//Donasi API
Route::get('donasi/{id}', 'transaksi\DonasiController@index');
Route::get('laporan/cetak_pdf', 'transaksi\DonasiController@cetak_pdf'); //cetak pdf
Route::post('donasi', 'transaksi\DonasiController@create');
Route::put('donasi/{id}', 'transaksi\DonasiController@update');
Route::delete('donasi/{id}', 'transaksi\DonasiController@delete');

//Pengajuan API
Route::get('pengajuan', 'transaksi\PengajuanController@index');
Route::get('laporan/cetak_pdf', 'transaksi\PengajuanController@cetak_pdf'); //cetak pdf
Route::post('pengajuan', 'transaksi\PengajuanController@create');
Route::put('pengajuan/{id}', 'transaksi\PengajuanController@update');
Route::get('pengajuan/{id}', 'master\PengajuanController@show');
Route::delete('pengajuan/{id}', 'transaksi\PengajuanController@delete');
