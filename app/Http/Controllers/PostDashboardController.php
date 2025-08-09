<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->where('author_id', Auth::user()->id);
        if (request('keyword')) {
            $posts->where('title', 'like', '%' . request('keyword') . '%');
        }
        return view('dashboard.index', ['posts' => $posts->paginate(7)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:posts|min:4|max:255',
                'category_id' => 'required',
                'body' => 'required|min:50',
                'image' => 'image|file|max:2048',
            ],
            [
                'title.required' => 'Field :attribute harus diisi!',
                'category_id.required' => 'Pilih salah satu kategori!',
                'body.min' => ':attribute minimal 50 karakter',
                'image.image' => 'File harus berupa gambar',

            ],
            [
                'title' => 'Judul',
                'category_id' => 'Kategori',
                'body' => 'Isi Konten',
                'image' => 'Gambar',
            ]
        )->validate();

        Post::create([
            'title' => $request->title,
            'slug' => str()->slug($request->title),
            'body' => $request->body,
            'image' => $request->file('image') ? $request->file('image')->store('img', 'public') : null,
            'category_id' => $request->category_id,
            'author_id' => Auth::user()->id,
        ]);

        return redirect('/dashboard')->with(['success' => 'Post created successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //buat toast kalau gagal atau bukan user nya

        if ($post->author_id !== Auth::user()->id) {
            return redirect('/dashboard')->with(['error' => 'You are not authorized to edit this post!']);
        }
        $request->validate([
            'title' => 'required|min:4|max:255|unique:posts,title,' . $post->id,
            'category_id' => 'required',
            'body' => 'required',
            'image' => 'image|file|max:2048',
        ]);

        $post->update([
            'title' => $request->title,
            'slug' => str()->slug($request->title),
            'body' => $request->body,
            'image' => $request->file('image') ? $request->file('image')->store('img', 'public') : $post->image,
            'category_id' => $request->category_id,
            'author_id' => Auth::user()->id,
        ]);

        return redirect('/dashboard')->with(['success' => 'Post updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //buat toast dihalaman blade nya
        if ($post->author_id !== Auth::user()->id) {
            return redirect('/dashboard')->with(['error' => 'You are not authorized to delete this post!']);
        }

        if ($post->image) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect('/dashboard')->with(['success' => 'Post deleted successfully!']);
    }
}
