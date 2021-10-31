<?php

namespace App\Http\Controllers\laporan;

use DB;
use App\Http\Controllers\Controller;
use App\LaporanHarian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class LaporanHarianController extends Controller
{
    //get laporan harian

    public function index(Request $request)
    {
        # code...
        $programs = DB::table('detail_donasis')
            ->select('detail_donasis.id_program')
            ->select('programs.nama_program', DB::raw('SUM(detail_donasis.jumlah_donasi) AS jumlah'))
            ->select('programs.nama_program', DB::raw('SUM(detail_donasis.jumlah_donasi) AS total'))
            ->join('donasis', 'donasis.id_donasi', '=', 'detail_donasis.id_donasi')
            ->join('programs', 'programs.id_program', '=', 'detail_donasis.id_program')
            ->where('donasis.tgl_donasi', '=', $request->tgl_donasi) //biar bisa request tgl
            ->groupBy('programs.nama_program')
            ->get();

        $total = 0;
        foreach ($programs as $value) {
            //var_dump($value);
            $total = $total + $value->total;
        }
        $data['status'] = true;
        $data['message'] = "Laporan Harian";
        $data['data'] = $programs;
        $data['total_semua'] = $total;
        return $data;
    }

    public function cetakA1(Request $request)
    {
        $laporan = DB::table('detail_donasis')
            ->select('detail_donasis.id_program')
            ->select('programs.nama_program', DB::raw('SUM(detail_donasis.jumlah_donasi) AS jumlah'))
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
                'kertas_seratus' => $request->kertas_seratus,
                'kertas_limapuluh' => $request->kertas_limapuluh,
                'kertas_duapuluh' => $request->kertas_duapuluh,
                'kertas_sepuluh' => $request->kertas_sepuluh,
                'kertas_limaribu' => $request->kertas_limaribu,
                'kertas_duaribu' => $request->kertas_duaribu,
                'kertas_seribu' => $request->kertas_seribu,
                'logam_seribu' => $request->logam_seribu,
                'logam_limaratus' => $request->logam_limaratus,
                'logam_duaratus' => $request->logam_duaratus,
                'logam_seratus' => $request->logam_seratus,
                'laporan' => $laporan,
                'tgl_donasi' => $laporan2[0]->tgl_donasi

            ]
        )->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    public function cetakA2(Request $request)
    {
        $laporan = DB::table('detail_donasis')
            ->select('detail_donasis.id_program')
            ->select('programs.nama_program', DB::raw('SUM(detail_donasis.jumlah_donasi) AS jumlah'))
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
            'laporan/laporan_harianA2', //nama file pdfnya
            [
                'laporan' => $laporan,
                'tgl_donasi' => $laporan2[0]->tgl_donasi

            ]
        )->setPaper('A4', 'potrait');
        return $pdf->stream();
    }
}
