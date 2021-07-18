<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Donasi</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>No Pengajuan</th>
                <th>Kegiatan</th>
                <th>Penerima</th>
                <th>Realisasi Dana</th>
                <th>Tanggal Realisasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($pengajuan as $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->no_pengajuan}}</td>
                <td>{{$item->nama_kegiatan}}</td>
                <td>{{$item->nama_mustahik}}</td>
                <td>{{$item->jumlah_realisasi}}</td>
                <td>{{$item->tgl_realisasi}}</td>
                <td>{{$item->status_pengajuan}}</td>
            </tr>
            @endforeach
        </tbody>


    </table>

    <button><a>Print</a></button>
</body>

</html>