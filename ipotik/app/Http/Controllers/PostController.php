<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'tag' => 'required|string',
            'thumbnail' => 'required|file|image||mimes:jpg,png,jpeg'
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->tag = $validated['tag'];
        $post->thumbnail = $validated['thumbnail']->store('posts', 'public');

        if ($post->save()) {
            return redirect()->route('post.index')
                ->with('alert_type', 'success')
                ->with('alert_message', 'Artikel berhasil dibuat.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Artikel gagal dibuat.');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'tag' => 'required|string',
            'thumbnail' => 'file|image||mimes:jpg,png,jpeg'
        ]);

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->tag = $validated['tag'];

        if ($request->has('thumbnail') && $validated['thumbnail'] != null) {
            if (Storage::disk('public')->exists($post->thumbnail)) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $post->thumbnail = $validated['thumbnail']->store('posts', 'public');
        }

        if ($post->save()) {
            return redirect()->route('post.show', $post->id)
                ->with('alert_type', 'success')
                ->with('alert_message', 'Artikel berhasil diupdate.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Artikel gagal diupdate.');
    }

    public function destroy(Post $post)
    {
        if (Storage::disk('public')->exists($post->thumbnail)) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        if ($post->delete()) {
            return redirect()->route('post.index')
                ->with('alert_type', 'success')
                ->with('alert_message', 'Artikel berhasil dihapus.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Artikel gagal dihapus.');
    }
}
