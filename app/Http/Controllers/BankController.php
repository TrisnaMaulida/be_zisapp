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
        $bank->kode_bank = $request->kode_bank;
        $bank->nama_akun = $request->nama_akun;
        $bank->no_kantor = $request->no_kantor;
        $bank->nama_kantor = $request->nama_kantor;

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
}
