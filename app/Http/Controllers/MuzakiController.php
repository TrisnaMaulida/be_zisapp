<?php

namespace App\Http\Controllers;

use DB;
use App\Muzaki;
use App\Pengguna;
use Illuminate\Http\Request;

class MuzakiController extends Controller
{
    //get Muzaki
    public function index()
    {
        $data['status'] = 200;
        $data['data'] = Muzaki::all();

        $data = DB::select("SELECT * FROM muzakis LEFT JOIN kantors ON muzakis.id_kantor = kantors.id_kantor LEFT JOIN penggunas ON muzakis.id_pengguna = Penggunas.id_pengguna");
        // $data = DB::table("muzakis")
        //     ->leftjoin("kantors", "muzakis.id_kantor", "=", "kantors.id_kantor")
        //     ->select("muzakis.alamat_muzaki as alamat_muzaki",  "kantors.alamat_muzaki as alamat_kantor")
        //     ->get();
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
        $muzaki->alamat_muzaki = $request->alamat_muzaki;
        $muzaki->profesi = $request->profesi;
        $muzaki->telepon_muzaki = $request->telepon_muzaki;
        $muzaki->kategori_muzaki = $request->kategori_muzaki;
        $muzaki->status_muzaki = 1;
        $muzaki->id_pengguna = $request->id_pengguna;
        $muzaki->id_kantor = $request->id_kantor;

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
        $alamat_muzaki = $request->alamat_muzaki;
        $profesi = $request->profesi;
        $telepon_muzaki = $request->telepon_muzaki;
        $kategori_muzaki = $request->kategori_muzaki;
        $status_muzaki = $request->status_muzaki;
        $id_pengguna = $request->id_pengguna;
        $id_kantor = $request->id_kantor;


        $muzaki = Muzaki::find($id);

        if ($muzaki) {
            # code...
            $muzaki->npwz = $npwz;
            $muzaki->nik = $nik;
            $muzaki->nama_muzaki = $nama_muzaki;
            $muzaki->jk = $jk;
            $muzaki->alamat_muzaki = $alamat_muzaki;
            $muzaki->profesi = $profesi;
            $muzaki->telepon_muzaki = $telepon_muzaki;
            $muzaki->kategori_muzaki = $kategori_muzaki;
            $muzaki->status_muzaki = $status_muzaki;
            $muzaki->id_pengguna = $id_pengguna;
            $muzaki->id_kantor = $id_kantor;

            $data['data'] = $muzaki;
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
        } else {
            $data['data'] = null;
        }
        return $data;
    }

    //delete muzaki
    public function delete($id)
    {
        $muzaki = Muzaki::find($id);

        if ($muzaki) {
            # code...
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
        } else {
            $data['data'] = null;
        }

        return $data;
    }
}
