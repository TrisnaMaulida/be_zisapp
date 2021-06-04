<?php

namespace App\Http\Controllers;

use App\Mustahik;
use Illuminate\Http\Request;

class MustahikController extends Controller
{
    //get mustahik
    public function index()
    {
        $data['status'] = 200;
        $data['data'] = Mustahik::all();

        return $data;
    }

    //create mustahik
    public function create(Request $request)
    {
        $mustahik = new Mustahik;
        $mustahik->kode = $request->kode;
        $mustahik->nama = $request->nama;
        $mustahik->alamat = $request->alamat;
        $mustahik->telepon = $request->telepon;
        $mustahik->kategori = $request->kategori;
        $mustahik->aktif = $request->aktif;
        $mustahik->no_kantor = $request->no_kantor;
        $mustahik->kantor_layanan = $request->kantor_layanan;

        $simpan = $mustahik->save();
        if ($simpan) {
            $data['status'] = true;
            $data['message'] = "Berhasil Menambahkan Data Mustahik";
            $data['data'] = $mustahik;
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal Menambhakan Data Mustahik";
            $data['data'] = null;
        }

        return $data;
    }

    //update mustahik
    public function update(Request $request, $id)
    {
        $kode = $request->kode;
        $nama = $request->nama;
        $alamat = $request->alamat;
        $telepon = $request->telepon;
        $kategori = $request->kategori;
        $aktif = $request->aktif;
        $no_kantor = $request->no_kantor;
        $kantor_layanan = $request->kantor_layanan;

        $mustahik = Mustahik::find($id);
        $mustahik->kode = $kode;
        $mustahik->nama = $nama;
        $mustahik->telepon = $telepon;
        $mustahik->kategori = $kategori;
        $mustahik->aktif = $aktif;
        $mustahik->no_kantor = $no_kantor;
        $mustahik->kantor_layanan = $kantor_layanan;

        $update = $mustahik->update();
        if ($update) {
            # code...
            $data['status'] = true;
            $data['message'] = "Data Berhasil di Update";
            $data['data'] = $mustahik;
        } else {
            $data['status'] = false;
            $data['message'] = "Data Gagal di Update";
            $data['data'] = null;
        }
        return $data;
    }



    //delete mustahik
    public function delete($id)
    {
        $mustahik = Mustahik::find($id);
        $delete = $mustahik->delete();

        if ($delete) {
            # code...
            $data['status'] = true;
            $data['message'] = "Data Berhasil di Hapus";
            $data['data'] = $mustahik;
        } else {
            $data['status'] = false;
            $data['message'] = "Data Gagal di Hapus";
            $data['data'] = null;
        }

        return $data;
    }
}
