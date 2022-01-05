@extends('layout.app')
@section('layout_title', 'Edit Artikel')
@section('layout_content')
<main class="mb-5 p-3 section-banner" style="height: 100%;">
    <div class="container p-0 col-lg-8">
        <section id="menu">
            <div class="container">
                <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row mt-3 justify-content-center">
                        <div class="col-12 col-lg-8">
                            <div class="form-group">
                                <label for="title">Judul Artikel</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                <p class="text text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="content">Isi Artikel</label>
                                <textarea type="text" name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows=4>{{ old('content', $post->content) }}</textarea>
                                @error('content')
                                <p class="text text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="tag">Tag</label>
                                <input type="text" name="tag" id="tag" value="{{ old('tag', $post->tag) }}" class="form-control @error('tag') is-invalid @enderror">
                                @error('tag')
                                <p class="text text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="thumbnail">Thumbnail Baru</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept=".png, .jpg, .jpeg">
                                @error('thumbnail')
                                <p class="text text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-4 text-center">
                                <button class="btn btn-success btn-lg" type="submit">Update Artikel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection