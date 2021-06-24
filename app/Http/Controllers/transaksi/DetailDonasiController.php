<?php

namespace App\Http\Controllers\transaksi;

use App\DetailDonasi;
use App\Http\Controllers\Controller;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailDonasiController extends Controller
{
    //get detail donasi
    public function index() //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Detail Donasi"; //menampilkan pesan
        $data['data'] = DB::select("SELECT *FROM detail_donasis LEFT JOIN donasis ON detail_donasis.id_donasi = donasis.id_donasi
                                                                LEFT JOIN programs ON detail_donasis.id_program = programs.id_program
                                                                LEFT JOIN penggunas ON detail_donasis.id_pengguna = penggunas.id_pengguna");
        //perintah menampilkan empat table (relasi) ->relasi antara table detail_donasis, table donasis, table programs dan table penggunas

        return $data; //menampilka semua data index yang dimint
    }

    //create detail donasi
    public function create(Request $request) //deklarasi fungsi create
    {
        $detaildonasi = new DetailDonasi; //inisialisasi objek
        $detaildonasi->id_donasi = $request->id_donasi; //menset id_donasi yang diambil dari request body
        $detaildonasi->id_program = $request->id_program; //menset id_program yang diambil dari request body
        $detaildonasi->jumlah_donasi = $request->jumlah_donasi; //menset jumlah_donasi yang diambil dari request body
        $detaildonasi->keterangan = $request->keterangan; //menset keterangan yang diambil dari request body
        $detaildonasi->id_pengguna = $request->id_pengguna; //menset id_pengguna yang diambil dari request body
        $detaildonasi->status_detaildonasi = $request->status_detaildonasi; //menset status_detaildonasi yang diambil dari request body

        $simpan = $detaildonasi->save(); //menyimpan data detai donasi ke dataabase
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Berhasil Menambahkan Detail Donasi";
            $data['data'] = $detaildonasi;
        } else { //jika penyimpanan gagal
            $data['status'] = true;
            $data['message'] = "Gagal Menambahkan Detail Donasi";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang baru disave/simpan 
    }

    //delete detail donasi
    public function delete($id) //deklarasi fungsi delete
    {
        $detaildonasi = DetailDonasi::find($id); //mengambil data berdasrkan id

        if ($detaildonasi) { //mengecek apakah data detail donasu ada atau tidak
            # code...
            $delete = $detaildonasi->delete(); //menghapus data detail donasi

            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diHapus";
                $data['data'] = $detaildonasi;
            } else { //jika fungsi hapus gagal
                $data['status'] = true;
                $data['message'] = "Data Gagal diHapus";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = true;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada data)
    }
}
