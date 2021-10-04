<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\SubAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubAkunController extends Controller
{
    //get SubAkun
    public function index() //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Sub Akun"; //menampilkan pesan
        $data['data'] = DB::select("SELECT * FROM sub_akuns LEFT JOIN akuns ON sub_akuns.id_akun = akuns.id_akun");
        //relasi dua table antara table akuns dengan tabel sub akun
        return $data; //menampilkan hasil dari proses pengambilan data
    }

    //create SubAkun
    public function create(Request $request) //pendeklarasian fungsi create
    {
        $sub_akun = new SubAkun();  //inisialisasi atau menciptakan object baru
        $sub_akun->id_akun = $request->id_akun; //menset id_akun yang diambil dari request body
        $sub_akun->nama_sub_akun = $request->nama_sub_akun; //menset nama_sub_akun yang diambil dari request body


        $simpan = $sub_akun->save(); //menyimpan data pengguna ke database
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Data Akun Berhasil ditambahkan";
            $data['data'] = $sub_akun;
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
        $sub_akun = SubAkun::find($id);

        if ($sub_akun) {
            # code...
            //menset nilai yang baru/update

            $sub_akun->nama_sub_akun = $request->nama_sub_akun;

            $data['data'] = $sub_akun; //menampilkan data akun
            $update = $sub_akun->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update 
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $sub_akun;
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

    //delete Sub Akun
    public function delete($id) //deklarasi fungsi delete
    {
        $sub_akun = SubAkun::find($id); //mengambil data akun berdasarkan id

        if ($sub_akun) { //mengecek data akun apakah ada atau tidak
            # code...
            $delete = $sub_akun->delete(); //menghapus data akun
            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $sub_akun;
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
