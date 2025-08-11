<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\User;
use App\Mail\NewCommentMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendCommentEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $commentId;  // Simpan ID saja untuk menghindari serialization issues
    public int $recipientUserId;
    public bool $isReply;

    public $tries = 3;
    public $backoff = [10, 30, 60]; // Backoff delays in seconds

    public function __construct(Comment $comment, int $recipientUserId, bool $isReply = false)
    {
        $this->commentId = $comment->id;
        $this->recipientUserId = $recipientUserId;
        $this->isReply = $isReply;

        Log::info('SendCommentEmailJob queued', [
            'comment_id' => $this->commentId,
            'recipient_id' => $this->recipientUserId,
            'is_reply' => $this->isReply
        ]);
    }

    public function handle(): void
    {
        try {
            Log::info('Processing SendCommentEmailJob', [
                'comment_id' => $this->commentId,
                'recipient_id' => $this->recipientUserId
            ]);

            // Ambil fresh data dari database
            $comment = Comment::with(['user', 'post'])->find($this->commentId);

            if (!$comment) {
                Log::warning('Comment not found, skipping email', [
                    'comment_id' => $this->commentId
                ]);
                return;
            }

            $recipient = User::find($this->recipientUserId);

            if (!$recipient) {
                Log::warning('Recipient not found, skipping email', [
                    'recipient_id' => $this->recipientUserId
                ]);
                return;
            }

            // Check notification preferences
            if (method_exists($recipient, 'prefersCommentEmail') && !$recipient->prefersCommentEmail()) {
                Log::info('Recipient disabled comment email notifications', [
                    'recipient_id' => $this->recipientUserId
                ]);
                return;
            }

            // Send email
            Mail::to($recipient->email)->send(new NewCommentMail($comment, $recipient, $this->isReply));

            Log::info('Comment email sent successfully', [
                'comment_id' => $this->commentId,
                'recipient_email' => $recipient->email,
                'is_reply' => $this->isReply
            ]);
        } catch (\Exception $e) {
            Log::error('Error in SendCommentEmailJob', [
                'comment_id' => $this->commentId,
                'recipient_id' => $this->recipientUserId,
                'attempt' => $this->attempts(),
                'error' => $e->getMessage()
            ]);

            throw $e; // Re-throw for retry mechanism
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('SendCommentEmailJob failed permanently', [
            'comment_id' => $this->commentId,
            'recipient_id' => $this->recipientUserId,
            'is_reply' => $this->isReply,
            'attempts' => $this->attempts(),
            'error' => $exception->getMessage()
        ]);
    }
}
