<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminCommentController extends Controller
{
    /**
     * Tampilkan daftar komentar yang pending atau difilter.
     */
    public function index(Request $request): View
    {
        $status = $request->input('status', Comment::STATUS_PENDING);

        $comments = Comment::with(['post', 'user'])
            ->where('status', $status)
            ->latest()
            ->paginate(10);

        return view('admin.comments.index', compact('comments', 'status'));
    }

    /**
     * Ubah status komentar menjadi 'published'.
     */
    public function publish(Comment $comment): RedirectResponse
    {
        $comment->update(['status' => Comment::STATUS_PUBLISHED]);

        return back()->with('success', 'Komentar berhasil diterbitkan.');
    }

    /**
     * Ubah status komentar menjadi 'hidden'.
     */
    public function hide(Comment $comment): RedirectResponse
    {
        $comment->update(['status' => Comment::STATUS_HIDDEN]);

        return back()->with('success', 'Komentar berhasil disembunyikan.');
    }

    /**
     * Ubah status komentar menjadi 'deleted'.
     */
    public function delete(Comment $comment): RedirectResponse
    {
        $comment->update(['status' => Comment::STATUS_DELETED]);

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
