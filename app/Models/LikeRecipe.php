<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeRecipe extends Model
{
    use HasFactory;

    protected $table = 'like_recipes';

    protected $fillable = [
        'user_id',
        'recipe_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
