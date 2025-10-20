<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::where('is_published', true)
            ->withCount('likes');

        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        if ($request->has('difficulty') && $request->difficulty) {
            $query->where('difficulty', $request->difficulty);
        }

        if ($request->has('max_time') && $request->max_time) {
            $maxTime = (int)$request->max_time;
            $query->whereRaw('(prep_time + cook_time) <= ?', [$maxTime]);
        }

        if ($request->has('servings') && $request->servings) {
            $query->where('servings', $request->servings);
        }

        $recipes = $query->orderBy('created_at', 'desc')->paginate(9);

        $categories = Recipe::where('is_published', true)
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort();

        $difficulties = Recipe::where('is_published', true)
            ->distinct()
            ->pluck('difficulty')
            ->filter()
            ->sort();

        $servingsOptions = Recipe::where('is_published', true)
            ->distinct()
            ->pluck('servings')
            ->filter()
            ->sort();

        return view('recipes.index', compact(
            'recipes',
            'categories',
            'difficulties',
            'servingsOptions'
        ));
    }

    public function show($slug)
    {
        $recipe = Recipe::where('slug', $slug)
            ->where('is_published', true)
            ->withCount('likes')
            ->firstOrFail();

        $isLiked = auth()->check() ? $recipe->isLikedByUser(auth()->id()) : false;

        $relatedRecipes = Recipe::where('category', $recipe->category)
            ->where('id', '!=', $recipe->id)
            ->where('is_published', true)
            ->withCount('likes')
            ->limit(3)
            ->get();

        return view('recipes.show', compact('recipe', 'relatedRecipes', 'isLiked'));
    }
}
