@extends('layout.app')
@section('layout_title', 'Obat '.$category->name)
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <div class="row mt-3">
                        <form action="" method="get" class="w-100">
                            <div class="input-group">
                                <input type="text" class="form-control input-search" name="keyword" placeholder="Search here..." value="{{ $keyword }}">
                                <button class="btn btn-outline-secondary button-search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="row justify-content-start mt-3">
                        <div class="col-12 mb-3 d-inline">
                            <div class="card d-inline-block" style="width: 8rem;">
                                <img src="{{ asset('storage/'.$category->photo) }}" class="card-img-top card-menu" />
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-start mt-3">
                        @forelse ($medicines as $medicine)
                        <div class="col-12 col-md-4 col-lg-3 mb-3 d-flex justify-content-center">
                            <div class="card w-100">
                                <img src="{{ asset('storage/'.$medicine->photo) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $medicine->name }}</h5>
                                    <p class="card-text">Rp. {{ $medicine->price }}</p>
                                    <a href="{{ route('verifikasi.keranjang.medicine_detail', ['transaction' => $transaction->id, 'medicine' => $medicine->id]) }}" class="btn btn-primary w-100 bg-primary border-0 mb-2">Tambah</a>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="col-12"><p class="h6 badge bg-warning text-dark">Belum Ada Obat</p></div>
                        @endforelse
                    </div>
                    <div class="row mt-3">
                        {{ $medicines->links() }}
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection