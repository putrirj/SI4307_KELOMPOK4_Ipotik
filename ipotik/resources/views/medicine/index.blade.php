@extends('layout.app')
@section('layout_title', 'Obat')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="banner">
                <img class="img-banner" src="{{ asset('assets/images/banner.png') }}" alt="">
            </section>
            <section id="menu">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <p class="h4 text-center mt-3 mb-3">Obat  & Vitamin Berdasarkan Kategori</p>
                        @foreach ($categories as $category)
                            <div class="col-12 col-md-4 col-lg-3 mb-3 d-flex justify-content-center">
                                <div class="card" style="width: 18rem;">
                                    <a href="{{ route('medicine.category', $category->id) }}">
                                        <img src="{{ asset('storage/'.$category->photo) }}" class="card-img-top card-menu" />
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection