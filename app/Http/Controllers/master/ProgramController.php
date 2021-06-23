<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    //get program
    public function index() //deklarasi  fungsi index
    {

        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Program"; //menampilkan pesan
        $data['data'] = DB::select("SELECT * FROM programs LEFT JOIN akuns ON programs.id_akun = akuns.id_akun 
                                                            LEFT JOIN kass ON programs.id_kas = kass.id_kas
                                                            LEFT JOIN kategoris ON pragram.id_program = kategoris.id_kategoris"); //perintah menampilkan tiga table (relasi)->relasi antara table program, table akun dan tabel kas
        return $data; //menampilkan index
    }

    //create program
    public function create(Request $request) //pendeklarasian fungsi create
    {
        $program = new Program;
        /* kode_program genaratnya berdasarkan kode_kategori dari table kategori*/
        $program->kode_program = $request->kode_program;

        $program->nama_program = $request->nama_program; //menset nama_program yang diambil dari request body
        $program->id_kategori = $request->kode_kategori; //menset id_kategori yang diambil dari request body
        $program->id_kas = $request->id_kas; //menset id_kas yang diambil dari request body
        $program->id_akun = $request->id_akun; //menset id_akun yang diambil dari request body
        $program->status_program = $request->status_program; //menset status_program yang diambil dari request body

        $simpan = $program->save(); //menyimpan data program ke database
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Data Program Berhasil ditambahkan";
            $data['data'] = $program;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Data Program";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru di save/simpan
    }

    //update program
    public function update(Request $request, $id) //pendeklarasian fungsi update
    {
        $program = Program::find($id); //mengambil data berdasarkan id

        if ($program) { //jika data yang diambil ada maka akan dieksekusi
            # code...
            //menset nilai yang baru/update
            $program->nama_program = $request->nama_program;
            $program->id_kategori = $request->id_kategori;
            $program->id_kas = $request->id_kas;
            $program->id_akun = $request->id_akun;
            $program->status_program = $request->status_program;

            $data['data'] = $program; //menampilkan data program
            $update = $program->update(); //menyimpan perubahan data pada database 
            if ($update) { //jika berhasil update
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $program;
            } else { //jika gagal update
                $Data['status'] = false;
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

    //delete bank
    public function delete($id) //deklarasi fungsi delete
    {
        $program = Program::find($id); //mengambil data muzaki berdasarkan id

        if ($program) { //mengecek data program apakah ada atau tidak
            # code...
            $delete = $program->delete(); //menghapus data program

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
