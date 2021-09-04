<?php

namespace App\Http\Controllers\master;

use DB;
use App\Muzaki;
use App\Pengguna;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class MuzakiController extends Controller
{
    //get Muzaki
    public function index() //deklarasi  fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Muzaki"; //menampilkan pesan
        $data['data'] = DB::select("SELECT * FROM muzakis LEFT JOIN penggunas ON muzakis.id_pengguna = Penggunas.id_pengguna");
        //perintah menampilkan dua  table (relasi)->relasi antara table muzaki, table pengguna
        return $data; //menampilkan data relasi yang telah dibuat
    }

    //get pengguna by id
    public function show($id) //deklarasi fungsi show
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Muzaki"; //menampilkan pesan
        $data['data'] = Muzaki::find($id); //mengambil semua data dari database
        return $data; //menampilkan data relasi yang telah dibuat
    }

    //create muzaki
    public function create(Request $request) //pendeklarasian fungsi create
    {
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "1011110001";

        $max_muzaki = DB::table("muzakis")->max('npwz'); // ambil id terbesar > 1011110001

        if ($max_muzaki) { // jika sudah ada data generate id baru 

            $pecah_dulu = str_split($max_muzaki, 6); // misal "1011110000" hasilnya jadi ["101111","0001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.04d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $muzaki = new Muzaki; //inisialisasi atau menciptakan object baru
        $muzaki->npwz = $next_id; //manggil perintah next_id yang sudah dibuat
        //$muzaki->npwp = $request->npwp; //menset npwp yang diambil dari request body
        $muzaki->nik = $request->nik; //menset nik yang diambil dari request body
        $muzaki->nama_muzaki = $request->nama_muzaki; //menset nama_muzaki yang diambil dari request body
        $muzaki->jk = $request->jk; //menset jk yang diambil dari request body
        $muzaki->alamat_muzaki = $request->alamat_muzaki; //menset alamat_muzaki yang diambil dari request body
        $muzaki->profesi = $request->profesi; //menset telepon yang diambil dari request body
        $muzaki->telepon_muzaki = $request->telepon_muzaki; //menset telepon yang diambil dari request body
        $muzaki->kategori_muzaki = $request->kategori_muzaki; //menset kategori_muzaki yang diambil dari request body
        $muzaki->status_muzaki = 1; //agar status langsung ter-create 
        $muzaki->id_pengguna = $request->id_pengguna; //menset id_pengguna yang diambil dari request body
        $simpan = $muzaki->save(); //menyimpan data muzaki ke database
        if ($simpan) { //jika penyimpanan berhasil
            $data['status'] = true;
            $data['message'] = "Berhasil menambahkan Data Muzaki";
            $data['data'] = $muzaki;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "gagal menambahkan Data Muzaki ";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang baru di save/simpan
    }

    //update muzaki
    public function update(Request $request, $id) //pendeklarasian fungsi update
    {
        $muzaki = Muzaki::find($id); //mengambil data berdasarkan id

        if ($muzaki) { //jika data yang diambil ada maka akan dieksekusi
            # code...
            //menset nilai yang baru/update
            $muzaki->nama_muzaki = $request->nama_muzaki;
            $muzaki->jk = $request->jk;
            $muzaki->alamat_muzaki = $request->alamat_muzaki;
            $muzaki->profesi = $request->profesi;
            $muzaki->telepon_muzaki = $request->telepon_muzaki;
            $muzaki->kategori_muzaki = $request->kategori_muzaki;
            $muzaki->status_muzaki = $request->status_muzaki;
            $muzaki->id_pengguna = $request->id_pengguna;

            $data['data'] = $muzaki; //menampilkan data muzaki
            $update = $muzaki->update(); //menyimpan perubahan data pada database 
            if ($update) { //jika berhasil update
                $data['status'] = true;
                $data['message'] = "Berhasil di Update ";
                $data['data'] = $muzaki;
            } else { //jika gagal update
                $data['status'] = false;
                $data['message'] = "Gagal di Update ";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang berhasil diupdate (berhasil/gagal/data tidak ada)
    }

    //delete muzaki
    public function delete($id) //deklarasi fungsi delete
    {
        $muzaki = Muzaki::find($id); //mengambil data muzaki berdasarkan id

        if ($muzaki) { //mengecek data muzaki apakah ada atau tidak
            # code...
            $delete = $muzaki->delete(); //menghapus data muzaki

            if ($delete) { //jika fungsi hapus berhasil
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus ";
                $data['data'] = $muzaki;
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal di Hapus ";
                $data['data'] = null;
            }
        } else { //data yang dihapus tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada)
    }

    //cetak pdf
    public function cetak_pdf(Request $request)
    {

        //menampilkan data berdasarkan id_muzaki
        $muzaki = DB::select(
            "SELECT * FROM muzakis WHERE muzakis.id_muzaki = '" . $request->id_muzaki . "'
            "
        );
        //menampilkan data berdasarkan status_muzaki
        $muzaki = DB::select(
            "SELECT * FROM muzakis WHERE muzakis.id_muzaki = '" . $request->status_muzaki . "'
            "
        );

        //perintah cetak pdf
        $pdf = PDF::loadview('laporan/laporan_muzaki', ['muzaki' => $muzaki])->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    //cetak seluruh data muzaki
    public function cetakpdf()
    {
        //menampilkan semua data muzaki
        $muzaki = DB::select(
            "SELECT * FROM muzakis"
        );

        //perintah cetak pdf
        $pdf = PDF::loadview('laporan/laporan_muzaki', ['muzaki' => $muzaki])->setPaper('A4', 'potrait');
        return $pdf->stream();
    }
}
