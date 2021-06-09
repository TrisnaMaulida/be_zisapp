<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    //get Bank
    public function index()
    {
        $data['status'] = 200;
        $data['data'] = Bank::all;

        return $data;
    }

    //create Bank
    public function create(Request $request)
    {
        $bank = new Bank;
        $bank->no_rek = $request->no_rek;
        $bank->nama_bank = $request->nama_bank;
        $bank->kode_akun = $request->kode_akun;
        $bank->nama_akun = $request->nama_akun;
        $bank->no_kantor = $request->no_kantor;

        $simpan = $bank->save();
        if ($simpan) {
            # code...
            $data['status'] = true;
            $data['message'] = "Data Bank Berhasil ditambahkan";
            $data['data'] = $bank;
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Bank";
            $data['data'] = null;
        }

        return $data;
    }

    //update
    public function update(Request $request, $id)
    {
        $no_rek = $request->no_rek;
        $nama_bank = $request->nama_bank;
        $$kode_akun = $request->$kode_akun;
        $nama_akun = $request->nama_akun;
        $no_kantor = $request->no_kantor;

        $bank = Bank::find($id);
        $bank->no_rek = $no_rek;
        $bank->nama_bank = $nama_bank;
        $bank->kode_akun = $$kode_akun;
        $bank->nama_akun = $nama_akun;
        $bank->no_kantor = $no_kantor;

        $update = $bank->update();
        if ($update) {
            # code...
            $data['status'] = true;
            $data['message'] = "Data Berhasil diUpdate";
            $data['data'] = $bank;
        } else {
            $Data['status'] = false;
            $data['message'] = "Data Gagal diUpdate";
            $data['data'] = null;
        }

        return $data;
    }

    //delete bank
    public function delete($id)
    {
        $bank = Bank::find($id);
        $delete = $bank->delete();

        if ($delete) {
            # code...
            $data['status'] = true;
            $data['message'] = "Data Berhasil di Hapus";
            $data['data'] = $bank;
        } else {
            $data['status'] = false;
            $data['message'] = "Data Gagal di Hapus";
            $data['data'] = null;
        }

        return $data;
    }
}
