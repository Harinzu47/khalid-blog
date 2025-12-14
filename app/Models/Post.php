<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    // Jika suatu saat Anda ingin mengubah nama status, Anda hanya perlu mengubahnya di sini.
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    protected $guarded = ['id'];
    protected $with = ['category', 'author', 'comments'];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the category that owns the Post.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the author that owns the Post.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->where('status', self::STATUS_APPROVED);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    /**
     * Filter posts based on given criteria.
     */
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(isset($filters['search']), function ($query) use ($filters) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        });

        $query->when(isset($filters['category']), function ($query) use ($filters) {
            $query->whereHas('category', fn($query) => $query->where('slug', $filters['category']));
        });

        $query->when(isset($filters['author']), function ($query) use ($filters) {
            $query->whereHas('author', fn($query) => $query->where('username', $filters['author']));
        });
    }
}
