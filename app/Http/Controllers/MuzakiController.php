<?php

namespace App\Http\Controllers;

use App\Muzaki;
use Illuminate\Http\Request;

class MuzakiController extends Controller
{
    //get Muzaki
    public function index()
    {
        $data['status'] = 200;
        $data['data'] = Muzaki::all();

        return $data;
    }

    //create muzaki
    public function create(Request $request)
    {
        $muzaki = new Muzaki;
        $muzaki->npwz = $request->npwz;
        $muzaki->nik = $request->nik;
        $muzaki->nama = $request->nama;
        $muzaki->jk = $request->jk;
        $muzaki->kategori = $request->kategori;
        $muzaki->alamat = $request->alamat;
        $muzaki->phone = $request->phone;
        $muzaki->petugas = $request->petugas;
        $muzaki->kantor_layanan = $request->kantor_layanan;

        $simpan = $muzaki->save();
        if ($simpan) {
            $data['status'] = true;
            $data['message'] = "Berhasil menambahkan ";
            $data['data'] = $muzaki;
        } else {
            $data['status'] = false;
            $data['message'] = "gagal menambahkan ";
            $data['data'] = null;
        }
        return $data;
    }

    //update muzaki
    public function update(Request $request, $id)
    {
        $npwz = $request->npwz;
        $nik = $request->nik;
        $nama = $request->nama;
        $jk = $request->jk;
        $kategori = $request->kategori;
        $alamat = $request->alamat;
        $phone = $request->phone;
        $petugas = $request->petugas;
        $kantor_layanan = $request->kantor_layanan;


        $muzaki = Muzaki::find($id);
        $muzaki->npwz = $npwz;
        $muzaki->nik = $nik;
        $muzaki->nama = $nama;
        $muzaki->jk = $jk;
        $muzaki->kategori = $kategori;
        $muzaki->alamat = $alamat;
        $muzaki->phone = $phone;
        $muzaki->petugas = $petugas;
        $muzaki->kantor_layanan = $kantor_layanan;

        $update = $muzaki->update();
        if ($update) {
            $data['status'] = true;
            $data['message'] = "Berhasil di Update ";
            $data['data'] = $muzaki;
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal di Update ";
            $data['data'] = null;
        }
        return $data;
    }

    //delete muzaki
    public function delete($id)
    {
        $muzaki = Muzaki::find($id);
        $delete = $muzaki->delete();

        if ($delete) {
            $data['status'] = true;
            $data['message'] = "Data Berhasil di Hapus ";
            $data['data'] = $muzaki;
        } else {
            $data['status'] = false;
            $data['message'] = "Data Gagal di Hapus ";
            $data['data'] = null;
        }

        return $data;
    }
}
