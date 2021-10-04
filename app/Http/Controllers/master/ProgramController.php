<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    //get Program
    public function index() //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Program"; //menampilkan pesan
        $data['data'] = DB::select("SELECT * FROM programs JOIN sub_akun_programs ON programs.id_sub_akun_program = sub_akun_programs.id_sub_akun_program
                                                        JOIN sub_akuns ON sub_akuns.id_sub_akun = sub_akun_programs.id_sub_akun
                                                        JOIN akuns ON akuns.id_akun=sub_akuns.id_akun
                                                        JOIN banks ON banks.id_bank=programs.id_bank");

        //relasi 4 table antara table akuns dengan tabel sub akun
        return $data; //menampilkan hasil dari proses pengambilan data
    }

    //create Program
    public function create(Request $request) //pendeklarasian fungsi create
    {
        $program = new Program();  //inisialisasi atau menciptakan object baru
        $program->id_sub_akun_program = $request->id_sub_akun_program; //menset id_akun yang diambil dari request body
        $program->id_bank = $request->id_bank;
        $program->nama_program = $request->nama_program; //menset nama_sub_akun yang diambil dari request body


        $simpan = $program->save(); //menyimpan data pengguna ke database
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Data Akun Berhasil ditambahkan";
            $data['data'] = $program;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Akun";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru di save/simpan
    }

    //update Program
    public function update(Request $request, $id) ////pendeklarasian fungsi
    {
        $program = Program::find($id);

        if ($program) {
            # code...
            //menset nilai yang baru/update

            $program->id_bank = $request->id_bank;
            $program->nama_program = $request->nama_program;

            $data['data'] = $program; //menampilkan data akun
            $update = $program->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update 
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $program;
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

    //delete Program
    public function delete($id) //deklarasi fungsi delete
    {
        $program = Program::find($id); //mengambil data akun berdasarkan id

        if ($program) { //mengecek data akun apakah ada atau tidak
            # code...
            $delete = $program->delete(); //menghapus data akun
            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $program;
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
