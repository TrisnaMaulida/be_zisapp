<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Kategori;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    //get kategori
    public function index() //deklarasi fungsi index
    {
        $data['status'] = true; //menampilkan status
        $data['message'] = "Data Kategori"; //menampilkan pesan
        $data['data'] = DB::select("SELECT * FROM kategoris LEFT JOIN kass ON kategoris.id_kas = kass.id_kas"); //perintah menampilkan dua table (relasi)->relasi antara table kategoris dengan table kass
        return $data; //menampilkan hasil dari proses pengambilan data
    }

    //create kategori
    public function create(Request $request) //deklarasi fungsi create
    {
        //pilih default id ketikas ada kasus belum ada data sama sekali
        $next_id = "101";
        $max_kategori = DB::table("kategoris")->max("kode_kategori"); //ambil id terbesar > 101

        if ($max_kategori) { //jika sudah ada data generate id baru
            # code...
            $pecah_dulu = str_split($max_kategori, 1); //misal "101" hasil jadi ["1", "01"]
            $increment_id = $pecah_dulu[1];
            $result = sprintf("%'.02d", $increment_id + 1);

            $next_id = $pecah_dulu[0] . $result;
        }

        $kategori = new Kategori; //inisialisasi atau menciptakan objek
        $kategori->kode_kategori = $next_id; //memanggil perintah next_id
        $kategori->nama_kategori = $request->nama_kategori; //menset nama_kategori yang diambil dari request body
        $kategori->id_kas = $request->id_kas; //menset id_kas yang diambil dari request body
        $kategori->alokasi_amil = $request->alokasi_amil; //menset alokasi_amil yang diambil dari request body
        $kategori->alokasi_kas = $request->alokasi_kas; //menset alokasi_kas yang diambil dari request body

        $simpan = $kategori->save(); //menyimpan data kategori ke database
        if ($simpan) { //jika penyimpanan berhasil
            # code...
            $data['status'] = true;
            $data['message'] = "Berhasil Menyimpan Data";
            $data['data'] = $kategori;
        } else {
            $data['status'] = false;
            $data['message'] = "Gagal Menyimpan Data";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang baru disave/simpan
    }

    //update kategori
    public function update(Request $request, $id) //deklarasi fungsi update
    {
        $kategori = Kategori::find($id); //mengambil data berdarkan id

        if ($kategori) { //jika data yang diambil ada maka akan dieksekusi
            # code...
            //menset nilai baru/update 
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->id_kas = $request->id_kas;
            $kategori->alokasi_amil = $request->alokasi_amil;
            $kategori->alokasi_kas = $request->alokasi_kas;

            $data['data'] = $kategori; //menampilkan data kategori
            $update = $kategori->upadate(); //menyimpan perubahan data pada database
            if ($update) { //jiak berhasil update
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil di Update";
                $data['data'] = $kategori;
            } else { //jika gagal diupdate
                $data['status'] = false;
                $data['message'] = "Data Gagal di Update";
                $data['data'] = null;
            }
        } else { //jika datanya tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan data yang berhasil diUpdate (berhasil/gagal/tidak ada)
    }

    //delete kategori
    public function delete($id) //deklarasi fungsi delete
    {
        $kategori = Kategori::find($id); //mengambil data berdasarkan id

        if ($kategori) { //mengecek data apakah ada atau tidak
            # code...
            $delete = $kategori->delete(); //menghapus data kategori
            if ($delete) {  //jika fungsi hapus berhasil
                # code...
                $data['status'] = true;
                $data['message'] = "Data Berhasil diHapus";
                $data['data'] = $kategori;
            } else { //jika fungsi hapus gagal
                $data['status'] = false;
                $data['message'] = "Data Gagal diHapus";
                $data['data'] = null;
            }
        } else { //data yang dihapus tidak ada
            $data['status'] = false;
            $data['message'] = "Data Tidak Ada";
            $data['data'] = null;
        }
        return $data; //menampilkan hasil data yang dihapus (berhasil/gagal/tidak ada data)

    }
}
