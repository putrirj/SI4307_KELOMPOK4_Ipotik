@extends('layout.auth')
@section('layout_title', 'Login')
@section('layout_content')
<div class="card shadow">
    <div class="card-body">
        <p class="card-title">Welcome</p>
        <ul class="nav nav-pills mb-3  justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item nav-login-card" role="presentation">
                <a href="{{ route('login') }}" class="nav-link active bg-white" type="button">Sign In</a>
            </li>
            <li class="nav-item nav-login-card" role="presentation">
                <a href="{{ route('register') }}" class="nav-link bg-white" type="button">Sign Up</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active ps-5 pe-5" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <form action="{{ route('auth') }}" method="post">
                    @csrf
                    @if (session('alert_type'))
                        <div class="alert alert-{{ session('alert_type') }}">
                            {{ session('alert_message') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <p class="text text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        @error('password')
                            <p class="text text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
                        <label class="form-check-label text-grey" for="flexCheckDefault">
                            Remember Me
                        </label>
                    </div>
                    <div class="form-group mt-4 text-center">
                        <button class="btn btn-primary btn-login" type="submit">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection