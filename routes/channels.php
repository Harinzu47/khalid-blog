<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Post;


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Fix: Update channel name to match the one used in frontend
Broadcast::channel('posts.{postId}', function ($user, Post $postId) {
    // Allow authenticated users to listen
    return !is_null($user);
});
