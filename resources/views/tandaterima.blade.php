<html>

<head>
    <title>Cetak Struk</title>
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

    <!-- Call JQuery Library -->
    <script src="../bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>

    <!-- Call DataTables Library -->
    <script src="../bower_components/PrintArea/demo/jquery-1.10.2.js" type="text/JavaScript" language="javascript"></script>
    <script src="../bower_components/PrintArea/demo/jquery-ui-1.10.4.custom.js"></script>
    <script src="../bower_components/PrintArea/demo/jquery.PrintArea.js" type="text/javascript"></script>

    <!-- Data Tables CSS -->
    <link rel="stylesheet" type="text/css" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="../bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../bower_components/chosen/chosen.min.css"> -->
</head>

<body>

    <div class="mt-1 row col-md-8" id="cetak">
        <table width="100%">
            <tr>
                <td align="center"><u>TANDA TERIMA</u></td>
            </tr>
            <tr>
                <td align="center" rowspan="1"><i>Bismillahirrahmannirrahim<i></td>

                <td align="center" style="border: 1px solid black; width: 42px;">SK Pembentukan LAZ Kemenag <br>Jateng :
                    4132/Kw.11.7/4/BA.03.2/06/2017</td>
            </tr>
        </table>
        <table border="0" width="97%">
            <tr>
                <td colspan="5">Telah diterima dari</td>
            </tr>
            <tr>
                <td>Nama Donator</td>
            </tr>
            <tr>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">Tanggal Transaksi</td>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Jenis Pembayaran</td>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">Transfer ke Bank</td>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">Ke No. Rekening</td>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid;">Uang Sejumlah</td>
            </tr>
            <tr>
                <td style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;" colspan="4">Total</td>
                <td id="ttl_donasi" style="text-align: center; border-top: 1px black solid; border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;" colspan="3"></td>
            </tr>
        </table>
        <br>
        <table border="0" width="100%">
            <tr>
                <td></td>
                <td style="border: 1px solid black; text-align: center" width="120px">Penerima</td>
            </tr>

            <tr>
                <td style="text-align: center;" width="520px">
                    <p><i>"Ajarakallahu fiima a'toita, wa barokallahu fiima abqoita. waja'alallahu laka
                            <br>thohuuron"</i></p>
                    <p style="text-align: center;"><i>(Semoga Allah menerima harta yang telah kau berikan (dikeluarkan), dan memberi
                            <br>keberkahan harta yang masih dalam genggaman, dan menjadikannya suci.)</i></p>
                </td>
                <td style="border-right: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; text-align: center" width="120px">
                </td>
            </tr>
            <tr>
                <td></td>
                <td id="petugas" style="border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black; text-align: center" width="160px">
                    Blank petugas
                </td>
            </tr>
            <tr>
                <td style="text-align: left;" width="520px">
                    <p><i>Informasi program pendayagunaan dana Zakat, Infaq dan Sedekah (ZIS) dapat
                            diakses melalui website : lazalirsyadalislamiyyah.org</i></p>
                </td>
                <td></td>
            </tr>

        </table>

    </div>
    <div class="ml-1 mt-1 row col-md-2">
        <button>Cetak</button>
    </div>
</body>

</html>