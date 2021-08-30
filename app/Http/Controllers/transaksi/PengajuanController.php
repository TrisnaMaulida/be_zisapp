<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Pengajuan;
use Barryvdh\DomPDF\Facade as PDF;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PengajuanController extends Controller
{
    //get pengajuan
    public function index() //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Pengajuan"; //menampilkan pesan
        $data['data'] = DB::select("SELECT *FROM pengajuans LEFT JOIN mustahiks ON pengajuans.id_mustahik = mustahiks.id_mustahik"); //menampilkan relasi table antara table pengajuans dan table mustahiks
        return $data; //menampilkan data relasi yang sudah dibuat
    }

    //get pengajuan by id
    public function show($id) //deklarasi fungsi show
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Pengajuan"; //menampilkan pesan
        $data['data'] = Pengajuan::find($id); //mengambil semua data dari database
        return $data; //menampilkan data relasi yang telah dibuat
    }

    //create pengajjuan
    public function create(Request $request) //deklarasi fungsi create
    {
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "PJN-1800001";

        $max_pengguna = DB::table("pengajuans")->max('no_pengajuan'); //ambil id terbesar -> PJN-1800001 

        if ($max_pengguna) { //jika sudah ada data generate id baru
            # code...
            $pecah_dulu = str_split($max_pengguna, 7); //misal "PJN-1800001" hasilnya jadi ["PJN-1800", "001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.04d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $pengajuan = new Pengajuan; //insialisasi objek
        $pengajuan->no_pengajuan = $next_id; //memanggil perintah next_id yang tadi telah dibuat
        $pengajuan->id_mustahik = $request->id_mustahik; //menset id_mustahik yang diambil dari request body
        $pengajuan->pengajuan_kegiatan = $request->pengajuan_kegiatan; //menset pengajuan_kegiatan yang diambil dari request body
        $pengajuan->jumlah_pengajuan = $request->jumlah_pengajuan; //menset jumlah_pengajuan yang diambil dari request body
        $pengajuan->jenis_pengajuan = $request->jenis_pengajuan; //menset jenis_pengajuan yang diambil dari request body
        $pengajuan->asnaf = $request->asnaf; //menset asnaf yang diambil dari request body 
        $pengajuan->status_pengajuan = 1; //menset status agar otomastis tercreate (itu langsung tercreate "proses")

        $simpan = $pengajuan->save(); //menyimpan data pengajuan ke databse
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['mesaage'] = "Berhasil Menambahkan Pengajuan";
            $data['data'] = $pengajuan;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Pengajuan";
            $data['data'] = null;
        }
        return $data;  //menampilka data yang baru disave/simpan
    }

    //update pengajuan
    public function update(Request $request, $id) //pendeklarasian fungsi update
    {
        $pengajuan = Pengajuan::find($id); //mengambil data berdasarkan id

        if ($pengajuan) { //jika data yang diambil ada maka akan dieksekusi
            # code...
            //menset nilai yang baru/update 
            $pengajuan->jumlah_realisasi = $request->jumlah_realisasi;
            $pengajuan->tgl_realisasi = $request->tgl_realisasi;
            $pengajuan->status_pengajuan = $request->status_pengajuan;

            $data['data'] = $pengajuan; //menampilkan data pengajuan
            $update = $pengajuan->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update
                # code...
                $data['status'] = true;
                $data['message'] = "Berhasil diUpdate";
                $data['data'] = $pengajuan;
            } else { //jika gagal update
                $data['status'] = false;
                $data['message'] = "Gagal diUpdate";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang berhasil diupdate (berhasil/gagal/data tidak ada)
    }

    //delete pengajuan
    public function delete($id) //deklarasi delete
    {
        $pengajuan =  Pengajuan::find($id); //mengambil data berdasarkan id

        if ($pengajuan) { //mengecek apakah data pengajuan ada atau tidak
            # code...
            $delete = $pengajuan->delete(); //menghapus data pengajuan

            if ($delete) {  //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diHapus";
                $data['data'] = $pengajuan;
            } else { //jikak fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal diHapus";
                $data['data'] = null;
            }
        } else { //jika data tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada data)
    }

    //cetak pdf
    public function cetak_pdf(Request $request)
    {

        //menampilkan data berdasarkan tanggal (dari sampai)
        $pengajuan = DB::select(
            "SELECT * FROM pengajuans
                    JOIN mustahiks
                        ON mustahiks.id_mustahik = pengajuans.id_mustahik
                    WHERE pengajuans.created_at
                    BETWEEN '" . $request->tgl_dari . "'
                        AND '" . $request->tgl_sampai . "'"
        );

        //perintah cetak pdf
        $pdf = PDF::loadview('laporan_pengajuan', ['pengajuan' => $pengajuan])->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    public function upload(Request $request, $id)
    {
        $file = $request->file('image');

        //mendapatkan nama file
        $nama_file = $file->getClientOriginalName();

        //mendapatkan extention file
        $extention = $file->getClientOriginalExtension();

        //mendapatkan ukuran file
        $ukuran_file = $file->getSize();

        //proses Upload file
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());

        $pengajuan = Pengajuan::find($id); //mengambil data berdasarkan id
        if ($pengajuan) { //jika data yang diambil ada maka akan dieksekusi\
            $pengajuan->status_pengajuan = $request->status_pengajuan;
            $pengajuan->buktirealisasi = "http://localhost:8000/uploads/" . $nama_file . "." . $extention;

            $update = $pengajuan->update(); //menyimpan perubahan data pada database
            if ($update) { //jika berhasil update
                # code...
                $data['status'] = true;
                $data['message'] = "File Berhasil diunggah";
                $data['data'] = $file;
            } else { //jika gagal update
                $data['status'] = false;
                $data['message'] = "File Gagal diunggah";
                $data['data'] = null;
            }
        } else {
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan file berhasil upload
    }
}
