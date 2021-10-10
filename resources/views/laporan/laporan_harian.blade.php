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
    <br>
    <div id="cetak">
        <div class="row col-md-1">
            <table width="600">
                <tr>
                    <td>
                        <p>LAPORAN PENERIMAAN HARIAN</p>
                    </td>
                    <td>
                        <p>FORMULIR A1</p>
                    </td>
                </tr>
            </table>

            <p align="justify">Bissmillahirrohmaanirohiim Pada Hari ini <span contenteditable="true">---</span> <?php echo date('d F Y', strtotime($tgl_donasi)) . ","; ?> Alhamdulillah telah diterima dana Zakat, Infaq dan Shodaqoh dengan rincian:</p>
            Dokumen Kuitansi Penerimaan:<span contenteditable="true">---</span>Lembar
            <br><br>

            <table width="100%">
                <tr>
                    <td id="kiri" valign="top">
                        <table width="100%" border="1">
                            <thead>
                                <tr>
                                    <td>Keterangan</td>
                                    <td align="right">Jumlah</td>
                                </tr>
                                @php $total=0 @endphp
                                @foreach($laporan as $item)
                                @php $total=($total+$item->total) @endphp
                                <tr>
                                    <td>{{$item->nama_program}}</td>
                                    <td align="right">Rp. {{number_format ($item->total)}}</td>
                                </tr>
                                @endforeach
                            </thead>
                            <tbody id="data-here"></tbody>
                            <tfoot>
                                <tr>
                                    <td>Total Penerimaan: </td>
                                    <td align="right"><span id="total_penerimaan">Rp. {{number_format($total, 0, ',', '.')}}</span></td>
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
                        <table width="100%" border="0.5" class="table table-bordered" id="denominasi">
                            <tr>
                                <td>Pecahan Kertas </td>
                                <td align="right">Jumlah</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div>Rp. {{number_format(100000)}}</div>
                                </td>
                                <td contenteditable="true">isinya</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">Rp. {{number_format(50000)}}</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">Rp. {{number_format(20000)}}</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">Rp. {{number_format(10000)}}</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">Rp. {{number_format(5000)}}</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">Rp. {{number_format(2000)}}</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">Rp. {{number_format(1000)}}</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Pecahan Logam </td>
                                <td align="right">Jumlah</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">Rp. {{number_format(1000)}}</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">Rp. {{number_format(500)}}</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">Rp. {{number_format(200)}}</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                            <tr align="right">
                                <td>
                                    <div align="right">Rp. {{number_format(100)}}</div>
                                </td>
                                <td contenteditable="true">&nbsp;</td>
                            </tr>
                        </table>
        </div>



</body>

</html>