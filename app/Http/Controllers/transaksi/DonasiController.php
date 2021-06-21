<?php

namespace App\Http\Controllers\transaksi;

use App\Donasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonasiController extends Controller
{
    //get donasi
    public function index() //deklarasi fungsi index
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Donasi"; //menampilkan pesan
        $data['data'] = DB::select("SELECT *FROM donasis LEFT JOIN penggunas ON donasis.id_pengguna = penggunas.id_pengguna 
                                                        LEFT JOIN muzakis ON donasis.id_muzaki = muzakis.id_muzaki
                                                        LEFT JOIN bank ON donasis.id_bank = bank.id_bank 
                                                        LEFT JOIN periodes ON donasis.id_periode = periodes.id_periode");
        //perintah menampilkan lima table (relasi) -> relasi antara table donasis, table penggunas, table muzakis, table bank dan table periodes
        return $data; //menampilkan data relasi yang sudah dibuat
    }

    //create donasi
    public function create(Request $request) //pendeklarasian fungsi create
    {
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "DNS-18000001";

        $max_pengguna = DB::table("donasis")->max('no_donasi'); //ambil id terbesar -> DNS-18000001

        if ($max_pengguna) { //jika sudah ada data generate id baru
            # code...
            $pecah_dulu = str_split($max_pengguna, 8); //misal "DNS-18000001" hasilnya jadi ["DNS-1800", "0001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.04d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $donasi = new Donasi; //inisalisasi atau menciptakan objek baru
        $donasi->no_donasi = $next_id; //memanggil perintah next_id yang sudah dibuat
        $donasi->no_bukti = $request->no_bukti; //menset no_bukti yang diambil dari request body
        $donasi->tgl_donasi = $request->tgl_donasi; //menset tgl_donasi yang diambil dari request body
        $donasi->total_donasi = $request->total_donasi; //menset total_donasi yang diambil dari request body
        $donasi->metode = $request->metode; //menset metode yang diambil dari request body
        $donasi->status_donasi = 1; //agar status langsung ter-create
        $donasi->id_periode = $request->id_periode; //menset id_periode yang diambil dari request body
        $donasi->id_muzaki = $request->id_muzaki; //menset id_muzaki yang diambil dari request body
        $donasi->id_bank = $request->id_bank; //menset id_bank yang diambil dari request body
        $donasi->id_pengguna = $request->id_pengguna; //menset id_pengguna yang diambil dari request body

        $simpan = $donasi->save(); //menyimpan data pengguna ke database
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Berhasil Menambahkan Donasi";
            $data['data'] = $donasi;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Donasi";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang baru disave/simpan
    }

    //update donasi
    public function update(Request $request, $id) //pendeklarasian fungsi update
    {
        $donasi = Donasi::find($id); //mengambil data berdasarkan id

        if ($donasi) { //jika data yang diambil ada maka akan dieksekusi
            # code...
            //mengambil nilai lama
            $no_donasi = $request->no_donasi;
            $no_bukti = $request->no_bukti;
            $tgl_donasi = $request->tgl_donasi;
            $total_donasi = $request->total_donasi;
            $metode = $request->metode;
            $status_donasi = $request->status_donasi;
            $id_periode = $request->id_periode;
            $id_muzaki = $request->id_muzaki;
            $id_bank = $request->id_bank;
            $id_pengguna = $request->id_pengguna;

            //menset nilai yang baru/update 
            $donasi->no_donasi = $no_donasi;
            $donasi->no_bukti = $no_bukti;
            $donasi->tgl_donasi = $tgl_donasi;
            $donasi->total_donasi = $total_donasi;
            $donasi->metode = $metode;
            $donasi->status_donasi = $status_donasi;
            $donasi->id_periode = $id_periode;
            $donasi->id_muzaki = $id_muzaki;
            $donasi->id_bank = $id_bank;
            $donasi->id_pengguna = $id_pengguna;

            $data['data'] = $donasi; //menampilkan data donasi
            $update = $donasi->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil diupdate
                # code...
                $data['status'] = true;
                $data['message'] = "Berhasil di Update";
                $data['data'] = $donasi;
            } else { //jika gagal diupdate
                $data['status'] = false;
                $data['message'] = "Gagal di Update";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang berhasil diupdate (berhasil/gagal/tidak ada)
    }

    //delete donasi
    public function delete($id) //deklarasi delete
    {
        $donasi = Donasi::find($id); //mengambil data berdasarkan id

        if ($donasi) { //mengecek apakah data donasi ada atau tidak
            # code...
            $delete = $donasi->delete(); //menghapus data donasi

            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diHapus";
                $data['data'] = $donasi;
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal diHapus";
                $data['data'] = null;
            }
        } else { //jika data tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada)
    }
}
