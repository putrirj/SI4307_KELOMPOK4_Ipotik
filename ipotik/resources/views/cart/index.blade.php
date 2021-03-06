@extends('layout.app')
@section('layout_title', 'Keranjang')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <p class="h4 text-center mt-3 mb-3">Keranjang</p>
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
                                                <form action="{{ route('cart.destroy', $cart->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                    <td><button class="btn btn-danger mt-2" type="submit" name="delete">Delete</button></td>
                                                </form>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="4">Keranjang kosong...</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        @if ($total > 0)
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-end">
                                                    <p class="mb-2">Total Belanja: Rp {{ $total }}</p>
                                                    <a href="{{ route('medicine.index') }}" class="btn btn-primary bg-primary border-0">Add Another</a>
                                                    <a href="{{ route('cart.create') }}" class="btn btn-primary bg-primary border-0">Checkout</a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        @endif
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