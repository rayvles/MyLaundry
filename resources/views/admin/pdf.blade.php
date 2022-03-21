<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjemputan Laundry {{ date('d M, Y') }}</title>
    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }

        .main-table {
            width: 100%;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #727272;
        }

    </style>
</head>

<body>
    <h1>Data Penjemputan Laundry</h1>
    <table cellspacing="0" cellpadding="5" style="margin-bottom: 1.5em;">
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ date('d-m-Y') }}</td>
        </tr>
    </table>
    <table class="main-table" cellspacing="0" cellpadding="1" style="font-size: 0.8em; border: 1px solid #a5a5a5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pelanggan</th>
                <th>Alamat Pelanggan</th>
                <th>No. Telepon</th>
                <th>Jenis Kelamin</th>
                <th>Petugas Penjemputan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_penjemputanlaundry as $penjemputanlaundry)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $penjemputanlaundry->member->nama }}</td>
                    <td>{{ $penjemputanlaundry->member->alamat }}</td>
                    <td>{{ $penjemputanlaundry->member->telepon }}</td>
                    <td>{{ $penjemputanlaundry->member->jenis_kelamin }}</td>
                    <td>{{ $penjemputanlaundry->petugas_penjemput }}</td>
                    <td>
                        @switch($penjemputanlaundry->status)
                            @case('tercatat')
                                <span>Tercatat</span>
                            @break

                            @case('penjemputan')
                                <span>Penjemputan</span>
                            @break

                            @default
                                <span>Selesai</span>
                        @endswitch
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
