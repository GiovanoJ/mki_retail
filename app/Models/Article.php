<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'sinopsis',
        'content',
        'status',
        'deleted_status',
        'thumbnail',
    ];

    protected $casts = [
        'deleted_status' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->where('deleted_status', false);
    }

    public function scopeNotDeleted($query)
    {
        return $query->where('deleted_status', false);
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function thumbnailUrl(): ?string
    {
        return $this->thumbnail
            ? asset('storage/' . $this->thumbnail)
            : null;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Article $article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }
}
