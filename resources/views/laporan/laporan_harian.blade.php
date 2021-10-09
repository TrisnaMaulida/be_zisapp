<html>

<head>
    <title>Cetak Struk A1</title>
    <style>
        @font-face {
            font-family: "sqr";
            src: url('../lib/fonts/square721.ttf');
        }

        @media print {

            html,
            body {
                font-family: "sqr";
            }

            /* .logo {
            width: 30%;
            } */

        }
    </style>
</head>

<body>
    {{$tgl_donasi}}

    <br>
    <div id="cetak">
        <div class="row col-md-1">
            <p>LAPORAN PENERIMAAN HARIAN</p>
            <p align="justify">Bissmillahirrohmaanirohiim Pada Hari ini <span contenteditable="true">---</span> <?php echo date('d F Y', strtotime($tgl_donasi)) . ","; ?> Alhamdulillah telah diterima dana Zakat, Infaq dan Shodaqoh dengan rincian:</p>
            Dokumen Kuitansi Penerimaan:<span contenteditable="true">---</span>Lembar
            <br><br>

            <table width="100%">
                <tr>
                    <td id="kiri" valign="top">
                        <table width="100%" border="0" class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <td>Keterangan</td>
                                    <td align="right">Jumlah</td>
                                </tr>
                            </thead>
                            <tbody id="data-here"></tbody>
                            <tfoot>
                                <tr>
                                    <td>Total Penerimaan: </td>
                                    <td align="right"><span id="total_penerimaan"></span></td>
                                </tr>
                            </tfoot>
                        </table>
                        <table width="100%">
                            <tr align="center">
                                <td></td>
                                <td align="right">Purwokerto, <?php echo date('d F Y', strtotime($tgl_donasi)); ?></td>
                            </tr>
                            <tr align="center">
                                <td>ZISR/FO</td>
                                <td>Kasir</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td id="zisrfo" align="center" contenteditable="true">---</td>
                                <td align="center" contenteditable="true">---</td>
                            </tr>
                        </table>

                    </td>
                    <td>&nbsp;</td>
                    <td id="kanan">
                        <table width="50%" class="table table-bordered table-condensed" id="denominasi">
                            <tr>
                                <td>Pecahan Kertas </td>
                                <td align="right">Jumlah</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div>100.000</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">50.000</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">20.000</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">10.000</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">5.000</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">2.000</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">1.000</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Pecahan Logam </td>
                                <td align="right">Jumlah</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">1.000</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">500</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">200</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">100</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                        </table>
        </div>



</body>

</html>