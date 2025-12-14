<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class CommentService
{
    public function createComment(Post $post, array $data): Comment
    {
        $comment = null;

        DB::transaction(function () use (&$comment, $post, $data) {
            $comment = $post->comments()->create([
                'user_id' => auth()->id(),
                'parent_id' => $data['parent_id'] ?? null,
                'content' => $data['content'],
            ]);

            // Gunakan relasi untuk menginkremen jumlah
            $post->increment('comments_count');

            if ($comment->parent_id) {
                Comment::where('id', $comment->parent_id)->increment('replies_count');
            }
        });

        return $comment;
    }
}
