<?php

namespace App\Http\Controllers;

use App\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    //get akun
    public function index()
    {
        $data['status'] = 200;
        $data['data'] = Akun::all();

        return $data;
    }

    //create Akun
    public function create(Request $request)
    {
        $akun = new Akun;
        $akun->kode_akun = $request->kode_akun;
        $akun->akun = $request->akun;
        $akun->kode_sub_kat_akun = $request->kode_sub_kat_akun;
        $akun->jenis = $request->jenis;
        $akun->status = 1;

        $simpan = $akun->save();
        if ($simpan) {
            # code...
            $data['status'] = true;
            $data['message'] = "Data Akun Berhasil ditambahkan";
            $data['data'] = $akun;
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Akun";
            $data['data'] = null;
        }

        return $data;
    }

    //update
    public function update(Request $request, $id)
    {
        $kode_akun = $request->kode_akun;
        $akun = $request->akun;
        $kode_sub_kat_akun = $request->kode_sub_kat_akun;
        $jenis = $request->jenis;
        $status = $request->status;

        $akun = Akun::find($id);

        if ($akun) {
            # code...
            $akun->kode_akun = $kode_akun;
            $akun->akun = $akun;
            $akun->kode_sub_kat_akun = $kode_sub_kat_akun;
            $akun->jenis = $jenis;
            $akun->status = $status;

            $data['data'] = $akun;
            $update = $akun->update();
            if ($update) {
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $akun;
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

    //delete akun;
    public function delete($id)
    {
        $akun = Akun::find($id);

        if ($akun) {
            # code...

            $delete = $akun->delete();
            if ($delete) {
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $data;
            } else {
                $data['status'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $Data['data'] = null;
            }
        } else {
            $data['data'] = null;
        }

        return $data;
    }
}
