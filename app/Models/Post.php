<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'category',
        'is_published'
    ];
    public function bookmarks()
    {
        return $this->hasMany(PostBookmark::class);
    }

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'post_bookmarks', 'post_id', 'user_id')
            ->withTimestamps();
    }

    public function isBookmarkedByUser($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }

        if (!$userId) {
            return false;
        }

        return $this->bookmarks()->where('user_id', $userId)->exists();
    }

    public function getBookmarksCountAttribute()
    {
        return $this->bookmarks()->count();
    }
}
