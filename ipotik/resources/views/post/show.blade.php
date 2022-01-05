@extends('layout.app')
@section('layout_title', $post->title)
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="banner">
                <img class="img-post" src="{{ asset('storage/'.$post->thumbnail) }}" alt="">
            </section>
            <section id="artikel" class="mt-5">
                <p class="h2">{{ $post->title }}</p>
                @if (Auth::check() && Auth::user()->role == "admin")
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning">Edit Artikel</a>
                    <form action="{{ route('post.destroy', $post->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Hapus Artikel</button>
                    </form>
                @endif
                <div class="row mt-4">
                    <div class="col-12 mb-3 post-content">
                        {!! $post->content !!}
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection