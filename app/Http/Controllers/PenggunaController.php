<?php

namespace App\Http\Controllers;

use App\Pengguna;
use Illuminate\Support\Facades\Hash;
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

        $pengguna = DB::select("SELECT * FROM Penggunas WHERE username='" . $request->input("username") . "' AND password='" . $request->input("password") . "'");

        if ($pengguna) {
            $data['message'] = "Login Berhasil";
            $data['data'] = $pengguna;
            $data['status'] = true;
            return $pengguna;
        } else {
            $data['message'] = "Login Gagal";
            $data['data'] = null;
            $data['status'] = false;
        }
    }


    //get pengguna
    public function index()
    {
        $data['status'] = 200;
        $data['data'] = Pengguna::all();

        return $data;
    }

    //create pengguna
    public function create(request $request)
    {
        $pengguna = new Pengguna;
        $pengguna->kode_pengguna = $request->kode_pengguna;
        $pengguna->nama_pengguna = $request->nama_pengguna;
        $pengguna->alamat = $request->alamat;
        $pengguna->no_hp = $request->no_hp;
        $pengguna->leveluser = $request->leveluser;
        $pengguna->username = $request->username;
        $pengguna->password = $request->password;
        $pengguna->status = $request->status; //ini ditulis ga ya?
        $pengguna->no_kantor = $request->no_kantor;

        $pengguna->save();


        $simpan = $pengguna->save();
        if ($simpan) {
            $data['status'] = true;
            $data['message'] = "Berhasil menambahkan ";
            $data['data'] = $pengguna;
        } else {
            $data['status'] = false;
            $data['message'] = "gagal menambahkan ";
            $data['data'] = null;
        }
        return $data;
    }

    //update pengguna
    public function update(request $request, $id)
    {
        $nama = $request->nama;
        $email = $request->email;
        $username = $request->username;
        $password = $request->password;
        $leveleuser = $request->leveluser;


        $pengguna = Pengguna::find($id);
        $pengguna->nama = $nama;
        $pengguna->email = $email;
        $pengguna->username = $username;
        $pengguna->password = $password;
        $pengguna->leveluser = $leveleuser;

        $update = $pengguna->update();
        if ($update) {
            $data['status'] = true;
            $data['message'] = "Berhasil di Update ";
            $data['data'] = $pengguna;
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal di Update ";
            $data['data'] = null;
        }
        return $data;
    }

    //delete pengguna
    public function delete($id)
    {
        $pengguna = Pengguna::find($id);
        $delete = $pengguna->delete();

        if ($delete) {
            $data['status'] = true;
            $data['message'] = "Data Berhasil di Hapus ";
            $data['data'] = $pengguna;
        } else {
            $data['status'] = false;
            $data['message'] = "Data Gagal di Hapus ";
            $data['data'] = null;
        }

        return $data;
    }
}
