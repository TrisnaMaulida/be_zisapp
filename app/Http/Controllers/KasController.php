<?php

namespace App\Http\Controllers;

use DB;
use App\Kas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    //get kas
    public function index()
    {
        $data["message"] = "Menampilkan Data Kas";
        $data["status"] = 200;
        $data["data"] = Kas::all();

        $data = DB::select("SELECT *FROM kass LEFT JOIN akuns ON kass.id_akun = akuns.id_akun");
        return $data;
    }

    //create kas
    public function create(Request $request)
    {
        //pilih default id ketika ada kasus belum ada data sama sekali
        $next_id = "10001";

        $max_kas = DB::table("kas")->max('kode_kas'); // ambil id terbesar > 10001

        if ($max_kas) { // jika sudah ada data generate id baru 

            $pecah_dulu = str_split($max_kas, 2); // misal "10001" hasilnya jadi ["10","001"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.03d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $kas = new Kas;
        $kas->kode_kas = $next_id;
        $kas->nama_kas = $request->nama_kas;
        $kas->id_akun = $request->id_akun;

        $simpan = $kas->save();
        if ($simpan) {
            # code...
            $data['status_kas'] = true;
            $data['message'] = "Berhasil Menambahkan Data Kas";
            $data['data'] = $kas;
        } else {
            $data['status_kas'] = false;
            $data['message'] = "Gagal Menambahkan Data Kas";
            $data['data'] = null;
        }

        return $data;
    }

    //update kas
    public function update(Request $request, $id)
    {
        $kode_kas = $request->kode_kas;
        $nama_kas = $request->nama_kas;
        $id_akun = $request->id_akun;

        $kas = Kas::find($id);

        if ($kas) {
            # code...
            $kas->kode_kas = $kode_kas;
            $kas->nama_kas = $nama_kas;
            $kas->id_akun = $id_akun;

            $data['data'] = $kas;
            $update = $kas->update();
            if ($update) {
                # code...
                $data['status_mustahik'] = true;
                $data['message'] = "Data Berhasil di Update";
                $data['data'] = $kas;
            } else {
                $data['status_mustahik'] = false;
                $data['message'] = "Data Gagal di Update";
                $data['data'] = null;
            }
        } else {
            $data['data'] = null;
        }
        return $data;
    }

    //delete kas
    public function delete($id)
    {
        $kas = Kas::find($id);

        if ($kas) {
            # code...
            $delete = $kas->delete();
            if ($delete) {
                # code...
                $data['status_kas'] = true;
                $data['message'] = "Data Berhasil di Hapus";
                $data['data'] = $kas;
            } else {
                $data['status_kas'] = false;
                $data['message'] = "Data Gagal di Hapus";
                $data['data'] = null;
            }
        } else {
            $data['status_kas'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }

        return $data;
    }
}
