<?php

namespace App\Http\Controllers\master;

use DB;
use App\Http\Controllers\Controller;
use App\Kas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    //get kas
    public function index() //deklarasi fungsi index
    {
        $data["status"] = true; //menampilkan status
        $data["message"] = "Menampilkan Data Kas";  //menampilkan pesan
        $data["data"] = DB::select("SELECT * FROM kass LEFT JOIN akuns ON kass.id_akun = akuns.id_akun"); //perintah menampilkan dua  table (relasi)->relasi antara table kas dan tabel akun
        return $data; //menampilkan data relasi yang telah dibuat
    }

    //create kas
    public function create(Request $request)
    {
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "10001";

        $max_kas = DB::table("kass")->max('kode_kas'); // ambil id terbesar > 10001

        if ($max_kas) { // jika sudah ada data generate id baru 

            $pecah_dulu = str_split($max_kas, 3); // misal "10001" hasilnya jadi ["10","001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.02d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $kas = new Kas; //inisialisasi
        $kas->kode_kas = $next_id; //pemanggilan perintah next_id
        $kas->nama_kas = $request->nama_kas; //menset nama_kas yang diambil dari request body
        $kas->id_akun = $request->id_akun; //menset id_akun yang diambil dari request body

        $simpan = $kas->save(); //menyimpan data pengguna ke database
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status_kas'] = true;
            $data['message'] = "Berhasil Menambahkan Data Kas";
            $data['data'] = $kas;
        } else { //jika penyimpanan gagal
            $data['status_kas'] = false;
            $data['message'] = "Gagal Menambahkan Data Kas";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru disave/simpan
    }

    //update kas
    public function update(Request $request, $id) //pendeklarasian fungsi update
    {
        $kas = Kas::find($id); //mengambil data berdasarkan id

        if ($kas) {
            # code...
            //menset  nilai yang baru/update
            $kas->nama_kas = $request->nama_kas;
            $kas->id_akun = $request->id_akun;

            $data['data'] = $kas; //menampilkan data kas
            $update = $kas->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update
                # code...
                $data['status_mustahik'] = true;
                $data['message'] = "Data Berhasil di Update";
                $data['data'] = $kas;
            } else { //jika gagal update
                $data['status_mustahik'] = false;
                $data['message'] = "Data Gagal di Update";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang berhasil diupdate (berhasil/gagal/tidak ada)
    }

    //delete kas
    public function delete($id) //deklarasi fungsi update
    {
        $kas = Kas::find($id); //mengambil data kas berdasarkan id

        if ($kas) { //mengecek data kas apakah ada atau tidak
            # code...
            $delete = $kas->delete(); //menghapus data kas

            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status_kas'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $kas;
            } else { //jika fungsi hapus gagal
                $data['status_kas'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $data['data'] = null;
            }
        } else { //data yang dihapus tidak ada
            $data['status_kas'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada)
    }
}
