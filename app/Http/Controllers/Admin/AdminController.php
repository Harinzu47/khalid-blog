<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin.
     */
    public function index()
    {
        // Statistik Ringkas
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $pendingPostsCount = Post::where('status', 'pending')->count();

        $recentPendingPosts = Post::where('status', 'pending')
            ->with(['author', 'category'])
            ->latest()
            ->take(5)
            ->get();

        $recentUsers = User::latest()->take(5)->get();
        $totalComments = Comment::count();

        return view('admin.index', [
            'totalUsers' => $totalUsers,
            'totalPosts' => $totalPosts,
            'pendingPostsCount' => $pendingPostsCount,
            'recentPendingPosts' => $recentPendingPosts,
            'recentUsers' => $recentUsers,
            'totalComments' => $totalComments
        ]);
    }
}
