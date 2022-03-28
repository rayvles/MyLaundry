@extends('admin.layouts.main')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cetak Faktur</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Outlet</a></li>
                    <li class="breadcrumb-item"><a href="/outlet/{{ $outlet->id }}">{{ $outlet->id }}</a></li>
                    <li class="breadcrumb-item active">Invoice</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-4">
                    <div class="row p-3">
                        <div class="col d-flex flex-column justify-content-between">
                            <div>
                                <h2><i class="fas fa-globe mr-1"></i><span>My Laundry</span></h2>
                                <div class="text-sm">Alamat lokasi: Jl. Ganesha 10, Bandung, Kota Bandung, Jawa Barat.</div>
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
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="?print=true" rel="noopener" target="_blank" class="btn btn-default"><i
                                    class="fas fa-print"></i> Print</a>
                            <a
                            href="{{ route('transaksi.sendWhatsapp', [$transaction->outlet->id, $transaction->id]) }}"
                                class="btn btn-success float-right" style="margin-right: 5px;">
                                <i class="fab fa-whatsapp"></i> Kirim Whatsapp
                            </a>
                            <a
                            href="{{ route('transaksi.invoicePDF', [$transaction->outlet->id, $transaction->id]) }}"
                                class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-file-pdf"></i> Download PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
