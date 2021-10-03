<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\SubKatAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\elementType;

class SubKatAkunController extends Controller
{
    //get sub kat akun
    public function index() //deklarasi fungsi index
    {
        // $data['status'] = true; //menampilkan status
        // $data['message'] = "Data Sub Kat Akun"; //menampilkan pesan
        $data['data'] = DB::select("SELECT * FROM sub_kat_akuns LEFT JOIN kat_akuns ON sub_kat_akuns.id_kat_akun = kat_akuns.id_kat_akun");
        //menampilkan dua table (relasi) -> realisasi antara table sub_kat_akuns dengan kat_akuns 
        return $data; //menampilkan hasil dari proses pengambilan data
    }

    //create Sub Kat Akun
    public function create(Request $request) //deklarasi fungsi create
    {
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "SUB_KAT_AKN_" . date('m') . date('Y') . "00000001";

        $max_sub_kat_akun = DB::table("sub_kat_akuns")->max('kode_sub_kat_akun'); // ambil id terbesar > 1011110001

        if ($max_sub_kat_akun) { // jika sudah ada data generate id baru 

            $pecah_dulu = str_split($max_sub_kat_akun, 14); // misal "1011110000" hasilnya jadi ["101111","0001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.04d", $increment_id + 1);
            $next_id = $pecah_dulu[0] . $result;
        }

        $subkatakun = new SubKatAkun; //inisialisasi object baru
        $subkatakun->id_kat_akun = $request->id_kat_akun; //menset id_kat_akun yang diambil dari request body
        $subkatakun->nama_sub_kat_akun = $request->nama_sub_kat_akun; //menset nama_sub_kat_akun yang diambil dari request body
        $subkatakun->kode_sub_kat_akun = $next_id; //menset kode_sub_kat_akun

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
            $subkatakun->id_kat_akun = $request->id_kat_akun;
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
