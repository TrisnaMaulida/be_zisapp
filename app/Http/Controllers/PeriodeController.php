<?php

namespace App\Http\Controllers;

use App\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    //get periode
    public function index()
    {
        $data['status'] = 200;
        $data['data'] = Periode::all();

        return $data;
    }

    //create periode
    public function create(Request $request)
    {
        $periode =  new Periode;
        $periode->nama_periode = $request->nama_periode;
        $periode->status_periode = $request->status_periode;

        $simpan = $periode->save();
        if ($simpan) {
            # code...
            $data['status'] = true;
            $data['message'] = "Data Periode Berhasil ditambahkan";
            $data['data'] = $periode;
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal Memabahkan Periode";
            $data['data'] = null;
        }

        return $data;
    }

    //update periode
    public function update(Request $request, $id)
    {
        $nama_periode = $request->nama_periode;
        $status_periode = $request->status_periode;

        $periode =  Periode::find($id);

        if ($periode) {
            # code...
            $periode->nama_periode = $nama_periode;
            $periode->status_periode = $status_periode;

            $data['data'] = $periode;
            $update = $periode->update();
            if ($update) {
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $periode;
            } else {
                $data['status'] = false;
                $data['message'] = "Data Gagal diUpdate";
                $data['data'] = null;
            }
        } else {
            $data['data'] = null;
        }

        return $data;
    }

    //delete periode
    public function delete($id)
    {
        $periode = Periode::find($id);

        if ($periode) {
            # code...
            $delete = $periode->delete();

            if ($delete) {
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diHapus";
                $data['data'] = $periode;
            } else {
                $data['status'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $data['data'] = null;
            }
        } else {
            $data['data'] = null;
        }
        return $data;
    }
}
