<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Menampilkan daftar semua postingan yang disetujui.
     */
    public function index()
    {
        $posts = Post::latest()
            ->where('status', 'approved') // Hanya ambil postingan dengan status 'approved'
            ->filter(request(['search', 'category', 'author']))
            ->paginate(6)
            ->withQueryString();

        return view('posts', [
            'title' => 'Blog',
            'posts' => $posts
        ]);
    }

    /**
     * Menampilkan postingan tunggal berdasarkan slug dan status 'approved'.
     */
    public function show(Post $post)
    {
        // Jika status postingan bukan 'approved', kembalikan 404
        if ($post->status !== 'approved') {
            abort(404);
        }

        // Mengambil 5 postingan terbaru, kecuali postingan yang sedang ditampilkan,
        // dan hanya yang memiliki status 'approved'
        $recentPosts = Post::where('id', '!=', $post->id)
            ->where('status', 'approved')
            ->latest()
            ->take(5)
            ->get();

        // Mengambil semua kategori beserta jumlah postingan yang 'approved' di setiap kategori
        $categories = Category::withCount(['posts' => function ($query) {
            $query->where('status', 'approved');
        }])->get();

        $comments = Comment::with('user', 'replies.user')
            ->where('post_id', $post->id)
            ->whereNull('parent_id')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('post', [
            'title' => $post->title,
            'post' => $post,
            'recentPosts' => $recentPosts,
            'categories' => $categories,
            'comments' => $comments,
        ]);
    }
}
