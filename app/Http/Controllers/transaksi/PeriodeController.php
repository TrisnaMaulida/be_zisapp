<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    //get periode
    public function index() //deklarasi fungsi index
    {
        $data['status'] = 200; //menampilkan status
        $data['message'] = "Data Periode"; //menampilkan pesan
        $data['data'] = Periode::all(); //fungsi untuk mengambil semua data tabel kantor

        return $data; //menampilka seluruh data
    }

    //create periode
    public function create(Request $request) //deklarasi fungsi create
    {
        $periode =  new Periode; //inisalisasi atau menciptakan objek baru
        $periode->nama_periode = $request->nama_periode; //menset nama_periode yang diambil dari request body
        $periode->status_periode = 1; //agar status langsung ter-create

        $simpan = $periode->save(); //menyimpan data periode ke database
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Data Periode Berhasil ditambahkan";
            $data['data'] = $periode;
        } else { //jika penyimpanan gagal
            $data['status'] = false;
            $data['message'] = "Gagal Memabahkan Periode";
            $data['data'] = null;
        }

        return $data; //menampilkan data yang baru disave
    }

    //update periode
    public function update(Request $request, $id) //deklarasi fungsi update
    {

        $periode =  Periode::find($id);

        if ($periode) {
            # code...
            //mengambil nilai lama
            $nama_periode = $request->nama_periode;
            $status_periode = $request->status_periode;

            //menset nilai yang baru/update
            $periode->nama_periode = $nama_periode;
            $periode->status_periode = $status_periode;

            $data['data'] = $periode; //menampilkan data periode
            $update = $periode->update(); //menyimpan perubahan data periode ke database
            if ($update) { //jika data berhasil diupdate
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diUpdate";
                $data['data'] = $periode;
            } else { //jika data gagal diupdate
                $data['status'] = false;
                $data['message'] = "Data Gagal diUpdate";
                $data['data'] = null;
            }
        } else { //jika data tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data; //menampilka data yang berhasil diupdate (berhasil/gagal/tidak ada)
    }

    //delete periode
    public function delete($id) //deklarasi fungsi delete
    {
        $periode = Periode::find($id); //mengambil data berdasarkan id

        if ($periode) { //mengecek apakah data periode ada atau tidak
            # code...
            $delete = $periode->delete(); //mengahapus data periode

            if ($delete) { //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diHapus";
                $data['data'] = $periode;
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $data['data'] = null;
            }
        } else { //jika data tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilka hasil data yang dihapus (berhasil/gagal/tidak ada)
    }
}
