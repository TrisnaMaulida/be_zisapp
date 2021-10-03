<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\KatAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KatAkunController extends Controller
{
    //get kat akun
    public function index() //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Kat Akun"; //menampilkan pesan
        $data['data'] = KatAkun::all(); //mengambil semua data sub kat akun
        return $data; //menampilkan hasil dari proses pengambilan data
    }

    //create Kat Akun
    public function create(Request $request) //deklarasi fungsi create
    {
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "KAT_AKN_" . date('m') . date('Y') . "00000001";

        $max_kat_akun = DB::table("kat_akuns")->max('kode_kat_akun'); // ambil id terbesar > 1011110001

        if ($max_kat_akun) { // jika sudah ada data generate id baru 

            $pecah_dulu = str_split($max_kat_akun, 14); // misal "1011110000" hasilnya jadi ["101111","0001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.08d", $increment_id + 1);
            $next_id = $pecah_dulu[0] . $result;
        }

        $katakun = new KatAkun; //inisialisasi object baru
        $katakun->kategori = $request->kategori; //menset kategori yang diambil dari request body
        $katakun->nama_kat_akun = $request->nama_kat_akun; //menset nama_sub_kat_akun yang diambil dari request body
        $katakun->kode_kat_akun = $next_id; //menset kode_sub_kat_akun

        $simpan = $katakun->save(); //menyimpan data ke database
        if ($simpan) { //jika penyimpanan berhasil
            $data['status'] = true;
            $data['message'] = "Data Sub Kat Akun Berhasil ditambahkan";
            $data['data'] = $katakun;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Data Sub Kat Akun Gagal ditambahkan";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru di save/simpan
    }

    //update Kat Akun
    public function update(Request $request, $id) //deklarasi fungsi update
    {
        $katakun = KatAkun::find($id);

        if ($katakun) {
            //menset nilai yang baru/update
            $katakun->nama_kat_akun = $request->nama_kat_akun;

            $data['data'] = $katakun; //menampilkan data kat akun
            $update = $katakun->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $katakun;
            } else { //jika gagal update
                $data['status'] = false;
                $data['messsage'] = "Data Gagal diUpdate";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang berhasil di update
    }

    //delete Kat Akun
    public function delete($id) //deklarasi fungsi delete
    {
        $katakun = KatAkun::find($id); //mengambil data berdasarkan id

        if ($katakun) { //mengecek apakah datanya ada atau tidak
            $delete = $katakun->delete();
            if ($delete) { //jika fungsi berhasil di hapus
                $data['status'] = true;
                $data['message'] = "Data Berhasil dihapus";
                $data['data'] = $katakun;
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
