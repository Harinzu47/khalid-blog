<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

test('comment content is sanitized from xss', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['status' => 'approved']);

    $xssContent = 'Hello <script>alert("XSS")</script> World';

    // Login and post a comment
    $this->actingAs($user)
        ->post(route('comments.store', $post->id), [
            'content' => $xssContent,
        ]);

    $comment = Comment::where('post_id', $post->id)->first();

    // Should NOT contain the script tag in the HTML output
    // We expect it to be escaped like &lt;script&gt; or stripped completely
    expect($comment->content_html)->not->toContain('<script>');
    expect($comment->content_html)->not->toContain('alert("XSS")');
});

test('comments are rate limited', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['status' => 'approved']);

    // Login
    $this->actingAs($user);

    // Post 6 comments (limit is 6 per minute)
    for ($i = 0; $i < 6; $i++) {
        $response = $this->post(route('comments.store', $post->id), [
            'content' => "Comment $i",
        ]);
        // Expect success (redirect or 201)
        // If validation fails it might be 302 back with errors, but not 429
        $response->assertStatus(302); 
    }

    // Post 7th comment
    $response = $this->post(route('comments.store', $post->id), [
        'content' => "Comment Delta",
    ]);

    // Expect 429 Too Many Requests
    $response->assertStatus(429);
});
