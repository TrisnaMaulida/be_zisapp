<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Mustahik</title>
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
    <h3 align="center">Laporan Mustahik</h3>
    <h3 align="center">Laz Al Irsyad Al Islamiyah Purwokerto</h3>

    <div class="mt-1 row col-md-8" id="cetak">
        <table border="1" width="100%">
            <thead>
                <tr>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">No.</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Nama Mustahik</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Alamat</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Ketegori</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Asnaf</td>

                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($mustahik as $item)
                <tr>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$i++}}</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$item->nama_mustahik}}</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$item->alamat_mustahik}}</td>
                    @if($item->kategori_mustahik == 1)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Perorangan</td>
                    @else
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Lembaga</td>
                    @endif
                    @if($item->asnaf == 1)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Fakir Miskin</td>
                    @elseif($item->asnaf == 2)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Roqib</td>
                    @elseif($item->asnaf == 3)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Ibnu Sabil</td>
                    @elseif($item->asnaf == 4)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Ghorimin</td>
                    @elseif($item->asnaf == 5)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Amil</td>
                    @elseif($item->asnaf == 6)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Fisabilillah</td>
                    @elseif($item->asnaf == 7)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Lain-lain</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>