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

        // Dummy Activities Data (Replace with real activity logging if available, or construct from recent events)
        $recentActivities = collect([]);
        
        // Add recent posts to activities
        foreach($recentPendingPosts as $post) {
            $recentActivities->push([
                'description' => "User {$post->author->name} membuat tulisan baru: \"{$post->title}\"",
                'time' => $post->created_at->diffForHumans(),
                'timestamp' => $post->created_at
            ]);
        }

        // Add recent users to activities
        foreach($recentUsers as $user) {
            $recentActivities->push([
                'description' => "User baru terdaftar: {$user->name}",
                'time' => $user->created_at->diffForHumans(),
                'timestamp' => $user->created_at
            ]);
        }
        
        // Sort by timestamp desc and take 5
        $recentActivities = $recentActivities->sortByDesc('timestamp')->take(5);

        return view('admin.index', [
            'totalUsers' => $totalUsers,
            'totalPosts' => $totalPosts,
            'pendingPostsCount' => $pendingPostsCount,
            'recentPendingPosts' => $recentPendingPosts,
            'recentUsers' => $recentUsers,
            'totalComments' => $totalComments,
            'recentActivities' => $recentActivities
        ]);
    }
}
