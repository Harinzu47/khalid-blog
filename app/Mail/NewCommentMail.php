<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public Comment $comment;
    public User $recipient;
    public bool $isReply;

    public function __construct(Comment $comment, User $recipient, bool $isReply = false)
    {
        $this->comment = $comment;
        $this->recipient = $recipient;
        $this->isReply = $isReply;
    }

    public function build()
    {
        $subject = $this->isReply ? 'Balasan pada komentar Anda' : 'Komentar baru pada tulisan Anda';
        return $this->subject($subject)
            ->view('emails.comments.new')
            ->with([
                'comment' => $this->comment,
                'recipient' => $this->recipient,
                'isReply' => $this->isReply,
            ]);
    }
}
