<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostDashboardController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $posts = Post::latest()->where('author_id', Auth::user()->id);
        if (request('keyword')) {
            $posts->where('title', 'like', '%' . request('keyword') . '%');
        }
        return view('dashboard.index', ['posts' => $posts->paginate(7)->withQueryString()]);
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(PostStoreRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('img', 'public');
        }

        $validatedData['slug'] = Str::slug($request->title);
        $validatedData['author_id'] = Auth::user()->id;

        Post::create($validatedData);

        return redirect('/dashboard')->with('success', 'Postingan baru berhasil ditambahkan!');
    }

    public function show(Post $post)
    {
        return view('dashboard.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('dashboard.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $validatedData = $request->validated();

        if ($request->file('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('img', 'public');
        }

        $validatedData['slug'] = Str::slug($request->title);
        $validatedData['author_id'] = Auth::user()->id;

        $post->update($validatedData);

        return redirect('/dashboard')->with('success', 'Postingan berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->image) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect('/dashboard')->with(['success' => 'Post deleted successfully!']);
    }
}
