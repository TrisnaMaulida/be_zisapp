<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\SubKatAkun;
use Illuminate\Http\Request;

use function PHPSTORM_META\elementType;

class SubKatAkunController extends Controller
{
    //get sub kat akun
    public function index() //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Sub Kat Akun"; //menampilkan pesan
        $data['data'] = SubKatAkun::all(); //mengambil semua data sub kat akun
        return $data; //menampilkan hasil dari proses pengambilan data
    }

    //create Sub Kat Akun
    public function create(Request $request) //deklarasi fungsi create
    {
        $subkatakun = new SubKatAkun; //inisialisasi object baru
        $subkatakun->kategori = $request->kategori; //menset kategori yang diambil dari request body
        $subkatakun->nama_sub_kat_akun = $request->nama_sub_kat_akun; //menset nama_sub_kat_akun yang diambil dari request body
        $subkatakun->kode_sub_kat_akun = $request->kode_sub_kat_akun; //menset kode_sub_kat_akun

        $simpan = $subkatakun->save(); //menyimpan data ke database
        if ($simpan) { //jika penyimpanan berhasil
            $data['status'] = true;
            $data['message'] = "Data Sub Kat Akun Berhasil ditambahkan";
            $data['data'] = $subkatakun;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Data Sub Kat Akun Gagal ditambahkan";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru di save/simpan
    }

    //update Sub Kat Akun
    public function update(Request $request, $id) //pendeklarasian fungsi
    {
        $subkatakun = SubKatAkun::find($id);

        if ($subkatakun) {
            //menset nilai yang baru/update
            $subkatakun->nama_sub_kat_akun = $request->nama_sub_kat_akun;

            $data['data'] = $subkatakun; //menampilkan data sub kat akun
            $update = $subkatakun->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil diupdate
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $subkatakun;
            } else { //jika data gagal diUpdate
                $data['status'] = false;
                $data['message']  = "Data Gagal diUpdate";
                $data['data'] =  null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang berhasil diupdate (berhasil/gagal/data tidak ditemukan)
    }

    //delete Sub Kat Akun
    public function delete($id) //deklarasi fungsi delete
    {
        $subkatakun = SubKatAkun::find($id); //mengambil data berdasarkan id

        if ($subkatakun) { //mengecek apakah datanya ada atau tidak
            $delete = $subkatakun->delete();
            if ($delete) { //jika fungsi berhasil di hapus
                $data['status'] = true;
                $data['message'] = "Data Berhasil dihapus";
                $data['data'] = $subkatakun;
            } else { //jika fungsi gagal di hapus
                $data['status'] = false;
                $data['message'] = "Data Gagal dihapus";
                $data['data'] = null;
            }
        } else { //data yang dihapus tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ditemukan";
            $data['data'] = null;
        }

        return $data; //menampilkan hasil data yang dihapus
    }
}
