<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::without('comments')
            ->latest()
            ->where('status', 'approved')
            ->filter(request(['search', 'category', 'author']))
            ->paginate(9)
            ->withQueryString();

        return view('posts', [
            'title' => 'Blog',
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        if ($post->status !== 'approved') {
            abort(404);
        }

        $recentPosts = Post::where('id', '!=', $post->id)
            ->approved()
            ->latest()
            ->take(5)
            ->get();

        $categories = Category::withCount(['posts' => function ($query) {
            $query->approved();
        }])->get();

        $comments = Comment::with('user', 'replies.user', 'replies.replies.user')
            ->where('post_id', $post->id)
            ->whereNull('parent_id')
            ->published()
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
