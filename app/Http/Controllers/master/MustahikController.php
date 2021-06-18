<?php

namespace App\Http\Controllers\master;

use DB;
use App\Mustahik;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MustahikController extends Controller
{
    //get mustahik
    public function index() //deklarasi  fungsi index
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Pengguna"; //menampilkan pesan
        $data = DB::select("SELECT * FROM mustahiks LEFT JOIN kantors ON mustahiks.id_kantor = kantors.id_kantor"); //perintah menampilkan dua  table (relasi)->relasi antara table mustahik dan tabel kantor
        return $data; //menampilkan data relasi yang telah dibuat
    }

    //create mustahik
    public function create(Request $request) //pendeklarasian fungsi create
    {
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "1840010001";

        $max_mustahik = DB::table("mustahik")->max('kode_mustahik'); // ambil id terbesar > 1840010001

        if ($max_mustahik) { // jika sudah ada data generate id baru 

            $pecah_dulu = str_split($max_mustahik, 6); // misal "1840010000" hasilnya jadi ["184001,"0001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.04d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $mustahik = new Mustahik; //inisialisasi atau menciptakan object baru
        $mustahik->kode_mustahik = $next_id; //manggil perintah next_id yang sudah dibuat
        $mustahik->nama_mustahik = $request->nama_mustahik; //menset nama_mustahik yang diambil dari request body
        $mustahik->alamat_mustahik = $request->alamat_mustahik; //menset alamat_mustahik yang diambil dari request body
        $mustahik->asnaf = $request->asnaf; //menset asnaf yang diambil dari request body
        $mustahik->telepon_mustahik = $request->telepon_mustahik; //menset telepon yang diambil dari request body
        $mustahik->kategori_mustahik = $request->kategori_mustahik; //menset kategori_mustahik yang diambil dari request body
        $mustahik->status_mustahik = 1; //agar status langsung ter-create 
        $mustahik->id_kantor = $request->id_kantor; //menset id_kantor yang diambil dari request body

        $simpan = $mustahik->save(); //menyimpan data mustahik ke database
        if ($simpan) { //jika penyimpanan berhasil
            $data['status'] = true;
            $data['message'] = "Berhasil Menambahkan Data Mustahik";
            $data['data'] = $mustahik;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Mustahik";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru di save/simpan
    }

    //update mustahik
    public function update(Request $request, $id) //pendeklarasian fungsi
    {

        $mustahik = Mustahik::find($id); //mengambil data berdasarkan id

        if ($mustahik) { //jika data yang diambil ada maka akan dieksekusi
            # code...
            //mengambil nilai lama
            $kode_mustahik = $request->kode_mustahik;
            $nama_mustahik = $request->nama_mustahik;
            $alamat_mustahik = $request->alamat_mustahik;
            $asnaf = $request->asnaf;
            $telepon_mustahik = $request->telepon_mustahik;
            $kategori_mustahik = $request->kategori_mustahik;
            $status_mustahik = $request->status_mustahik;
            $id_kantor = $request->id_kantor;

            //menset nilai yang baru/update
            $mustahik->kode_mustahik = $kode_mustahik;
            $mustahik->nama_mustahik = $nama_mustahik;
            $mustahik->alamat_mustahik = $alamat_mustahik;
            $mustahik->asnaf = $asnaf;
            $mustahik->telepon_mustahik = $telepon_mustahik;
            $mustahik->kategori_mustahik = $kategori_mustahik;
            $mustahik->status_mustahik = $status_mustahik;
            $mustahik->id_kantor = $id_kantor;

            $data['data'] = $mustahik; //menampilkan data mustahik
            $update = $mustahik->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Update";
                $data['data'] = $mustahik;
            } else { //jika gagal update
                $data['status'] = false;
                $data['message'] = "Data Gagal di Update";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang berhasil diupdate (berhasil/gagal/data tidak ada)
    }


    //delete mustahik
    public function delete($id) //deklarasi fungsi delete
    {
        $mustahik = Mustahik::find($id); //mengambil data berdasarkan id

        if ($mustahik) { //mengecek data apakah ada atau tidak
            # code...
            $delete = $mustahik->delete();  //menghapus data pengguna
            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $mustahik;
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $data['data'] = null;
            }
        } else { //data yang dihapus tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada)
    }
}
