<?php

namespace App\Http\Controllers;

use App\Pengguna;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    //login
    public function login(request $request)
    {
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string'
        ];

        $messages = [
            'username.required' => 'Username Wajib Diisi',
            'username.string' => 'Username Tidak Valid',
            'password.required' => 'Password Wajib Diisi',
            'password.string' => 'Password Tidak Valid'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            $data = [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ];

            return $data;
        }

        $pengguna = DB::select("SELECT * FROM Penggunas WHERE username='" . $request->input("username") . "' 
                                AND password='" . $request->input("password") . "'");

        if ($pengguna) {
            $data['message'] = "Login Berhasil";
            $data['data'] = $pengguna;
            $data['status_pengguna'] = true;
            return $pengguna;
        } else {
            $data['message'] = "Login Gagal";
            $data['data'] = null;
            $data['status_pengguna'] = false;
        }
    }


    //get pengguna
    public function index()
    {
        $data['status_pengguna'] = 200;
        $data['data'] = Pengguna::all();

        $data = DB::select("SELECT * FROM penggunas LEFT JOIN kantors ON penggunas.id_kantor = kantors.id_kantor");
        return $data;
    }

    //create pengguna
    public function create(request $request)
    {
        $pengguna = new Pengguna;
        $pengguna->kode_pengguna = $request->kode_pengguna;
        $pengguna->nama_pengguna = $request->nama_pengguna;
        $pengguna->alamat_pengguna = $request->alamat_pengguna;
        $pengguna->telepon_pengguna = $request->telepon_pengguna;
        $pengguna->leveluser = $request->leveluser;
        $pengguna->username = $request->username;
        $pengguna->password = $request->password;
        $pengguna->status_pengguna(1);
        $pengguna->id_kantor = $request->id_kantor;

        $pengguna->save();


        $simpan = $pengguna->save();
        if ($simpan) {
            $data['status_pengguna'] = true;
            $data['message'] = "Berhasil menambahkan ";
            $data['data'] = $pengguna;
        } else {
            $data['status_pengguna'] = false;
            $data['message'] = "gagal menambahkan ";
            $data['data'] = null;
        }
        return $data;
    }

    //update pengguna
    public function update(request $request, $id)
    {
        $kode_pengguna = $request->kode_pengguna;
        $nama_pengguna = $request->nama_pengguna;
        $alamat_pengguna = $request->alamat_pengguna;
        $telepon_pengguna = $request->telepon_pengguna;
        $leveleuser = $request->leveluser;
        $username = $request->username;
        $password = $request->password;
        $status_pengguna = $request->status_pengguna;
        $id_kantor = $request->id_kantor;



        $pengguna = Pengguna::find($id);

        if ($pengguna) {
            # code...
            $pengguna->kode_pengguna = $kode_pengguna;
            $pengguna->nama_pengguna = $nama_pengguna;
            $pengguna->alamat_pengguna = $alamat_pengguna;
            $pengguna->telepon_pengguna = $telepon_pengguna;
            $pengguna->leveluser = $leveleuser;
            $pengguna->username = $username;
            $pengguna->password = $password;
            $pengguna->status_pengguna = $status_pengguna;
            $pengguna->id_kantor = $id_kantor;

            $data['data'] = $pengguna;
            $update = $pengguna->update();
            if ($update) {
                $data['status_pengguna'] = true;
                $data['message'] = "Berhasil di Update ";
                $data['data'] = $pengguna;
            } else {
                $data['status_pengguna'] = false;
                $data['message'] = "Gagal di Update ";
                $data['data'] = null;
            }
        } else {
            $data['data'] = null;
        }
        return $data;
    }

    //delete pengguna
    public function delete($id)
    {
        $pengguna = Pengguna::find($id);

        if ($pengguna) {
            # code...
            $delete = $pengguna->delete();
            if ($delete) {
                $data['status_pengguna'] = true;
                $data['message'] = "Data Berhasil di Hapus ";
                $data['data'] = $pengguna;
            } else {
                $data['status_pengguna'] = false;
                $data['message'] = "Data Gagal di Hapus ";
                $data['data'] = null;
            }
        } else {
            $data['data'] = null;
        }

        return $data;
    }
}
