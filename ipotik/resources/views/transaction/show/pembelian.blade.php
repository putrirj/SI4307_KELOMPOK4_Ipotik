@extends('layout.app')
@section('layout_title', 'Detail Transaksi')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <p class="h4 text-center mt-3">Detail Pembelian</p>
                        <p class="h6 text-center mb-3">Status: 
                            @switch($transaction->status)
                                @case(0)
                                    Pending (Belum dibayar)
                                    @break
                                @case(1)
                                    Menunggu Konfirmasi (Mohon menunggu   )
                                    @break
                                @case(2)
                                    Ditolak (Pesanan tidak valid)
                                    @break
                                @case(3)
                                    >Diproses (Mohon menunggu)
                                    @break
                                @case(5)
                                    Dikirim (Pesanan sedang dikirim)
                                    @break
                                @case(6)
                                    Selesai (Pesanan sudah diterima)
                                    @break
                                @default
                            @endswitch
                        </p>
                        <div class="col-12 mt-3 mb-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        @if ($transaction->status != 0)
                                        <tr>
                                            <th class="table-dark" width="20%">Nama</th>
                                            <td>{{ $transaction->name }}</td>
                                            <th class="table-dark" width="20%">No. HP</th>
                                            <td>{{ $transaction->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th class="table-dark" width="20%">Alamat</th>
                                            <td>{{ $transaction->address }}</td>
                                            <th class="table-dark" width="20%">Jasa Pengiriman</th>
                                            <td>{{ $transaction->courier }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th class="table-dark" width="20%">Grand Total</th>
                                            <td>Rp. {{ $transaction->total }}</td>
                                            <th class="table-dark" width="20%">Tanggal</th>
                                            <td>{{ $transaction->created_at }}</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <h5>Pesanan</h5>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>No</th>
                                                <th>Nama Produk</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach ($transaction_details as $transaction_detail)
                                               <tr>
                                                   <td>{{ $loop->iteration }}</td>
                                                   <td>{{ $transaction_detail->name }}</td>
                                                   <td>Rp. {{ $transaction_detail->price }}</td>
                                                   <td>{{ $transaction_detail->quantity }}</td>
                                                   <td>Rp. {{ $transaction_detail->sub_total }}</td>
                                               </tr>
                                           @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection