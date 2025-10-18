<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('recipes.index', compact('recipes'));
    }

    public function show($slug)
    {
        $recipe = Recipe::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $relatedRecipes = Recipe::where('category', $recipe->category)
            ->where('id', '!=', $recipe->id)
            ->where('is_published', true)
            ->limit(3)
            ->get();

        return view('recipes.show', compact('recipe', 'relatedRecipes'));
    }
}
