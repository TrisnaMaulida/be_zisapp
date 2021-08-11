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
        $data['data'] = DB::select("SELECT * FROM programs LEFT JOIN banks ON programs.id_bank = banks.id_bank");
        //perintah menampilkan dua table (relasi) -> relasi antara table program dan table bank
        //$data['data'] = Program::all(); //megambil semua data program
        return $data; //menampilkan index
    }

    //get pengguna by id
    public function show($id) //deklarasi fungsi show
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Program"; //menampilkan pesan
        $data['data'] = Program::find($id); //mengambil semua data dari database
        return $data; //menampilkan data relasi yang telah dibuat
    }

    //create program
    public function create(Request $request) //pendeklarasian fungsi create
    {
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "101001";

        $max_program = DB::table("programs")->max('kode_program'); // ambil id terbesar > 101001

        if ($max_program) { // jika sudah ada data generate id baru 

            $pecah_dulu = str_split($max_program, 3); // misal "101001" hasilnya jadi ["101","001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.03d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $program = new Program;
        $program->id_bank = $request->id_bank; //menset id_bank
        $program->kode_program = $next_id;
        $program->nama_program = $request->nama_program; //menset nama_program yang diambil dari request body

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
            $program->id_bank = $request->id_bank;
            $program->nama_program = $request->nama_program;

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
