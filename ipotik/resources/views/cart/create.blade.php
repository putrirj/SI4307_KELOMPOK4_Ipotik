@extends('layout.app')
@section('layout_title', 'Checkout')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <form action="{{ route('cart.checkout') }}" method="post">
                        @csrf
                        <div class="row justify-content-center mt-3">
                            <p class="h4 text-center mt-3 mb-3">Checkout</p>
                            <div class="col-12 col-lg-6">
                                <div class="card container p-3">
                                    <h5>Data Diri</h5>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Nomor HP</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                        @error('address')
                                            <p class="text text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="courier" class="form-label">Jasa Pengiriman</label>
                                        <select name="courier" class="form-select" required>
                                            <option value="J&T">J&T</option>
                                            <option value="JNE">JNE</option>
                                            <option value="SiCepat">SiCepat</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card container p-3">
                                    <h5>Daftar Pesanan</h5>
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
                                                    @foreach ($carts as $cart)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}</th>
                                                        <td>{{ $cart->medicine->name }}</td>
                                                        <td class="text-center">{{ $cart->medicine->price }}</td>
                                                        <td class="text-center">{{ $cart->quantity }}</td>
                                                        <td class="text-end">{{ $cart->sub_total }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr class="border-0">
                                                        <td colspan="6" class="text-end border-0">
                                                            <p class="h5">Grand Total: Rp. {{ $total }}</p>
                                                            <button type="submit" class="btn btn-primary">Pesan</button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection