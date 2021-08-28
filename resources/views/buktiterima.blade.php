<html>

<head>
    <title>Cetak Tanda Terima</title>
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

            /* .logo {
            width: 30%;
            } */

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

    <div class="mt-1 row col-md-8" id="cetak">
        <table border="0" width="100%">
            <tr>
                <td align="center" colspan="2"><u>TANDA TERIMA</u></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><i>Bismillahirrahmannirrahim<i></td>
            </tr>
            <tr>
                <td style="text-align: center" width="65%"></td>
                <td align="center" style="border: 1px;">SK Pembentukan LAZ Kemenag <br>Jateng :
                    4132/Kw.11.7/4/BA.03.2/06/2017</td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <br>
            <tr>
                <td>Telah diterima dari {{$nama_donatur}} ({{$npwz}})</td>
            </tr>
        </table>
        <table width="100%">

            <tr>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">Tanggal Transaksi</td>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">Jenis Pembayaran</td>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">Program</td>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;" colspan="3">Uang Sejumlah</td>
            </tr>
            <tbody>
                @php $total_donasi=0 @endphp
                @foreach($donasi1 as $item)
                @php $total_donasi=($total_donasi+$item->jumlah_donasi) @endphp
                <tr>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">{{date('d-M-Y', strtotime($item->tgl_donasi))}}</td>
                    @if($item->metode == 1)
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Tunai</td>
                    @else
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Mutasi Bank</td>
                    @endif
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">{{$item->nama_program}}</td>
                    <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;" colspan="3">Rp. {{number_format($item->jumlah_donasi, 0, ',', '.')}}</td>
                </tr>
                @endforeach
            </tbody>

            <tr>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;" colspan="3">Total</td>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;" colspan="3">Rp. {{number_format($total_donasi, 0, ',', '.')}}</td>
            </tr>
        </table>
        <br>
        <table border="0" width="100%">
            <br>
            <tr>
                <td style="text-align: center;" colspan="2">
                    <p><i>"Ajarakallahu fiima a'toita, wa barokallahu fiima abqoita. waja'alallahu laka
                            <br>thohuuron"</i></p>
                    <p style="text-align: center;"><i>(Semoga Allah menerima harta yang telah kau berikan (dikeluarkan), dan memberi
                            <br>keberkahan harta yang masih dalam genggaman, dan menjadikannya suci.)</i></p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center">Penerima</td>
            </tr>
            <tr>
                <td></td>
                <td align="center" height="8%">
                    {{$petugas}}
                </td>
            </tr>
            <tr>
                <td style="text-align: left" colspan="2">
                    <p><i>Informasi program pendayagunaan dana Zakat, Infaq dan Sedekah (ZIS) dapat
                            diakses melalui website : lazalirsyadalislamiyyah.org</i></p>
                </td>
            </tr>

        </table>

    </div>

</body>

</html>