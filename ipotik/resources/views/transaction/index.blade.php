@extends('layout.app')
@section('layout_title', 'Transaksi')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <p class="h4 text-center mt-3 mb-3">Status</p>
                        <div class="col-12 mb-3 d-flex justify-content-center">
                            <div class="h-100 p-5 text-white rounded-3 d-block text-center w-100">
                                <div class="table-responsive">
                                    <table class="table border-dark table-status">
                                        <thead>
                                            <tr>
                                                <th>Transaksi</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $transaction)
                                                <tr class="align-middle">
                                                @if ($transaction->type == "pembelian")
                                                    <td>
                                                        <img src="{{ asset('assets/images/cart.svg') }}">
                                                        <p class="ms-1 text-namafile">Pembelian @if($transaction->file_name!='') <br> ({{ $transaction->file_name }}) @endif</p>
                                                    </td>
                                                    <td class="text-center">Rp. {{ $transaction->total }}</td>
                                                    @switch($transaction->status)
                                                        @case(0)
                                                            <td class="text-center">Pending</td>
                                                            <td class="text-center">Belum dibayar</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                                <a href="{{ route('transaction.bayar', $transaction->id) }}" class="btn btn-danger">Bayar</a>
                                                            </td>
                                                            @break
                                                        @case(1)
                                                            <td class="text-center">Menunggu Konfirmasi</td>
                                                            <td class="text-center">Mohon menunggu</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                            </td>       
                                                            @break
                                                        @case(2)
                                                            <td class="text-center">Ditolak</td>
                                                            <td class="text-center">Pesanan tidak valid</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                            </td>       
                                                            @break
                                                        @case(3)
                                                            <td class="text-center">Diproses</td>
                                                            <td class="text-center">Mohon menunggu</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                            </td>    
                                                            @break
                                                        @case(5)
                                                            <td class="text-center">Dikirim</td>
                                                            <td class="text-center">Pesanan sedang dikirim</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                                <form action="{{ route('transaction.selesai', $transaction->id) }}" class="d-inline" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">Selesai</button>
                                                                </form>
                                                            </td>    
                                                            @break
                                                        @case(6)
                                                            <td class="text-center">Selesai</td>
                                                            <td class="text-center">Pesanan sudah diterima</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                            </td>    
                                                            @break
                                                        @default
                                                    @endswitch
                                                @else
                                                    <td>
                                                        <img src="{{ asset('assets/images/resep.svg') }}">
                                                        <p class="ms-1 text-namafile">{{ $transaction->file_name }}</p>
                                                    </td>
                                                    <td></td>
                                                    @switch($transaction->status)
                                                        @case(1)
                                                            <td class="text-center">Menunggu Konfirmasi</td>
                                                            <td class="text-center">Mohon menunggu</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                            </td>       
                                                            @break
                                                        @case(2)
                                                            <td class="text-center">Ditolak</td>
                                                            <td class="text-center">Resep tidak valid</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                            </td>    
                                                            @break
                                                        @case(3)
                                                            <td class="text-center">Diproses</td>
                                                            <td class="text-center">Mohon menunggu</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                            </td>    
                                                            @break
                                                        @case(4)
                                                            <td class="text-center">Diterima</td>
                                                            <td class="text-center">Obat sudah di keranjang</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                            </td>    
                                                            @break
                                                        @case(6)
                                                            <td class="text-center">Selesai</td>
                                                            <td class="text-center">Pesanan sudah dibuat</td>
                                                            <td class="text-center">
                                                                <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                            </td>    
                                                            @break
                                                        @default
                                                    @endswitch
                                                @endif
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">Belum ada transaksi...</td>
                                                </tr>
                                            @endforelse
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