<?php

namespace App\Http\Controllers;

use App\Mustahik;
use Illuminate\Http\Request;

class MustahikController extends Controller
{
    //get mustahik
    public function index()
    {
        $data['status_mustahik'] = 200;
        $data['data'] = Mustahik::all();

        $data = DB::select("SELECT * FROM mustahiks LEFT JOIN kantors ON mustahiks.id_kantor = kantors.id_kantor");
        return $data;
    }

    //create mustahik
    public function create(Request $request)
    {
        $mustahik = new Mustahik;
        $mustahik->kode_mustahik = $request->kode_mustahik;
        $mustahik->nama_mustahik = $request->nama_mustahik;
        $mustahik->alamat_mustahik = $request->alamat_mustahik;
        $mustahik->asnaf = $request->asnaf;
        $mustahik->telepon_mustahik = $request->telepon_mustahik;
        $mustahik->kategori_mustahik = $request->kategori_mustahik;
        $mustahik->status_mustahik = $request->status_mustahik;
        $mustahik->id_kantor = $request->id_kantor;

        $simpan = $mustahik->save();
        if ($simpan) {
            $data['status_mustahik'] = true;
            $data['message'] = "Berhasil Menambahkan Data Mustahik";
            $data['data'] = $mustahik;
        } else {
            $data['status_mustahik'] = false;
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
        $alamat_mustahik = $request->alamat_mustahik;
        $asnaf = $request->asnaf;
        $telepon_mustahik = $request->telepon_mustahik;
        $kategori_mustahik = $request->kategori_mustahik;
        $status_mustahik = $request->status_mustahik;
        $id_kantor = $request->id_kantor;

        $mustahik = Mustahik::find($id);

        if ($mustahik) {
            # code...
            $mustahik->kode_mustahik = $kode_mustahik;
            $mustahik->nama_mustahik = $nama_mustahik;
            $mustahik->alamat_mustahik = $alamat_mustahik;
            $mustahik->asnaf = $asnaf;
            $mustahik->telepon_mustahik = $telepon_mustahik;
            $mustahik->kategori_mustahik = $kategori_mustahik;
            $mustahik->status_mustahik = $status_mustahik;
            $mustahik->id_kantor = $id_kantor;

            $data['data'] = $mustahik;
            $update = $mustahik->update();
            if ($update) {
                # code...
                $data['status_mustahik'] = true;
                $data['message'] = "Data Berhasil di Update";
                $data['data'] = $mustahik;
            } else {
                $data['status_mustahik'] = false;
                $data['message'] = "Data Gagal di Update";
                $data['data'] = null;
            }
        } else {
            $data['data'] = null;
        }
        return $data;
    }


    //delete mustahik
    public function delete($id)
    {
        $mustahik = Mustahik::find($id);

        if ($mustahik) {
            # code...
            $delete = $mustahik->delete();
            if ($delete) {
                # code...
                $data['status_mustahik'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $mustahik;
            } else {
                $data['status_mustahik'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $data['data'] = null;
            }
        } else {
            $data['data'] = null;
        }

        return $data;
    }
}
