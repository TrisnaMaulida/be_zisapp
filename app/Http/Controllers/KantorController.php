<?php

namespace App\Http\Controllers;

use App\Kantor;
use Illuminate\Http\Request;

class KantorController extends Controller
{
    //get Kantor
    public function index() //deklarasi fungsi index
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Kantor"; //menampilkan pesan
        $data['data'] = Kantor::all(); //fungsi untuk mengambil semua data tabel kantor

        return $data; //menampilkan data yang sudah diambil tadi
    }

    //create kantor
    public function create(Request $request) //deklarasi fungsi create
    {

        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "KL13070001";

        $max_kantor = DB::table("kantors")->max('no_kantor'); // ambil id terbesar >  KL13070001

        if ($max_kantor) { // jika sudah ada data generate id baru 

            $pecah_dulu = str_split($max_kantor, 6); // misal "KL13070001" hasilnya jadi ["KL1307","0001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.04d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $kantor = new Kantor; //inisialisasi objek

        $kantor->no_kantor = $next_id; //default dari  proses sebelumnya
        $kantor->nama_kantor = $request->nama_kantor; //menset nama_kantor yang diambil dari request body
        $kantor->alamat_kantor = $request->alamat_kantor; //menset alamat_kantor yang diambil dari request body
        $kantor->telepon_kantor = $request->telepon_kantor; //menset telepon yang diambil dari request body
        $kantor->pimpinan = $request->pimpinan; //menset pimpinan yang diambil dari request body

        $kantor->save(); //perintah menyimpan data "kantor" ke database

        $simpan = $kantor->save(); //menyimpan data "kantor ke database
        if ($simpan) { //penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Berhasil Menambahkan Data Kantor";
            $data['data'] = $kantor;
        } else { //penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Kantor";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru di save/simpan
    }

    //upadate Kantor
    public function update(Request $request, $id) //pendeklarasian fungsi update
    {
        $kantor = Kantor::find($id); //mengambil data berdasarkan id
        if ($kantor) {
            # code...
            //mengambil nilai lama
            $no_kantor = $request->no_kantor;
            $nama_kantor = $request->nama_kantor;
            $alamat_kantor = $request->alamat_kantor;
            $telepon_kantor = $request->telepon_kantor;
            $pimpinan = $request->pimpinan;

            //menset nilai yang baru/update
            $kantor->no_kantor = $no_kantor;
            $kantor->nama_kantor = $nama_kantor;
            $kantor->alamat_kantor = $alamat_kantor;
            $kantor->telepon_kantor = $telepon_kantor;
            $kantor->pimpinan = $pimpinan;

            $data['data'] = $kantor; //menampilkan data kantor
            $update = $kantor->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Update";
                $data['data'] = $kantor;
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

    //delete Kantor
    public function delete($id) //deklarasi fungsi delete
    {
        $kantor = Kantor::find($id); //mengambil data kantor berdasarkan id

        if ($kantor) { //mengecek data kantor apakah ada atau tidak
            # code...
            $delete = $kantor->delete(); //menghapus data kantor

            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $kantor;
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $data['data'] = null;
            }
        } else { //data yang akan dihapus tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada)
    }
}
