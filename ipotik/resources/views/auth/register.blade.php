@extends('layout.auth')
@section('layout_title', 'Register')
@section('layout_content')
<div class="card shadow">
    <div class="card-body">
        <p class="card-title">Welcome</p>
        <ul class="nav nav-pills mb-3  justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item nav-login-card" role="presentation">
                <a href="{{ route('login') }}" class="nav-link bg-white" type="button">Sign In</a>
            </li>
            <li class="nav-item nav-login-card" role="presentation">
                <a href="{{ route('register') }}" class="nav-link active bg-white" type="button">Sign Up</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active ps-5 pe-5" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    @if (session('alert_type'))
                        <div class="alert alert-{{ session('alert_type') }}">
                            {{ session('alert_message') }}
                        </div>
                    @endif
                    <div class="form-group mt-4">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" value="{{ old('name') }}">
                        @error('name')
                            <p class="text text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <p class="text text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" value="{{ old('alamat') }}">
                        @error('alamat')
                            <p class="text text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        @error('password')
                            <p class="text text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-4 text-center">
                        <button class="btn btn-primary btn-login" type="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection