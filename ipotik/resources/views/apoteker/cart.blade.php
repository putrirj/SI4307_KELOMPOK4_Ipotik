@extends('layout.app')
@section('layout_title', 'Keranjang')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <p class="h4 text-center mt-3">Keranjang</p>
                        <p class="h6 text-center mb-3">{{ $transaction->user->name }} | {{ $transaction->file_name }}</p>
                        <div class="col-12 col-lg-10 mb-3 d-flex justify-content-center">
                            <div class="h-100 p-5 text-white rounded-3 d-block text-center w-100">
                                <div class="table-responsive">
                                    <table class="table table-keranjang">
                                        <thead>
                                            <tr>
                                                <th>Nama Obat</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-dark">
                                            @forelse ($carts as $cart)
                                            <tr>
                                                <td class="text-start">
                                                    <img src="{{ asset('storage/'.$cart->medicine->photo) }}" class="img-obat">
                                                    <p class="ms-1 text-namafile">{{ $cart->medicine->name }}</p>
                                                </td>
                                                <td class="text-center">Rp. {{ $cart->medicine->price }}</td>
                                                <td class="text-center">{{ $cart->quantity }}</td>
                                                <td class="text-center">Rp. {{ $cart->sub_total }}</td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="4">Keranjang kosong...</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-5">
                                    <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a>
                                    <a href="{{ route('verifikasi.keranjang.category', $transaction->id) }}" class="btn btn-warning">Tambah Obat</a>
                                    <form action="{{ route('verifikasi.keranjang.pesanan', $transaction->id) }}" method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Buat Pesanan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection