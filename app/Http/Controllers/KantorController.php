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
        $kantor->alamat_kantor = $request->alamat_kantor;
        $kantor->telepon_kantor = $request->telepon_kantor;
        $kantor->pimpinan = $request->pimpinan;

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
        $alamat_kantor = $request->alamat_kantor;
        $telepon_kantor = $request->telepon_kantor;
        $pimpinan = $request->pimpinan;

        $kantor = Kantor::find($id);
        if ($kantor) {
            # code...
            $kantor->no_kantor = $no_kantor;
            $kantor->nama_kantor = $nama_kantor;
            $kantor->alamat_kantor = $alamat_kantor;
            $kantor->telepon_kantor = $telepon_kantor;
            $kantor->pimpinan = $pimpinan;

            $data['data'] = $kantor;

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
        } else {
            $data['data'] = null;
        }

        return $data;
    }

    //delete Kantor
    public function delete($id)
    {
        $kantor = Kantor::find($id);

        if ($kantor) {
            # code...
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
        }
        return $data;
    }
}
