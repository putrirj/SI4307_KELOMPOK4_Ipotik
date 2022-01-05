@extends('layout.app')
@section('layout_title', 'Edit Obat')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <form action="{{ route('medicine.update', $medicine->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row mt-3 justify-content-center">
                            <div class="col-12 col-lg-8">
                                <div class="form-group">
                                    <label for="name">Nama Obat</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $medicine->name) }}" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <p class="text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="price">Harga Obat</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="number" name="price" id="price" value="{{ old('price', $medicine->price) }}" class="form-control @error('price') is-invalid @enderror">
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
                                    <input class="form-check-input" type="checkbox" name="need_receipt" id="need_receipt">
                                    <label class="form-check-label" for="need_receipt">
                                        Butuh Resep Dokter
                                    </label>
                                </div>
                                <div class="form-group mt-4 text-center">
                                    <button class="btn btn-success btn-lg" type="submit">Update Obat</button>
                                    <button class="btn btn-danger btn-lg" type="button" onclick="hapusObat()">Hapus Obat</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('medicine.destroy', $medicine->id) }}" method="post" id="form-delete">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection
@section('layout_script')
    @if (old('category_id', $medicine->category_id) != null)
        $('#category_id').val("{{ old('category_id', $medicine->category_id) }}");
    @endif

    @if (old('need_receipt', $medicine->need_receipt) != null)
        $('#need_receipt').prop('checked', {{ old('need_receipt', $medicine->need_receipt) }});
    @endif

    function hapusObat(){
        document.getElementById('form-delete').submit();
    }
@endsection