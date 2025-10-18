<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::latest()->paginate(10);
        return view('admin.recipes.index', compact('recipes'));
    }

    public function create()
    {
        $categories = ['завтрак', 'обед', 'ужин', 'перекус', 'десерт', 'напиток'];
        $difficulties = ['легко', 'средне', 'сложно'];
        return view('admin.recipes.create', compact('categories', 'difficulties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'required|integer|min:1',
            'cook_time' => 'required|integer|min:0',
            'servings' => 'required|integer|min:1',
            'difficulty' => 'required|string',
            'category' => 'required|string',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');

        Recipe::create($validated);

        return redirect()->route('admin.recipes.index')->with('success', 'Рецепт успешно создан!');
    }

    public function show(Recipe $recipe)
    {
        return view('admin.recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        $categories = ['завтрак', 'обед', 'ужин', 'перекус', 'десерт', 'напиток'];
        $difficulties = ['легко', 'средне', 'сложно'];
        return view('admin.recipes.edit', compact('recipe', 'categories', 'difficulties'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'required|integer|min:1',
            'cook_time' => 'required|integer|min:0',
            'servings' => 'required|integer|min:1',
            'difficulty' => 'required|string',
            'category' => 'required|string',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published');

        $recipe->update($validated);

        return redirect()->route('admin.recipes.index')->with('success', 'Рецепт успешно обновлен!');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('admin.recipes.index')->with('success', 'Рецепт успешно удален!');
    }
}
