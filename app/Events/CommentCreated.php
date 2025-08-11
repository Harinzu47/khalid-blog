<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CommentCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public int $commentId;
    public int $postId; // Simpan post_id untuk menghindari query di broadcastOn

    public function __construct(Comment $comment)
    {
        // Simpan ID dan post_id untuk menghindari masalah serialisasi
        $this->commentId = $comment->id;
        $this->postId = $comment->post_id;

        Log::info('CommentCreated event initialized', [
            'comment_id' => $this->commentId,
            'post_id' => $this->postId
        ]);
    }

    public function broadcastOn()
    {
        // Gunakan post_id yang sudah disimpan, tidak perlu query DB
        return new PrivateChannel('post.' . $this->postId);
    }

    public function broadcastWith()
    {
        try {
            // Load data yang dibutuhkan untuk broadcast
            $comment = Comment::with('user:id,name')->find($this->commentId);

            if (!$comment) {
                Log::error('Comment not found for broadcasting', ['comment_id' => $this->commentId]);
                return [];
            }

            $broadcastData = [
                'id' => $comment->id,
                'post_id' => $comment->post_id,
                'parent_id' => $comment->parent_id,
                'content_html' => $comment->content_html,
                'user' => [
                    'id' => $comment->user?->id ?? $comment->user_id,
                    'name' => $comment->user?->name ?? 'Unknown User',
                ],
                'created_at' => $comment->created_at->toDateTimeString(),
            ];

            Log::info('CommentCreated broadcast data prepared', [
                'comment_id' => $comment->id,
                'has_user' => $comment->user ? 'yes' : 'no'
            ]);

            return $broadcastData;
        } catch (\Exception $e) {
            Log::error('Error preparing broadcast data for CommentCreated', [
                'comment_id' => $this->commentId,
                'error' => $e->getMessage()
            ]);

            // Return minimal data jika error
            return [
                'id' => $this->commentId,
                'post_id' => $this->postId,
                'error' => 'Failed to load comment data'
            ];
        }
    }

    public function broadcastAs()
    {
        return 'CommentCreated';
    }

    // Method untuk memastikan broadcasting hanya dilakukan jika data valid
    public function broadcastWhen()
    {
        $comment = Comment::find($this->commentId);
        return $comment !== null;
    }
}
