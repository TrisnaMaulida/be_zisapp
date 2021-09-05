<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Bank</title>
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
    <h3 align="center">Laporan Bank</h3>
    <h3 align="center">Laz Al Irsyad Al Islamiyah Purwokerto</h3>

    <div class="mt-1 row col-md-8" id="cetak">
        <table border="1" width="100%">
            <thead>
                <tr>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">No.</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Nama Bank</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Nomor Rekening</td>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($bank as $item)
                <tr>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$i++}}.</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$item->nama_bank}}</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">{{$item->no_rek}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>