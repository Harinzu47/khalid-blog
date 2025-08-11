<?php

namespace App\Http\Controllers;

use App\Events\CommentCreated;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    /**
     * The middleware to be applied to the controller's methods.
     *
     * @var array
     */
    protected $middleware = [
        'auth' => ['only' => ['store', 'destroy', 'update']],
    ];

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:5000'],
            'parent_id' => ['nullable', Rule::exists('comments', 'id')->where(function ($q) use ($post) {
                $q->where('post_id', $post->id);
            })],
        ]);

        $comment = null;

        DB::transaction(function () use (&$comment, $post, $request) {
            $comment = Comment::create([
                'post_id' => $post->id,
                'user_id' => auth()->id(),
                'parent_id' => $request->input('parent_id'),
                'content' => $request->input('content'), // Mutator di model akan mengisi content_html
            ]);

            $post->increment('comments_count');

            if ($comment->parent_id) {
                Comment::where('id', $comment->parent_id)->increment('replies_count');
            }
        });

        // Fire event (which will broadcast & queue notifications)
        \Illuminate\Support\Facades\Log::info('Event CommentCreated is about to be fired.');

        event(new CommentCreated($comment));

        // Mengembalikan JSON jika diminta
        if ($request->wantsJson()) {
            return response()->json(['comment' => $comment->fresh('user')], 201);
        }

        return redirect()->back()->with('success', 'Komentar terkirim.');
    }

    // public function index(Post $post)
    // {
    //     $comments = Comment::with('user')
    //         ->where('post_id', $post->id)
    //         ->whereNull('parent_id')
    //         ->where('status', 'published')
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(20);

    //     return view('posts.comments.index', compact('post', 'comments'));
    // }
}
