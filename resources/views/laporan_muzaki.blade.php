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
    <h3 align="center">Laporan Muzaki Zakat Infaq dan Shodaqoh</h3>
    <h3 align="center">Laz Al Irsyad Al Islamiyah Purwokerto</h3>
    <h3 align="center">Periode(1 - 30 Mei 2021)</h3>

    <div class="mt-1 row col-md-8" id="cetak">
        <table border="1" width="100%">
            <thead>
                <tr>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">No.</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Nama Muzaki</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Alamat</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Status</td>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($muzaki as $item)
                <tr>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$i++}}</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$item->nama_muzaki}}</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$item->alamat_muzaki}}</td>
                    @if($item->status_muzaki == 1)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Aktif</td>
                    @else
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Tidak Aktif</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>