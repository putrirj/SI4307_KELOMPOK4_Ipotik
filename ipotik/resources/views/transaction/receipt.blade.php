@extends('layout.app')
@section('layout_title', 'Input Resep')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <p class="h4 text-center mt-3 mb-3">Input Resep Dokter</p>
                        <div class="col-12 col-lg-8 mb-3 d-flex justify-content-center">
                            <div class="h-100 p-5 text-white bg-dark rounded-3 d-block text-center w-100">
                                <h2>Unggah Resep Dokter</h2>
                                <form action="{{ route('transaction.receipt_store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" class="form-control w-50 ms-auto me-auto mt-5 @error('file') is-invalid @enderror" accept=".jpg,.png,.pdf" required>
                                    @error('file')
                                        <p class="text text-danger text-center mb-0 mt-2">{{ $message }}</p>
                                    @enderror
                                    <button class="btn btn-outline-light w-25 mt-4" type="submit">Kirim</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <p class="text text-dark">Mendukung pdf, jpg, png.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection