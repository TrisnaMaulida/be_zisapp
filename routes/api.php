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
Route::get('laporanmuzaki/cetak_pdf', 'master\MuzakiController@cetak_pdf'); //cetak pdf laporan by id dan status
Route::get('laporanmuzaki_all/cetakpdf', 'master\MuzakiController@cetakpdf'); //cetak pdf laporan all muzaki

//Mustahik API
Route::get('mustahik', 'master\MustahikController@index');
Route::post('mustahik', 'master\MustahikController@create');
Route::get('mustahik/{id}', 'master\MustahikController@show');
Route::put('mustahik/{id}', 'master\MustahikController@update');
Route::delete('mustahik/{id}', 'master\MustahikController@delete');
Route::get('laporanmustahik/cetak_pdf', 'master\MustahikController@cetak_pdf'); //cetak pdf laporan by id, kategori dan asnaf
Route::get('laporanmustahik_all/cetakpdf', 'master\MustahikController@cetakpdf'); //cetak pdf laporan all mustahik

//Bank API
Route::get('bank', 'master\BankController@index');
Route::post('bank', 'master\BankController@create');
Route::put('bank/{id}', 'master\BankController@update');
Route::delete('bank/{id}', 'master\BankController@delete');
Route::get('laporanbank/cetakpdf', 'master\BankController@cetakpdf'); //mencetak pdf laporan all bank

//Program API
Route::get('program', 'master\ProgramController@index');
Route::post('program', 'master\ProgramController@create');
Route::post('program/{id}', 'master\ProgramController@show');
Route::put('program/{id}', 'master\ProgramController@update');
Route::delete('program/{id}', 'master\ProgramController@delete');
Route::get('laporanprogram_all/cetakpdf', 'master\ProgramController@cetakpdf'); //mencetak pdf laporan all program
Route::get('laporanprogram/cetak_pdf', 'master\ProgramController@cetak_pdf'); //cetak pdf laporan by id_bank

/* Route API Transaksi*/

//Donasi API
Route::get('donasi/{id}', 'transaksi\DonasiController@show');
Route::get('detaildonasi/{id}', 'transaksi\DonasiController@detaildonasi');
Route::get('donasibymuzaki/{id}', 'transaksi\DonasiController@showmuzaki'); //show by id muzaki
Route::get('donasi', 'transaksi\DonasiController@index');
Route::get('laporan/cetak_pdf', 'transaksi\DonasiController@cetak_pdf'); //cetak pdf laporan
Route::get('tandaterima/cetak_tanda', 'transaksi\DonasiController@cetak_tanda'); //cetak pdf tanda bukti
Route::post('donasi', 'transaksi\DonasiController@create');
Route::put('donasi/{id}', 'transaksi\DonasiController@update');
Route::delete('donasi/{id}', 'transaksi\DonasiController@delete');


//Pengajuan API
Route::get('pengajuan', 'transaksi\PengajuanController@index');
Route::get('laporanpengajuan/cetak_pdf', 'transaksi\PengajuanController@cetak_pdf'); //cetak pdf
Route::post('pengajuan', 'transaksi\PengajuanController@create');
Route::put('pengajuan/{id}', 'transaksi\PengajuanController@update');
Route::get('pengajuan/{id}', 'transaksi\PengajuanController@show');
Route::delete('pengajuan/{id}', 'transaksi\PengajuanController@delete');
Route::post('pengajuanupload/{id}', 'transaksi\PengajuanController@upload'); //upload file
Route::get('cobaupload', 'transaksi\PengajuanController@form');
