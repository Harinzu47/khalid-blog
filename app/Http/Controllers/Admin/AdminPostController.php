<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPostController extends Controller
{
    /**
     * Tampilkan daftar postingan berdasarkan status.
     */
    public function index(Request $request)
    {
        // Mendapatkan status dari query string, default 'pending'
        $status = $request->query('status', 'pending');

        $query = Post::with('author', 'category');

        if ($status !== 'all') {
            // Tampilkan postingan yang belum memiliki status (null) atau status 'pending'
            if ($status === 'pending') {
                $query->where('status', 'pending')->orWhereNull('status');
            } else {
                $query->where('status', $status);
            }
        }

        $posts = $query->latest('created_at')->paginate(10);

        return view('admin.posts.index', compact('posts', 'status'));
    }

    /**
     * Tampilkan detail postingan.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update status postingan (persetujuan atau penolakan).
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'action' => ['required', 'in:approve,reject'],
        ]);

        if ($request->action === 'approve') {
            $post->status = 'approved';
            $message = 'Postingan berhasil disetujui.';
        } else { // 'reject'
            $post->status = 'rejected';
            $message = 'Postingan berhasil ditolak.';
        }

        $post->save();

        return redirect()->route('admin.posts.index', ['status' => $post->status])->with('success', $message);
    }

    /**
     * Hapus postingan.
     */
    public function destroy(Post $post)
    {
        // Tambahkan logika penghapusan file gambar jika diperlukan
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Postingan berhasil dihapus.');
    }
}
