<?php

namespace App\Http\Controllers\master;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'username' => $request->username,
                'password' => $request->password,
            ];
            $data['message'] = "Username atau Password Kosong";
            $data['data'] = null;
            $data['status'] = false;

            return $data;
        } else { //jika validasi berhasil
            $pengguna = DB::select("SELECT * FROM penggunas WHERE penggunas.username='" . $request->username . "' ");

            if ($pengguna) { //validasi
                $password  = $pengguna[0]->password;

                if ($password == md5($request->password)) {
                    //login berhasil
                    $data['message'] = "Login Berhasil";
                    $data['data'] = $pengguna;
                    $data['status'] = true;

                    return $data;
                } else { //validasi berhasil dan login gagal
                    $data['message'] = "Username dan Password Salah";
                    $data['data'] = null;
                    $data['status'] = false;

                    return $data;
                }
            }
        }
    }

    //get pengguna
    public function index() //deklarasi  fungsi index
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Pengguna"; //menampilkan pesan
        $data['data'] = Pengguna::all(); //mengambil semua data dari database
        return $data; //menampilkan data relasi yang telah dibuat
    }

    //get pengguna by id
    public function show($id) //deklarasi fungsi show
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Pengguna"; //menampilkan pesan
        $data['data'] = Pengguna::find($id); //mengambil semua data dari database
        return $data; //menampilkan data relasi yang telah dibuat
    }

    //create pengguna
    public function create(request $request) //pendeklarasian fungsi create
    {

        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "LZAI" . date('m') . date('Y') . "0001";

        $max_pengguna = DB::table("penggunas")->max('kode_pengguna'); // ambil id terbesar > LZAIO180001

        if ($max_pengguna) { // jika sudah ada data generate id baru

            $pecah_dulu = str_split($max_pengguna, 10); // misal "LZAI180000" hasilnya jadi ["LZAI18","0001"]
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
        $pengguna->password = md5($request->password); //mengenkripsi password
        $pengguna->status_pengguna = 1; //agar status langsung ter-create

        $simpan = $pengguna->save(); //menyimpan data pengguna ke database
        if ($simpan) { //jika penyimpanan berhasil
            $data['status'] = true;
            $data['message'] = "Berhasil menambahkan Pengguna";
            $data['data'] = $pengguna;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "gagal menambahkan Pengguna";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru disave/simpan
    }

    //update pengguna(profile)
    public function update(Request $request, $id) //pendeklarasian fungsi update
    {

        $pengguna = Pengguna::find($id); //mengambil data berdasarkan id
        //$pengguna = md5($pengguna->password);

        if ($pengguna) { //jika data yang diambil ada maka akan dieksekusi
            //     # code...
            //menset nilai yang baru/update
            $pengguna->nama_pengguna = $request->nama_pengguna;
            $pengguna->alamat_pengguna = $request->alamat_pengguna;
            $pengguna->telepon_pengguna = $request->telepon_pengguna;
            $pengguna->leveluser = $request->leveluser;
            $pengguna->username = $request->username;
            $pengguna->status_pengguna = $request->status_pengguna;

            $data['data'] = $pengguna; //menampilkan data pengguna
            $update = $pengguna->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update
                $data['status'] = true;
                $data['message'] = "Berhasil di Update ";
                $data['data'] = $pengguna;
            } else { //jika gagal update
                $data['status'] = false;
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

    public function updatepassword(Request $request, $id) //pendeklarasian fungsi update
    {
        $pengguna1 = Pengguna::find($id); //mengambil data berdasarkan id
        if ($pengguna1) { //jika data yang diambil ada maka akan dieksekusi
            # code...
            //menset nilai yang baru/update
            $pengguna1->password = md5($request->password); //mengenkripsi password

            $update = $pengguna1->update(); //menyimpan perubahan data pada database

            if ($update) {
                $data['status'] = true;
                $data['message'] = "Password Berhasil di Perbarui";
                $data['data'] = $pengguna1; //menampilkan data pengguna
            } else {
                $data['status'] = false;
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
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus ";
                $data['data'] = $pengguna;
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
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
