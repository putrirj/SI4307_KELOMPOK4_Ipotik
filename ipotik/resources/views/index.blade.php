@extends('layout.app')
@section('layout_title', 'Beranda')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="banner">
                <img class="img-banner" src="{{ asset('assets/images/banner.png') }}" alt="">
            </section>
            <section id="menu">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        @if (Auth::check() && Auth::user()->role == 'admin')
                            <div class="col-6 mb-3 d-flex justify-content-end">
                                <div class="card" style="width: 18rem;">
                                    <a href="{{ route('post.create') }}" class="href">
                                        <img src="{{ asset('assets/images/buat_artikel.png') }}" class="card-img-top card-menu" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 mb-3 d-flex justify-content-start">
                                <div class="card" style="width: 18rem;">
                                    <a href="{{ route('medicine.index') }}" class="href">
                                        <img src="{{ asset('assets/images/obat.png') }}" class="card-img-top card-menu" />
                                    </a>
                                </div>
                            </div>
                        @elseif (Auth::check() && Auth::user()->role == 'apoteker')

                        @else
                            <div class="col-6 mb-3 d-flex justify-content-end">
                                <div class="card" style="width: 18rem;">
                                    <a href="{{ route('medicine.index') }}" class="href">
                                        <img src="{{ asset('assets/images/beli_obat.png') }}" class="card-img-top card-menu" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-6 mb-3 d-flex justify-content-start">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ asset('assets/images/input_resep.png') }}" class="card-img-top card-menu" />
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            <section id="artikel">
                <p class="h2">Artikel Terbaru</p>
                <div class="row">
                    @forelse ($posts as $post)
                        <div class="col-12 col-lg-4 mb-3">
                            <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none post-link text-dark">
                                <div class="card card-artikel">
                                    <img src="{{ asset('storage/'.$post->thumbnail) }}" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-tag">
                                            <div class="badge">{{ $post->tag }}</div>
                                        </h5>
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text post-short">{{ $post->content }}.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12"><p class="h6 badge bg-warning text-dark">Belum Ada Artikel</p></div>
                    @endforelse
                </div>
            </section>
        </div>
    </main>
@endsection