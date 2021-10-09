<?php

namespace App\Http\Controllers\laporan;

use DB;
use App\Http\Controllers\Controller;
use App\LaporanHarian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class LaporanHarianController extends Controller
{
    //get laporan harian

    public function index(Request $request)
    {
        # code...
        $data['status'] = true;
        $data['message'] = "Laporan Harian";
        $data['data'] = DB::table('detail_donasis')
            ->select('detail_donasis.id_program')
            ->select('programs.nama_program', DB::raw('SUM(detail_donasis.jumlah_donasi) AS total'))
            ->join('donasis', 'donasis.id_donasi', '=', 'detail_donasis.id_donasi')
            ->join('programs', 'programs.id_program', '=', 'detail_donasis.id_program')
            ->where('donasis.tgl_donasi', '=', $request->tgl_donasi) //biar bisa request tgl
            ->groupBy('programs.nama_program')
            ->get();
        return $data;
    }

    public function cetakA1(Request $request)
    {
        $laporan = DB::table('detail_donasis')
            ->select('detail_donasis.id_program')
            ->select('programs.nama_program', DB::raw('SUM(detail_donasis.jumlah_donasi) AS total'))
            ->join('donasis', 'donasis.id_donasi', '=', 'detail_donasis.id_donasi')
            ->join('programs', 'programs.id_program', '=', 'detail_donasis.id_program')
            ->where('donasis.tgl_donasi', '=', $request->tgl_donasi) //biar bisa request tgl
            ->groupBy('programs.nama_program')
            ->get();

        $laporan2 = DB::select("SELECT * FROM donasis
            JOIN muzakis
                ON muzakis.id_muzaki = donasis.id_muzaki
            JOIN penggunas
                ON penggunas.id_pengguna = donasis.id_pengguna
                
                WHERE donasis.tgl_donasi = '" . $request->tgl_donasi . "'");


        $pdf = PDF::loadview(
            'laporan/laporan_harian', //nama file pdfnya
            [
                'laporan' => $laporan,
                'tgl_donasi' => $laporan2[0]->tgl_donasi

            ]
        )->setPaper('A4', 'potrait');
        return $pdf->stream();
    }
}
