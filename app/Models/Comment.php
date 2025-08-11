<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'content',
        'content_html',
        'status'
    ];

    // cast or dates if needed
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'edited_at' => 'datetime',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->where('status', 'published')->orderBy('created_at', 'asc');
    }

    // Mutator untuk otomatis mengisi content_html saat content diatur
    public function setContentAttribute(string $value): void
    {
        $this->attributes['content'] = $value;
        // Konversi markdown ke HTML, atau gunakan library markdown parser
        $this->attributes['content_html'] = Str::markdown($value);
    }
}
