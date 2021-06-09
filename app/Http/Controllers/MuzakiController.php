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
        $muzaki->nama_muzaki = $request->nama_muzaki;
        $muzaki->jk = $request->jk;
        $muzaki->alamat = $request->alamat;
        $muzaki->profesi = $request->profesi;
        $muzaki->no_hp = $request->no_hp;
        $muzaki->kategori = $request->kategori;
        $muzaki->status = $request->status;
        $muzaki->kode_petugas = $request->kode_petugas;
        $muzaki->no_kantor = $request->no_kantor;

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
        $nama_muzaki = $request->nama_muzaki;
        $jk = $request->jk;
        $alamat = $request->alamat;
        $profesi = $request->profesi;
        $no_hp = $request->no_hp;
        $kategori = $request->kategori;
        $status = $request->status;
        $kode_petugas = $request->kode_petugas;
        $no_kantor = $request->no_kantor;


        $muzaki = Muzaki::find($id);
        $muzaki->npwz = $npwz;
        $muzaki->nik = $nik;
        $muzaki->nama_muzaki = $nama_muzaki;
        $muzaki->jk = $jk;
        $muzaki->alamat = $alamat;
        $muzaki->profesi = $profesi;
        $muzaki->no_hp = $no_hp;
        $muzaki->kategori = $kategori;
        $muzaki->kode_petugas = $kode_petugas;
        $muzaki->no_kantor = $no_kantor;

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
