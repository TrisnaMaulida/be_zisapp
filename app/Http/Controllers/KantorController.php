<?php

namespace App\Http\Controllers;

use App\Kantor;
use Illuminate\Http\Request;

class KantorController extends Controller
{
    //get Kantor
    public function index()
    {
        $data['status'] = 200;
        $data['data'] = Kantor::all();

        return $data;
    }

    //create kantor
    public function create(Request $request)
    {
        $kantor = new Kantor;
        $kantor->no_kantor = $request->no_kantor;
        $kantor->nama_kantor = $request->nama_kantor;
        $kantor->alamat = $request->alamat;
        $kantor->telepon = $request->telepon;
        $kantor->pimpinan = $request->pimpinan;
        $kantor->status = $request->statsus;

        $simpan = $kantor->save();
        if ($simpan) {
            # code...
            $data['status'] = true;
            $data['message'] = "Berhasil Menambahkan Data Kantor";
            $data['data'] = $kantor;
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Kantor";
            $data['data'] = null;
        }

        return $data;
    }

    //upadate Kantor
    public function update(Request $request, $id)
    {
        $no_kantor = $request->no_kantor;
        $nama_kantor = $request->nama_kantor;
        $alamat = $request->alamat;
        $telepon = $request->telepon;
        $pimpinan = $request->pimpinan;
        $status  = $request->status;

        $kantor = Kantor::find($id);
        $kantor->no_kantor = $no_kantor;
        $kantor->nama_kantor = $nama_kantor;
        $kantor->alamat = $alamat;
        $kantor->telepon = $telepon;
        $kantor->pimpinan = $pimpinan;
        $kantor->status = $status;

        $update = $kantor->update();
        if ($update) {
            # code...
            $data['status'] = true;
            $data['message'] = "Data Berhasil di Update";
            $data['data'] = $kantor;
        } else {
            $data['status'] = false;
            $data['message'] = "Data Gagal di Update";
            $data['data'] = null;
        }

        return $data;
    }

    //delete Kantor
    public function delete($id)
    {
        $kantor = Kantor::find($id);
        $delete = $kantor->delete();

        if ($delete) {
            # code...
            $data['status'] = true;
            $data['message'] = "Data Berhasil di Hapus";
            $data['data'] = $kantor;
        } else {
            $data['status'] = false;
            $data['message'] = "Data Gagal di Hapus";
            $data['data'] = null;
        }

        return $data;
    }
}
