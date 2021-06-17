<?php

namespace App\Http\Controllers;

use App\Pengguna;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    //login
    public function login(request $request) //deklarasi fungsi login
    {
        //membuat rules atau aturan
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string'
        ];

        //membuat pesan validasi
        $messages = [
            'username.required' => 'Username Wajib Diisi',
            'username.string' => 'Username Tidak Valid',
            'password.required' => 'Password Wajib Diisi',
            'password.string' => 'Password Tidak Valid'
        ];

        //proses validasi
        $validator = Validator::make($request->all(), $rules, $messages);

        //jika validasi gagal
        if ($validator->fails()) {

            $data = [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ];
            $data['message'] = "Login Gagal";
            $data['data'] = null;
            $data['status_pengguna'] = false;

            return $data;
        } else { //jika validasi berhasil
            $pengguna = DB::select("SELECT * FROM Penggunas WHERE username='" . $request->input("username") . "' 
            AND password='" . $request->input("password") . "'");

            if ($pengguna) { //validasi berhasil dan login berhasil
                $data['message'] = "Login Berhasil";
                $data['data'] = $pengguna;
                $data['status'] = true;

                return $pengguna;
            } else { //validasi berhasil dan login gagal
                $data['message'] = "Login Gagal";
                $data['data'] = null;
                $data['status'] = false;
            }
            return $data;
        }
    }


    //get pengguna
    public function index() //deklarasi  fungsi index
    {
        $data['status_pengguna'] = 200; //menampilkan status
        $data['message'] = "Data Pengguna"; //menampilkan pesan
        $data['data'] = Pengguna::all(); //menampilkan semua data yang ada di tabel Pengguna

        $data = DB::select("SELECT * FROM penggunas LEFT JOIN kantors ON penggunas.id_kantor = kantors.id_kantor"); //perintah menampilkan dua  table (relasi)->relasi antara table pengguna dan tabel kantor
        return $data; //menampilkan data relasi yang telah dibuat
    }

    //create pengguna
    public function create(request $request) //pendeklarasian fungsi 
    {

        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "LZAI180000";

        $max_pengguna = DB::table("penggunas")->max('kode_pengguna'); // ambil id terbesar > 1011110000

        if ($max_pengguna) { // jika sudah ada data generate id baru 

            $pecah_dulu = str_split($max_pengguna, 6); // misal "LZAI180000" hasilnya jadi ["LZAI18","0000"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.04d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $pengguna = new Pengguna; //inisialisasi atau menciptakan object baru
        $pengguna->kode_pengguna = $next_id; //manggil perintah next_id yang sudah dibuat
        $pengguna->nama_pengguna = $request->nama_pengguna; //menset nama_pengguna yang diambil dari request body
        $pengguna->alamat_pengguna = $request->alamat_pengguna; //menset alamat_pengguna yang diambil dari request body
        $pengguna->telepon_pengguna = $request->telepon_pengguna; //menset telepon_pengguna yang diambil dari request body
        $pengguna->leveluser = $request->leveluser; //menset leveluser yang diambil dari request body
        $pengguna->username = $request->username; //menset username yang diambil dari request body
        $pengguna->password = $request->password; //menset password yang diambil dari request body
        $pengguna->status_pengguna = 1; //agar status langsung ter-create 
        $pengguna->id_kantor = $request->id_kantor; //menset id_kantor yang diambil dari request body

        $pengguna->save(); //perintah menyimpan data "pengguna" ke database


        $simpan = $pengguna->save(); //menyimpan data pengguna ke database
        if ($simpan) { //penyimpanan berhasil
            $data['status_pengguna'] = true;
            $data['message'] = "Berhasil menambahkan ";
            $data['data'] = $pengguna;
        } else { //penyimpanan gagal
            $data['status_pengguna'] = false;
            $data['message'] = "gagal menambahkan ";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru di save/simpan
    }

    //update pengguna
    public function update(request $request, $id) //pendeklarasian fungsi
    {

        $pengguna = Pengguna::find($id); //mengambil data berdasarkan id

        if ($pengguna) { //jika data yang diambil ada maka akan dieksekusi
            # code...
            //mengambil nilai lama
            $kode_pengguna = $request->kode_pengguna;
            $nama_pengguna = $request->nama_pengguna;
            $alamat_pengguna = $request->alamat_pengguna;
            $telepon_pengguna = $request->telepon_pengguna;
            $leveleuser = $request->leveluser;
            $username = $request->username;
            $password = $request->password;
            $status_pengguna = $request->status_pengguna;
            $id_kantor = $request->id_kantor;

            //menset nilai yang baru/update
            $pengguna->kode_pengguna = $kode_pengguna;
            $pengguna->nama_pengguna = $nama_pengguna;
            $pengguna->alamat_pengguna = $alamat_pengguna;
            $pengguna->telepon_pengguna = $telepon_pengguna;
            $pengguna->leveluser = $leveleuser;
            $pengguna->username = $username;
            $pengguna->password = $password;
            $pengguna->status_pengguna = $status_pengguna;
            $pengguna->id_kantor = $id_kantor;

            $data['data'] = $pengguna; //menampilkan data pengguna
            $update = $pengguna->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update 
                $data['status_pengguna'] = true;
                $data['message'] = "Berhasil di Update ";
                $data['data'] = $pengguna;
            } else { //jika gagal update
                $data['status_pengguna'] = false;
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

    //delete pengguna
    public function delete($id) //deklarasi fungsi delete
    {
        $pengguna = Pengguna::find($id); //mengambil data pengguna berdasarkan id

        if ($pengguna) { //mengecek data pengguna apakah ada atau tidak
            # code...
            $delete = $pengguna->delete(); //menghapus data pengguna
            if ($delete) { //jika fungsi hapus berhasil
                $data['status_pengguna'] = true;
                $data['message'] = "Data Berhasil di Hapus ";
                $data['data'] = $pengguna;
            } else { //jika fungsi hapus gagal
                $data['status_pengguna'] = false;
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
}
