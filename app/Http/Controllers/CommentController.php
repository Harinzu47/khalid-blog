<?php

namespace App\Http\Controllers;

use App\Events\CommentCreated;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    protected $middleware = [
        'auth' => ['only' => ['store', 'destroy', 'update']],
    ];

    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(CommentStoreRequest $request, Post $post)
    {
        $comment = $this->commentService->createComment($post, $request->validated());

        Log::info('Event CommentCreated is about to be fired.');

        event(new CommentCreated($comment));

        if ($request->wantsJson()) {
            return response()->json(['comment' => $comment->fresh('user')], 201);
        }

        return redirect()->back()->with('success', 'Komentar terkirim.');
    }
}
