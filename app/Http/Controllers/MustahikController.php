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
        $mustahik->kode_mustahik = $request->kode_mustahik;
        $mustahik->nama_mustahik = $request->nama_mustahik;
        $mustahik->alamat = $request->alamat;
        $mustahik->asnaf = $request->asnaf;
        $mustahik->no_hp = $request->no_hp;
        $mustahik->kategori = $request->kategori;
        $mustahik->status = $request->status;
        $mustahik->no_kantor = $request->no_kantor;

        $simpan = $mustahik->save();
        if ($simpan) {
            $data['status'] = true;
            $data['message'] = "Berhasil Menambahkan Data Mustahik";
            $data['data'] = $mustahik;
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Mustahik";
            $data['data'] = null;
        }

        return $data;
    }

    //update mustahik
    public function update(Request $request, $id)
    {
        $kode_mustahik = $request->kode_mustahik;
        $nama_mustahik = $request->nama_mustahik;
        $alamat = $request->alamat;
        $asnaf = $request->asnaf;
        $no_hp = $request->no_hp;
        $kategori = $request->kategori;
        $status = $request->status;
        $no_kantor = $request->no_kantor;

        $mustahik = Mustahik::find($id);
        $mustahik->kode_mustahik = $kode_mustahik;
        $mustahik->nama_mustahik = $nama_mustahik;
        $mustahik->alamat = $alamat;
        $mustahik->asnaf = $asnaf;
        $mustahik->no_hp = $no_hp;
        $mustahik->kategori = $kategori;
        $mustahik->status = $status;
        $mustahik->no_kantor = $no_kantor;

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
