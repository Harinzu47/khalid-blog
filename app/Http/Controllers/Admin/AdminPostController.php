<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPostController extends Controller
{
    /**
     * Tampilkan daftar postingan berdasarkan status.
     */
    public function index(Request $request)
    {
        // Mengambil nilai 'status' dari URL. Jika tidak ada, gunakan default 'pending'.
        // Ini menghilangkan hardcoding dan membuat endpoint lebih fleksibel.
        $status = $request->query('status', Post::STATUS_PENDING);

        // Ambil postingan berdasarkan status yang diminta
        $posts = Post::where('status', $status)->latest()->paginate(10);

        // Mengembalikan tampilan dengan data postingan yang sudah difilter dan dipaginasi
        return view('admin.posts.index', [
            'posts' => $posts,
            'users' => User::all(),
        ]);
    }

    /**
     * Tampilkan detail postingan.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function approve(Post $post)
    {
        // Menggunakan konstanta untuk status yang disetujui.
        $post->update(['status' => Post::STATUS_APPROVED]);
        return back()->with('success', 'Postingan berhasil disetujui');
    }

    public function reject(Post $post)
    {
        // Menggunakan konstanta untuk status yang ditolak.
        $post->update(['status' => Post::STATUS_REJECTED]);
        return back()->with('success', 'Postingan berhasil ditolak');
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
