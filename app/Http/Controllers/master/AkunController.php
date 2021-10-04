<?php

namespace App\Http\Controllers\master;

use App\Akun;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    //get Akun
    public function index() //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Akun"; //menampilkan pesan
        $data['data'] = Akun::all(); //mengambil semua data akun
        return $data; //menampilkan hasil dari proses pengambilan data
    }


    //create Akun
    public function create(Request $request) //pendeklarasian fungsi create
    {
        $akun = new Akun;  //inisialisasi atau menciptakan object baru
        $akun->nama_akun = $request->nama_akun; //menset nama_akun yang diambil dari request body


        $simpan = $akun->save(); //menyimpan data pengguna ke database
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Data Akun Berhasil ditambahkan";
            $data['data'] = $akun;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Akun";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru di save/simpan
    }

    //update
    public function update(Request $request, $id) ////pendeklarasian fungsi
    {
        $akun = Akun::find($id);

        if ($akun) {
            # code...
            //menset nilai yang baru/update
            $akun->nama_akun = $request->nama_akun;

            $data['data'] = $akun; //menampilkan data akun
            $update = $akun->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update 
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $akun;
            } else { //jika gagal update
                $data['status'] = false;
                $data['message'] = "Data Gagal diUpdate";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang berhasil diupdate (berhasil/gagal/data tidak ada)
    }

    //delete akun
    public function delete($id) //deklarasi fungsi delete
    {
        $akun = Akun::find($id); //mengambil data akun berdasarkan id

        if ($akun) { //mengecek data akun apakah ada atau tidak
            # code...
            $delete = $akun->delete(); //menghapus data akun
            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $akun;
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
