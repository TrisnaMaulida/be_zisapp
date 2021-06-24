<?php

namespace App\Http\Controllers\transaksi;

use App\DetailDonasi;
use App\Donasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonasiController extends Controller
{
    //get donasi
    public function index($id) //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Detail Donasi"; //menampilkan pesan

        $data['data'] = DB::select("SELECT * FROM detail_donasis LEFT JOIN donasis ON detail_donasis.id_donasi = donasis.id_donasi 
                                                        LEFT JOIN programs ON detail_donasis.id_program = programs.id_program
                                                        LEFT JOIN periodes ON donasis.id_periode = periodes.id_periode
                                                        LEFT JOIN muzaki ON donasis.id_muzaki = muzakis.id_muzaki
                                                        LEFT JOIN banks ON donasis.id_bank = banks.id_bank
                                                        LEFT JOIN penggunas ON penggunas.id_pengguna = donasis.id_pengguna 
                                                        WHERE detail_donasis.id_donasi = '" . $id . "");
        //perintah menampilkan enam table (relasi) -> relasi antara table donasis, table penggunas, table muzakis, table bank dan table periodes
        return $data; //menampilkan data relasi yang sudah dibuat
    }

    //create donasi
    public function create(Request $request) //pendeklarasian fungsi create
    {
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "DNS-18000001"; //18 itu tahun

        $max_donasi = DB::table("donasis")->max('no_donasi'); //ambil id terbesar > PJN-18000001

        if ($max_donasi) { //jika sudah ada data genarate id baru
            # code...
            $tahun = $request->input('tahun'); //request tahun dari frontend
            $pecah_dulu = str_split($max_donasi, 8); //misal "PJN-1800001" hasilnya jadi ["PJN-1800","001"]
            $pecah_tahun = str_split($pecah_dulu[0], 4);
            $increment_id = $pecah_dulu[0];
            $hasil_tahun = $tahun . "00";
            $result = sprintf("%'.04d", $increment_id + 1);

            $next_id = $pecah_tahun[0] . $hasil_tahun . $result;
        }

        $donasi = new Donasi; //inisalisasi atau menciptakan objek baru
        $donasi->no_donasi = $next_id; //memanggil perintah next_id yang sudah dibuat
        $donasi->no_bukti = $request->no_bukti; //menset no_bukti yang diambil dari request body
        $donasi->tgl_donasi = $request->tgl_donasi; //menset tgl_donasi yang diambil dari request body
        $donasi->total_donasi = $request->total_donasi; //menset total_donasi yang diambil dari request body
        $donasi->metode = $request->metode; //menset metode yang diambil dari request body
        $donasi->status_donasi = 1; //agar status langsung ter-create
        $donasi->id_periode = $request->id_periode; //menset id_periode yang diambil dari request body
        $donasi->id_muzaki = $request->id_muzaki; //menset id_muzaki yang diambil dari request body
        $donasi->id_bank = $request->id_bank; //menset id_bank yang diambil dari request body
        $donasi->id_pengguna = $request->id_pengguna; //menset id_pengguna yang diambil dari request body

        $simpan_donasi = $donasi->save(); //menyimpan data pengguna ke database

        $detaildonasi = new DetailDonasi; //inisialisasi objek
        $detaildonasi->id_donasi = $request->id_donasi; //menset id_donasi yang diambil dari request body
        $detaildonasi->id_program = $request->id_program; //menset id_program yang diambil dari request body
        $detaildonasi->jumlah_donasi = $request->jumlah_donasi; //menset jumlah_donasi yang diambil dari request body
        $detaildonasi->keterangan = $request->keterangan; //menset keterangan yang diambil dari request body
        $detaildonasi->status_detaildonasi = $request->status_detaildonasi; //menset status_detaildonasi yang diambil dari request body

        if ($simpan_donasi) { //jika penyimpanan berhasil
            # code...
            $simpan_detaildonasi = $detaildonasi->save(); //menyimpan data detai donasi ke dataabase
            if ($simpan_detaildonasi) { //jika penyimpanan berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Berhasil Menambahkan Detail Donasi";
                $data['data'] = $detaildonasi;
            } else { //jika penyimpanan gagal
                $data['status'] = false;
                $data['message'] = "Gagal Menambahkan Detail Donasi";
                $data['data'] = null;
            }
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Donasi";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang baru disave/simpan
    }

    //delete donasi
    public function delete($id) //deklarasi delete
    {
        $donasi = Donasi::find($id); //mengambil data berdasarkan id

        if ($donasi) { //mengecek apakah data donasi ada atau tidak
            # code...
            $delete_donasi = $donasi->delete(); //menghapus data donasi

            if ($delete_donasi) { //jika fungsi hapus berhasil
                # code...
                $delete_detaildonasi = DB::table('detail_donasis')->where('id_donasi', $id)->delete(); //menghapus data detail donasi
                if ($delete_detaildonasi) { //jika fungsi hapus detaildonasi berhasil
                    # code...
                    $data['status'] = true;
                    $data['message'] = "Berhasil Menghapus Detail Donasi";
                    $data['data'] = $delete_detaildonasi;
                } else { //jika fungsi hapus detaildonasi gagal
                    $data['status'] = false;
                    $data['message'] = "Gagal Menambahkan Detail Donasi";
                    $data['data'] = null;
                }
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal diHapus";
                $data['data'] = null;
            }
        } else { //jika data tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada)
    }
}
