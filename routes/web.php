<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PostDashboardController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
})->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

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

Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class);
    Route::resource('posts', AdminPostController::class);
    Route::resource('categories', AdminCategoryController::class)->except('show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upload', [ProfileController::class, 'upload'])->name('profile.upload');
});

require __DIR__ . '/auth.php';
