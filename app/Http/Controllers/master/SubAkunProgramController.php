<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\SubAkunProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubAkunProgramController extends Controller
{
    //get SubAkunProgram
    public function index() //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Sub Akun"; //menampilkan pesan
        $data['data'] = DB::select("SELECT * FROM sub_akun_programs JOIN sub_akuns ON sub_akun_programs.id_sub_akun = sub_akuns.id_sub_akun
                                                                    JOIN akuns ON akuns.id_akun = sub_akuns.id_akun");
        //relasi dua table antara table akuns dengan tabel sub akun
        return $data; //menampilkan hasil dari proses pengambilan data
    }

    //create SubAkunProgram
    public function create(Request $request) //pendeklarasian fungsi create
    {
        $sub_akun_program = new SubAkunProgram();  //inisialisasi atau menciptakan object baru
        $sub_akun_program->id_sub_akun = $request->id_sub_akun; //menset id_akun yang diambil dari request body
        $sub_akun_program->nama_sub_akun_program = $request->nama_sub_akun_program; //menset nama_sub_akun yang diambil dari request body


        $simpan = $sub_akun_program->save(); //menyimpan data pengguna ke database
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Data Akun Berhasil ditambahkan";
            $data['data'] = $sub_akun_program;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Akun";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru di save/simpan
    }

    //update SubAKunProgram
    public function update(Request $request, $id) ////pendeklarasian fungsi
    {
        $sub_akun_program = SubAkunProgram::find($id);

        if ($sub_akun_program) {
            # code...
            //menset nilai yang baru/update

            $sub_akun_program->nama_sub_akun_program = $request->nama_sub_akun_program;

            $data['data'] = $sub_akun_program; //menampilkan data akun
            $update = $sub_akun_program->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update 
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $sub_akun_program;
            } else { //jika gagal update
                $data['status'] = false;
                $data['message'] = "Data Gagal diUpdate";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang berhasil diupdate (berhasil/gagal/data tidak ada)
    }

    //delete Sub Akun Program
    public function delete($id) //deklarasi fungsi delete
    {
        $sub_akun_program = SubAkunProgram::find($id); //mengambil data akun berdasarkan id

        if ($sub_akun_program) { //mengecek data akun apakah ada atau tidak
            # code...
            $delete = $sub_akun_program->delete(); //menghapus data akun
            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $sub_akun_program;
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $data['data'] = null;
            }
        } else { //data yang dihapus tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada)
    }
}
