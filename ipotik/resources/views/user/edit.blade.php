@extends('layout.app')
@section('layout_title', 'Update Profile')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row row-cols-s2 g-2">
                                <div class="col-12 col-lg-3">
                                    <div class="p-2">
                                        <img src="{{ asset('storage/'.$user->photo) }}" alt=""
                                            class="bd-placeholder-mg card-img-top rounded-circle" id="profile-photo-preview" width="100%">
                                    </div>
                                    <div class="card mt-3 bg-transparent border-0">
                                        <div class="input-group">
                                            <button class="btn btn-primary w-100 bg-primary border-0" onclick="changePhoto()" type="button">Ganti Foto</button>
                                            @error('photo')
                                                <p class="text text-danger">{{ $message }}</p>
                                            @enderror
                                            <input type="file" name="photo" class="form-control ms-auto me-auto d-none input-profile-photo" onchange="loadPhoto(event)" accept=".png, .jpg, .jpeg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <div class="mb-2">
                                        <div class="card-body">
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                                                    @error('name')
                                                        <p class="text text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea name="alamat" id="alamat" rows="4" class="form-control">{{ old('alamat', $user->alamat) }}</textarea>
                                                    @error('alamat')
                                                        <p class="text text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control">
                                                    @error('password')
                                                        <p class="text text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="password_confirmation">Konfirmasi Password</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                                    @error('password_confirmation')
                                                        <p class="text text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-4 text-center">
                                                    <button class="btn btn-primary bg-primary border-0 w-25" type="submit">Simpan</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection