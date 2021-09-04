<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Donasi</title>
    <style>
        @font-face {
            font-family: "sqr";
            src: url('../lib/fonts/square721.ttf');
        }

        @media print {

            html,
            body {
                font-family: "sqr";
                transform: scale(.8);
            }
        }

        table,
        th,
        td {
            border-collapse: collapse;
        }

        .ml-1 {
            margin-left: 10px;
        }

        .mt-1 {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <center><img src="image/kopsurat.jpg" width="80%"></center>
    <h3 align="center">Laporan Pengajuan Zakat Infaq dan Shodaqoh</h3>
    <h3 align="center">Laz Al Irsyad Al Islamiyah Purwokerto</h3>
    <h3 align="center">Periode(1 - 30 Mei 2021)</h3>

    <div class="mt-1 row col-md-8" id="cetak">
        <table border="1" width="100%">
            <thead>
                <tr>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">No.</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">No. Pengajuan</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Penerima</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Kegiatan</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Realisasi Dana</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Tanggal Realisasi</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Status</td>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($pengajuan as $item)
                <tr>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$i++}}</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$item->no_pengajuan}}</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$item->nama_mustahik}}</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$item->pengajuan_kegiatan}}</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Rp. {{number_format($item->jumlah_realisasi, 0, ',', '.')}}</td>
                    @if($item->tgl_realisasi== null)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Belum Realisasi</td>
                    @else
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{date('d-M-Y', strtotime($item->tgl_realisasi))}}</td>
                    @endif
                    @if($item->status_pengajuan == 1)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Proses</td>
                    @elseif($item->status_pengajuan == 2)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Diterima</td>
                    @elseif($item->status_pengajuan == 3)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Ditolak</td>
                    @elseif($item->status_pengajuan == 4)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Selesai</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>