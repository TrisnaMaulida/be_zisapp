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
    <h3 align="center">Laporan Penerimaan Zakat Infaq dan Shodaqoh</h3>
    <h3 align="center">Laz Al Irsyad Al Islamiyah Purwokerto</h3>
    <h3 align="center">Periode(sesuai tanggal yang dinputkan)</h3>

    <div class="mt-1 row col-md-8" id="cetak">
        <table border="1" width="100%">
            <thead>
                <tr>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">No.</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Nama Donatur</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Jenis Pembayaran</td>

                </tr>
            </thead>
            <tbody>
                @php $total_semua=0 @endphp
                @php $i=1 @endphp
                @foreach($donasi as $item)
                @php $total_semua=($total_semua+$item->total_donasi) @endphp

                <tr>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">{{$i++}}.</td>
                    <td style="border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">{{$item->nama_muzaki}}</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">Rp. {{number_format($item->total_donasi, 0, ',', '.')}}</td>
                </tr>
                @endforeach
            </tbody>
            <tr>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;" colspan="2"><b>Total</b></td>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;" colspan="1"><b>Rp. {{number_format($total_semua, 0, ',', '.')}} </b></td>
            </tr>
        </table>
    </div>
</body>

</html>