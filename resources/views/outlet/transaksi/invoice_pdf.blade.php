<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyLaundry Invoice</title>

</head>

<body>
    <table>
        <tr>
            <td>
                <div>
                    <h2><i class="fas fa-globe mr-1"></i><span>MyLaundry</span></h2>
                    <div class="text-sm">Alamat lokasi: Jl. Ganesha 10, Bandung, Kota Bandung</div>
                    <div class="text-sm">Telepon : 089540898123 - Email : contact@MyLaundry.id</div>
                </div>
                <div>
                    <div>Operator : {{ $transaction->user->name }}</div>
                    <div>Outlet : {{ $transaction->outlet->nama }}</div>
                </div>
            </td>
            <td>
                <b>FAKTUR no. {{ $transaction->kode_invoice }}</b><br>
                <div>{{ date('d/m/Y', strtotime($transaction->tgl)) }}</div>
                <div>Kepada Yth :</div>
                <div>{{ $transaction->member->nama }}<br></div>
                <div>{{ $transaction->member->alamat }}</div>
                <div>{{ $transaction->member->telepon }}</div>
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin: 20px 0;" cellpadding="10px">
        <thead>
            <tr>
                <th>#</th>
                <th>Layanan</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->details as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->paket->nama_paket }}</td>
                    <td style="text-align: center">Rp {{ number_format($item->paket->harga) }}</td>
                    <td style="text-align: center">{{ $item->qty }}</td>
                    <td style="text-align: right">Rp {{ number_format($item->paket->harga * $item->qty) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table style="width:100%">
        <tr>
            <td style="width: 50%; font-size: 0.8em">
                <b>PERHATIAN</b>
                <ol>
                    <li>Pengambilan barang dibayar tunai.</li>
                    <li>Jika terjadi kehilangan/kerusakan kami hanya mengganti tidak lebih dari 2x ongkos cuci.
                    </li>
                    <li>Hak claim yang kami terima tidak lebih dari 24 jam dari pengambilan.</li>
                </ol>
                <b>KAMI TIDAK BERTANGGUNG JAWAB</b>
                <ol>
                    <li>Susut/luntur karena sifat bahannya.</li>
                    <li>Cucian yang tidak diambil dalam tempo 1 bulan hilang/rusak.</li>
                    <li>Bila terjadi kebakaran</li>
                </ol>
            </td>
            <td valign="top">
                <table class="table" style="width:100%" cellpadding="10px">
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td style="text-align: right">Rp {{ number_format($transaction->getTotalPrice()) }}</td>
                    </tr>
                    <tr>
                        <th>Pajak ({{ $transaction->pajak }}%)</th>
                        <td style="text-align: right">Rp {{ number_format($transaction->getTotalTax()) }}</td>
                    </tr>
                    <tr>
                        <th>Diskon</th>
                        <td style="text-align: right">Rp {{ number_format($transaction->getTotalDiscount()) }}</td>
                    </tr>
                    <tr>
                        <th>Total Pembayaran</th>
                        <td style="text-align: right">Rp {{ number_format($transaction->getTotalPayment()) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
