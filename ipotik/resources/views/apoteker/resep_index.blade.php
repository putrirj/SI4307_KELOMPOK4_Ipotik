@extends('layout.app')
@section('layout_title', 'Transaksi')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-12">
            <section id="menu">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <p class="h4 text-center mt-3 mb-3">Verifikasi Resep & Pembelian</p>
                        <div class="col-12 mb-3 d-flex justify-content-center">
                            <div class="h-100 p-5 text-white rounded-3 d-block text-center w-100">
                                <div class="table-responsive">
                                    <table class="table border-dark table-status">
                                        <thead>
                                            <tr>
                                                <th>Pengguna</th>
                                                <th>Transaksi</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $transaction)
                                                <tr class="align-middle">
                                                    <td>
                                                        <img src="{{ asset('storage/'.$transaction->user->photo) }}" style="max-width: 30px;">
                                                        <p class="ms-1 text-namafile">@if($transaction->name) {{ $transaction->name }} @else {{ $transaction->user->name }} @endif</p>
                                                    </td>
                                                    <td>
                                                        @if ($transaction->type == 'pembelian')
                                                            <img src="{{ asset('assets/images/cart.svg') }}">
                                                            <p class="ms-1 text-namafile">Pembelian</p>
                                                        @else
                                                            <img src="{{ asset('assets/images/resep.svg') }}">
                                                            <p class="ms-1 text-namafile">{{ $transaction->file_name }}</p>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @switch($transaction->status)
                                                            @case(0)
                                                                Belum Dibayar
                                                                @break
                                                            @case(1)
                                                                Menunggu Konfirmasi     
                                                                @break
                                                            @case(2)
                                                                Ditolak    
                                                                @break
                                                            @case(3)
                                                                Diproses   
                                                                @break
                                                            @case(4)
                                                                Diterima   
                                                                @break
                                                            @case(5)
                                                                Dikirim    
                                                                @break
                                                            @case(6)
                                                                Selesai
                                                                @break
                                                            @default
                                                        @endswitch
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                                        @if ($transaction->status==1)
                                                            <form action="{{ route('verifikasi.tolak', $transaction->id) }}" method="post" class="d-inline">
                                                                @csrf
                                                                <button class="btn btn-danger" type="submit">Tolak</button>
                                                            </form>
                                                            <form action="{{ route('verifikasi.proses', $transaction->id) }}" method="post" class="d-inline">
                                                                @csrf
                                                                <button class="btn btn-success" type="submit">Terima</button>
                                                            </form>
                                                        @elseif ($transaction->status==3)
                                                            @if ($transaction->type=='pembelian')
                                                                <form action="{{ route('verifikasi.dikirim', $transaction->id) }}" method="post" class="d-inline">
                                                                    @csrf
                                                                    <button class="btn btn-success" type="submit">Dikirim</button>
                                                                </form>
                                                            @else
                                                                <a class="btn btn-primary" href="{{ route('verifikasi.keranjang', $transaction->id) }}">Tindak Lanjut</a>
                                                            @endif
                                                        @endif
                                                    </td>    
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