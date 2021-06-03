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
        $muzaki->kantor = $request->kantor;

        $data['status'] = 200;
        $data['data'] = $muzaki;
        $data['message'] = "User Baru Berhasil dibuat";

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
        $kantor = $request->kantor;


        $muzaki = Muzaki::find($id);
        $muzaki->npwz = $npwz;
        $muzaki->nik = $nik;
        $muzaki->nama = $nama;
        $muzaki->jk = $jk;
        $muzaki->kategori = $kategori;
        $muzaki->alamat = $alamat;
        $muzaki->phone = $phone;
        $muzaki->petugas = $petugas;
        $muzaki->kantor = $kantor;
        $muzaki->save();

        return "Data Muzaki Berhasil diUpdate";
        return $muzaki;
    }

    //delete muzaki
    public function delete($id)
    {
        $muzaki = Muzaki::find($id);
        $muzaki->delete();

        return "Muzaki berhasil di Hapus";
    }
}
