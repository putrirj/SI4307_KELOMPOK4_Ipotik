@extends('layout.app')
@section('layout_title', 'Artikel')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="banner">
                <img class="img-banner" src="{{ asset('assets/images/banner.png') }}" alt="">
            </section>
            <section id="artikel" class="mt-5">
                <p class="h2">Artikel Terbaru</p>
                @if (Auth::check() && Auth::user()->role == "admin")
                    <a href="{{ route('post.create') }}" class="btn btn-primary bg-primary border-0">Tambah Artikel</a>
                @endif
                <div class="row mt-4">
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
                <div class="row mt-4">
                    {{ $posts->links() }}
                </div>
            </section>
        </div>
    </main>
@endsection