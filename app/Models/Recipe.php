<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'ingredients',
        'instructions',
        'prep_time',
        'cook_time',
        'servings',
        'difficulty',
        'category',
        'image',
        'is_published'
    ];

    public function likes()
    {
        return $this->hasMany(LikeRecipe::class);
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'like_recipes', 'recipe_id', 'user_id')
            ->withTimestamps();
    }

    public function isLikedByUser($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }

        if (!$userId) {
            return false;
        }

        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
