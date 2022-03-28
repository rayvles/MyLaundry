<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cleandry Invoice</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css?v=3.2.0">
</head>

<body>
    <div class="wrapper">
        <div class="invoice">
            <div class="row p-3">
                <div class="col d-flex flex-column justify-content-between">
                    <div>
                        <h2><i class="fas fa-globe mr-1"></i><span>MyLaundry</span></h2>
                        <div class="text-sm">Alamat lokasi: Jl. Ganesha 10, Bandung, Kota Bandung</div>
                        <div class="text-sm">Telepon : 089540898123 - Email : contact@MyLaundry.id</div>
                    </div>
                    <div>
                        <div>Operator : {{ $transaction->user->name }}</div>
                        <div>Outlet : {{ $transaction->outlet->nama }}</div>
                    </div>
                </div>
                <div class="col">
                    <b>FAKTUR no. {{ $transaction->kode_invoice }}</b><br>
                    <div>{{ date('d/m/Y', strtotime($transaction->tgl)) }}</div>
                    <div>Kepada Yth :</div>
                    <div>{{ $transaction->member->nama }}<br></div>
                    <div>{{ $transaction->member->alamat }}</div>
                    <div>{{ $transaction->member->telepon }}</div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Paket</th>
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
                                    <td>Rp {{ number_format($item->paket->harga) }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp {{ number_format($item->paket->harga * $item->qty) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-6 text-sm">
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
                </div>
                <div class="col-6">
                    @if ($transaction->status_pembayaran == 'dibayar')
                        <p class="lead">Dibayar Pada
                            {{ date('d/m/Y', strtotime($transaction->tgl_bayar)) }}</p>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>Rp {{ number_format($transaction->getTotalPrice()) }}</td>
                            </tr>
                            <tr>
                                <th>Pajak ({{ $transaction->pajak }}%)</th>
                                <td>Rp {{ number_format($transaction->getTotalTax()) }}</td>
                            </tr>
                            <tr>
                                <th>Diskon</th>
                                <td>Rp {{ number_format($transaction->getTotalDiscount()) }}</td>
                            </tr>
                            <tr>
                                <th>Total Pembayaran</th>
                                <td>Rp {{ number_format($transaction->getTotalPayment()) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
