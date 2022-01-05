@extends('layout.app')
@section('layout_title', $medicine->name)
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <div class="row row-cols-s2 g-2">
                            <div class="col-12 col-lg-3">
                                <div class="p-2">
                                    <img src="{{ asset('storage/'.$medicine->photo) }}" alt=""
                                        class="bd-placeholder-mg card-img-top" id="profile-photo-preview" width="100%">
                                </div>
                            </div>
                            <div class="col-12 col-lg-9">
                                <div class="card shadow-sm mb-2">
                                    <div class="card-body">
                                        <p class="card-text-title">{{ $medicine->name }}</p>
                                        <hr>
                                        <p class="card-text fs-6 mt-3 mb-0">Kategori :</p>
                                        <p class="card-text">{{ $medicine->category->name }}</p>
                                        <p class="card-text fs-6 mt-3 mb-0">Harga :</p>
                                        <p class="card-text">Rp. {{ $medicine->price }}</p>
                                        <p class="card-text fs-6 mt-3 mb-0">Harus dengan resep dokter :</p>
                                        <p class="card-text">@if ($medicine->need_receipt) Ya @else Tidak @endif</p>
                                    </div>
                                </div>
                                @if (Auth::check() && Auth::user()->role == 'user' && !$medicine->need_receipt)
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <p class="card-text-title">Tambah Ke Keranjang</p>
                                        <hr>
                                        <form action="{{ route('cart.store', $medicine->id) }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-2 text-end d-flex align-items-center justify-content-end">
                                                    <label for="quantity" class="">Jumlah :</label>
                                                </div>
                                                <div class="col-10">
                                                    <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" required>
                                                </div>
                                            </div>
                                            @error('quantity')
                                            <div class="row">
                                                <div class="col-2 text-end d-flex align-items-center justify-content-end">
                                                </div>
                                                <div class="col-10">
                                                    <p class="text text-danger">{{ $message }}</p>
                                                </div>
                                            </div>
                                            @enderror
                                            <div class="row d-flex justify-content-center mt-3">
                                                <input type="submit" name="submit" class="btn btn-primary w-25" value="Tambah">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection