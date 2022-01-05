@extends('layout.app')
@section('layout_title', 'Tambah Obat')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <form action="{{ route('medicine.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-3 justify-content-center">
                            <div class="col-12 col-lg-8">
                                <div class="form-group">
                                    <label for="name">Nama Obat</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="price">Harga Obat</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="number" name="price" id="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror">
                                    </div>
                                    @error('price')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="category_id">Kategori Obat</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="photo">Upload Foto</label>
                                    <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept=".png, .jpg, .jpeg">
                                    @error('photo')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" name="need_receipt">
                                    <label class="form-check-label" for="need_receipt">
                                        Butuh Resep Dokter
                                    </label>
                                </div>
                                <div class="form-group mt-4 text-center">
                                    <button class="btn btn-success btn-lg" type="submit">Tambah Obat</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection