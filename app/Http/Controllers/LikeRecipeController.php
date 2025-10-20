<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\LikeRecipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeRecipeController extends Controller
{
    public function toggleLike(Recipe $recipe)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Необходимо авторизоваться'
            ], 401);
        }

        $existingLike = LikeRecipe::where('user_id', Auth::id())
            ->where('recipe_id', $recipe->id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
            $message = 'Лайк удален';
        } else {
            LikeRecipe::create([
                'user_id' => Auth::id(),
                'recipe_id' => $recipe->id
            ]);
            $liked = true;
            $message = 'Рецепт понравился';
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $recipe->likes()->count(),
            'message' => $message
        ]);
    }
    public function userLikes()
    {
        $likedRecipes = Auth::user()->likedRecipes()
            ->where('is_published', true)
            ->withCount('likes')
            ->orderBy('like_recipes.created_at', 'desc')
            ->paginate(12);

        return view('recipes.likes', compact('likedRecipes'));
    }
}
