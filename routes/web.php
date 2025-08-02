<?php

use App\Http\Controllers\PostDashboardController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/posts', function () {
    // $posts = Post::with(['author', 'category'])->latest()->get();
    $posts = Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString();
    return view('posts', ['title' => 'Blog', 'posts' => $posts]);
});

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About Us']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact Us']);
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PostDashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/dashboard', [PostDashboardController::class, 'store'])
        ->name('dashboard.post.store');

    Route::get('/dashboard/create', [PostDashboardController::class, 'create'])
        ->name('dashboard.post.create');

    Route::get('/dashboard/{post:slug}/edit', [PostDashboardController::class, 'edit'])
        ->name('dashboard.post.edit');

    Route::patch('/dashboard/{post:slug}', [PostDashboardController::class, 'update'])
        ->name('dashboard.post.update');

    Route::delete('/dashboard/{post:slug}', [PostDashboardController::class, 'destroy'])
        ->name('dashboard.post.destroy');

    Route::get('/dashboard/{post:slug}', [PostDashboardController::class, 'show'])
        ->name('dashboard.post.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload', [ProfileController::class, 'upload'])->name('profile.upload');
});

require __DIR__ . '/auth.php';
