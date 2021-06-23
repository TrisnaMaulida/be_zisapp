<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    //get program
    public function index()
    {

        $data['status'] = true;
        $data['message'] = "Data Program";
        $data['data'] = DB::select("SELECT * FROM programs LEFT JOIN akuns ON programs.id_akun = akuns.id_akun LEFT JOIN kass ON programs.id_kas = kass.id_kas");

        return $data;
    }

    //create program
    public function create(Request $request)
    {
        $program = new Program;
        $program->kode_program = $request->kode_program;
        $program->program = $request->program;
        $program->kode_kategori = $request->kode_kategori;
        $program->kode_kas = $request->kode_kas;
        $program->kode_akun = $request->kode_akun;
        $program->status = $request->status;

        $simpan = $program->save();
        if ($simpan) {
            # code...
            $data['status'] = true;
            $data['message'] = "Data Program Berhasil ditambahkan";
            $data['data'] = $program;
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Program";
            $data['data'] = null;
        }

        return $data;
    }

    //update program
    public function update(Request $request, $id)
    {
        $kode_program = $request->kode_program;
        $program = $request->program;
        $kode_kategori = $request->kode_kategori;
        $kode_akun = $request->kode_akun;
        $status = $request->status;

        $program = Program::find($id);

        if ($program) {
            # code...
            $kode_program->kode_program = $kode_program;
            $program->program = $program;
            $kode_kategori->kode_kategori = $kode_kategori;
            $kode_akun->kode_akun = $kode_akun;
            $status->status = $status;

            $data['data'] = $program;
            $update = $program->update();
            if ($update) {
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $program;
            } else {
                $Data['status'] = false;
                $data['message'] = "Data Gagal diUpdate";
                $data['data'] = null;
            }
        } else {
            $data['data'] = null;
        }
        return $data;
    }

    //delete bank
    public function delete($id)
    {
        $program = Program::find($id);

        if ($program) {
            # code...
            $delete = $program->delete();

            if ($delete) {
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $program;
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
