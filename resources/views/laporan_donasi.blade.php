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
                <th>Nama Donatur</th>
                <th>Tanggal</th>
                <th>Program</th>
                <th>Jumlah Donasi</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($donasi as $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->nama_muzaki}}</td>
                <td>{{$item->tgl_donasi}}</td>
                <td>{{$item->nama_program}}</td>
                <td>{{$item->total_donasi}}</td>
            </tr>
            @endforeach
        </tbody>


    </table>
</body>

</html>