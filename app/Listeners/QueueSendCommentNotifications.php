<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Jobs\SendCommentEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;

class QueueSendCommentNotifications implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(CommentCreated $event): void
    {
        try {
            Log::info('Processing comment notifications', [
                'comment_id' => $event->commentId
            ]);

            // Ambil comment dengan semua relasi yang dibutuhkan
            $comment = Comment::with(['post.author', 'parent.user', 'user'])
                ->find($event->commentId);

            if (!$comment) {
                Log::warning('Comment tidak ditemukan untuk notification', [
                    'comment_id' => $event->commentId
                ]);
                return;
            }

            // Validasi post dan author
            if (!$comment->post) {
                Log::warning('Post tidak ditemukan untuk comment', [
                    'comment_id' => $comment->id
                ]);
                return;
            }

            $postAuthor = $comment->post->author;

            Log::info('Comment notification data loaded', [
                'comment_id' => $comment->id,
                'comment_user_id' => $comment->user_id,
                'post_author_id' => $postAuthor->id ?? 'NULL',
                'has_parent' => $comment->parent_id ? 'yes' : 'no'
            ]);

            // 1. Notifikasi ke penulis postingan (jika bukan komentator sendiri)
            if ($postAuthor && $postAuthor->id !== $comment->user_id) {
                Log::info('✅ Queueing notification to post author', [
                    'comment_id' => $comment->id,
                    'post_author_id' => $postAuthor->id,
                    'post_author_email' => $postAuthor->email
                ]);

                // PERBAIKAN: Kirim user ID, bukan User object
                SendCommentEmailJob::dispatch($comment, $postAuthor->id, false);
            } else {
                Log::info('❌ Skipping post author notification', [
                    'reason' => !$postAuthor ? 'no_post_author' : 'same_user',
                    'comment_user_id' => $comment->user_id,
                    'post_author_id' => $postAuthor->id ?? 'NULL'
                ]);
            }

            // 2. Notifikasi balasan (jika ini adalah reply)
            if ($comment->parent_id) {
                $parentComment = $comment->parent;

                if (
                    $parentComment &&
                    $parentComment->user &&
                    $parentComment->user->id !== $comment->user_id &&
                    $parentComment->user->id !== ($postAuthor->id ?? null)
                ) {

                    Log::info('✅ Queueing notification to parent commenter', [
                        'comment_id' => $comment->id,
                        'parent_user_id' => $parentComment->user->id,
                        'parent_user_email' => $parentComment->user->email
                    ]);

                    // PERBAIKAN: Kirim user ID, bukan User object
                    SendCommentEmailJob::dispatch($comment, $parentComment->user->id, true);
                } else {
                    $reason = !$parentComment ? 'no_parent_comment' : (!$parentComment->user ? 'no_parent_user' : ($parentComment->user->id === $comment->user_id ? 'same_user' : 'duplicate_with_post_author'));

                    Log::info('❌ Skipping parent comment notification', [
                        'reason' => $reason
                    ]);
                }
            }

            Log::info('Comment notifications processing completed', [
                'comment_id' => $comment->id
            ]);
        } catch (\Exception $e) {
            Log::error('Error in QueueSendCommentNotifications', [
                'comment_id' => $event->commentId ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }

    public function failed(CommentCreated $event, \Throwable $exception): void
    {
        Log::error('QueueSendCommentNotifications failed permanently', [
            'comment_id' => $event->commentId ?? 'unknown',
            'error' => $exception->getMessage(),
            'attempts' => $this->attempts() ?? 'unknown'
        ]);
    }
}
