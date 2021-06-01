<?php

namespace App\Http\Controllers;

use App\Pengguna;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            //login sukses
            return "Login Berhasil";
        } else {
            //Login Failed
            Session::fails('error', 'Password Salah');
        }
    }

    //register
    public function register(request $request)
    {
        $rules = [
            'nama' => 'required|string',
            'email' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'leveluser' => 'required|integer'

        ];

        $messages = [
            'nama.required' => 'Nama Lengkap Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email Tidak Valid',
            'email.unique' => 'Email Sudah Terdaftar',
            'username.required' => 'Username Wajib Diisi',
            'username.unique' => 'Username Sudah Ada',
            'password.required' => 'Password Wajib Diisi',
            'leveluser.required' => 'Level User Wajib Diisi'
        ];

        $validator =  Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $pengguna = new Pengguna;
        $pengguna->nama = ucwords(strtolower($request->nama));
        $pengguna->email = strtolower($request->email);
        $pengguna->username = strtolower($request->username);
        $pengguna->password = Hash::make($request->password);
        $simpan = $pengguna->save();

        if ($simpan) {
            Session::flash('success', 'Register Berhasil! Silahkan Login');
            return "Behasil Yey";
        } else {
            Session::flash('error', ['' => 'Register Gagal']);
            return "Register Gagal";
        }
    }

    //get pengguna
    public function get()
    {
        //ini aku bingung mas, maaf ya :)
    }

    //create pengguna
    public function create(request $request)
    {
        $pengguna = new Pengguna;
        $pengguna->nama = $request->nama;
        $pengguna->email = $request->email;
        $pengguna->username = $request->username;
        $pengguna->password = $request->password;
        $pengguna->leveluser = $request->leveluser;
        $pengguna->save();

        $data['status'] = 200;
        $data['data'] = $pengguna;
        $data['message'] = "User Baru Berhasil dibuat";

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
        $pengguna->save();

        return "Data User Berhasil diUpdate";
    }

    //delete pengguna
    public function delete($id)
    {
        $pengguna = Pengguna::find($id);
        $pengguna->delete();

        return "USer Berhasil di Hapus";
    }
}
