<?php

namespace App\Http\Controllers\transaksi;

use App\DetailDonasi;
use App\Donasi;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;
use Barryvdh\DomPDF\Facade as PDF;
use GuzzleHttp\Psr7\FnStream;

class DonasiController extends Controller
{
    //get donasi
    public function index() //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Donasi"; //menampilkan pesan

        $data['data'] = DB::select("SELECT * FROM donasis LEFT JOIN muzakis ON donasis.id_muzaki =  muzakis.id_muzaki"); //mengambil relasi donasi, bank dan muzaki
        return $data; //menampilkan data relasi yang sudah dibuat
    }

    //get donasi by detail_donasi
    public function detaildonasi($id) //deklarasi fungsi show get by id
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Detail Donasi"; //menampilkan pesan
        $data['data'] =  DB::select("SELECT * FROM detail_donasis JOIN donasis ON donasis.id_donasi = detail_donasis.id_donasi
                                                                    JOIN programs ON programs.id_program  = detail_donasis.id_program
                                                                    JOIN muzakis ON muzakis.id_muzaki = donasis.id_muzaki
                                                                    WHERE donasis.id_donasi = " . $id . "");

        return $data; //menampilkan data relasi yang sudah dibuat
    }

    //get donasi by id
    public function show($id) //deklarasi fungsi show get by id
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Detail Donasi"; //menampilkan pesan
        $data['data'] = DB::select("SELECT * FROM donasis LEFT JOIN muzakis ON donasis.id_muzaki =  muzakis.id_muzaki
                                                            WHERE donasis.id_donasi = " . $id . ""); //mengambil relasi donasi dan muzaki

        return $data; //menampilkan data relasi yang sudah dibuat

    }

    //create donasi
    public function create(Request $request) //pendeklarasian fungsi create
    {
        //buat id donasi berdasarkan datetime
        $date = new DateTime();
        $id_donasi = $date->getTimestamp();
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "DNS-18000001"; //18 itu tahun

        $max_donasi = DB::table("donasis")->max('no_donasi'); //ambil id terbesar > DNS-18000001

        if ($max_donasi) { //jika sudah ada data genarate id baru
            # code...
            $tahun = $request->input('tahun'); //request tahun dari frontend
            $pecah_dulu = str_split($max_donasi, 8); //misal "DNS-1800001" hasilnya jadi ["DNS-1800","0001"]
            $pecah_tahun = str_split($pecah_dulu[0], 4);
            $increment_id = $pecah_dulu[1];
            $hasil_tahun = $tahun . "00";
            $result = sprintf("%'.4d", $increment_id + 1);

            $next_id = $pecah_tahun[0] . $hasil_tahun . $result;
        }

        $donasi = new Donasi; //inisalisasi atau menciptakan objek baru
        $donasi->id_donasi = $id_donasi;
        $donasi->no_donasi = $next_id; //memanggil perintah next_id yang sudah dibuat
        $donasi->no_bukti = $request->no_bukti; //menset no_bukti yang diambil dari request body
        $donasi->tgl_donasi = $request->tgl_donasi; //menset tgl_donasi yang diambil dari request body
        $donasi->total_donasi = $request->total_donasi; //menset total_donasi yang diambil dari request body
        $donasi->metode = $request->metode; //menset metode yang diambil dari request body
        $donasi->status_donasi = 1; //agar status langsung ter-create
        $donasi->id_muzaki = $request->id_muzaki; //menset id_muzaki yang diambil dari request body
        $donasi->id_pengguna = $request->id_pengguna; //menset id_pengguna yang diambil dari request body

        //var_dump($request);
        $simpan_donasi = $donasi->save(); //menyimpan data pengguna ke database

        if ($simpan_donasi) { //jika penyimpanan berhasil
            # code...
            $data['data'] = $simpan_donasi;
            $detail = $request->detail_donasi;
            $final_data = [];

            if ($detail) { //jika datanya ada maka akan di ambil
                foreach ($detail as $item) {
                    if ($item != null) {
                        array_push($final_data, array(
                            "id_donasi" => $id_donasi, //menset id_donasi yang diambil dari request body
                            "id_program" => $item['id_program'], //menset id_program yang diambil dari request body
                            "jumlah_donasi" => $item['jumlah_donasi'], //menset jumlah_donasi yang diambil dari request body
                            "keterangan" => $item['keterangan'], //menset keterangan yang diambil dari request body
                        ));
                    }     //push data ke array

                }

                $simpan_detaildonasi = DetailDonasi::insert($final_data); //menyimpan data detai donasi ke dataabase
                if ($simpan_detaildonasi) { //jika penyimpanan berhasil
                    # code...
                    $data['status'] = true;
                    $data['message'] = "Berhasil Menambahkan Detail Donasi";
                    $data['data'] = $simpan_detaildonasi;
                } else { //jika penyimpanan gagal
                    $data['status'] = false;
                    $data['message'] = "Gagal Menambahkan Detail Donasi";
                    $data['data'] = null;
                }
            } else { //jika datanya tidak ada
                $data['status'] = false;
                $data['message'] = "Data Tidak Ada";
                $data['data'] = null;
            }
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Menambahkan Donasi";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang baru disave/simpan
        //die();
    }

    //update donasi (detail donasi)
    public function update(Request $request, $id) //deklarasi update
    {
        $donasi_detail = DetailDonasi::find($id); //mengambil data berdasarkan id

        if ($donasi_detail) { //jika data ada maka data akan dieksekusi
            # code...
            //menset nilai yang baru/update
            $donasi_detail->id_program = $request->id_program;
            $donasi_detail->jumlah_donasi = $request->jumlah_donasi;

            $data['data'] = $donasi_detail; //menampilkan data detail donasi
            $update = $donasi_detail->update(); //menyimpan perubahan data pada database
            if ($update) { //jika data berhasil diupdate
                $data['status'] = true;
                $data['message'] = "Berhasil di Update";
                $data['data'] = $donasi_detail;
            } else { //jika data gagal diupdate
                $data['status'] = false;
                $data['message'] = "Gagal Update";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan hasil update (berhasil/gagal/data tidak ada)
    }

    //delete donasi
    public function delete($id) //deklarasi delete
    {
        $donasi = Donasi::find($id); //mengambil data berdasarkan id

        if ($donasi) { //mengecek apakah data donasi ada atau tidak
            # code...
            $delete_donasi = $donasi->delete(); //menghapus data donasi

            if ($delete_donasi) { //jika fungsi hapus berhasil
                # code...
                $delete_detaildonasi = DB::table('detail_donasis')->where('id_donasi', $id)->delete(); //menghapus data detail donasi
                if ($delete_detaildonasi) { //jika fungsi hapus detaildonasi berhasil
                    # code...
                    $data['status'] = true;
                    $data['message'] = "Berhasil Menghapus Detail Donasi";
                    $data['data'] = $delete_detaildonasi;
                } else { //jika fungsi hapus detaildonasi gagal
                    $data['status'] = false;
                    $data['message'] = "Gagal Menghapus Detail Donasi";
                    $data['data'] = null;
                }
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal diHapus";
                $data['data'] = null;
            }
        } else { //jika data tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada)
    }

    //cetak pdf
    public function cetak_pdf(Request $request)
    {

        //menampilkan data bersarkan tanggal (dari sampai)
        $donasi = DB::select(
            "SELECT * FROM detail_donasis
                    JOIN donasis
                        ON donasis.id_donasi = detail_donasis.id_donasi
                    JOIN programs
                        ON programs.id_program  = detail_donasis.id_program
                    JOIN muzakis
                        ON muzakis.id_muzaki = donasis.id_muzaki"
        );

        //perintah cetak pdf
        $pdf = PDF::loadview('laporan_donasi', ['donasi' => $donasi])->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    //cetak tanda bukti
    public function cetak_tanda(Request $request)
    {
        //menampilkan hasil detail donasi
        $donasi1 = DB::select("SELECT * FROM detail_donasis
        JOIN donasis
            ON donasis.id_donasi = detail_donasis.id_donasi
        JOIN programs
            ON programs.id_program  = detail_donasis.id_program
        JOIN muzakis
            ON muzakis.id_muzaki = donasis.id_muzaki
            
            WHERE donasis.id_donasi = " . $request->id_donasi . "");

        //perintah cetak tanda terima pdf
        $pdf = PDF::loadview(
            'buktiterima', //nama file pdfnya
            [
                'donasi1' => $donasi1,
                'nama_donatur' => $request->nama_muzaki,
                'npwz' => $request->npwz,
                'petugas' => $request->nama_pengguna
            ]
        )->setPaper('A4', 'potrait');
        return $pdf->stream();
    }
}
