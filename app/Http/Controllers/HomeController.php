<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $recipes = Recipe::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('welcome', compact('posts', 'recipes'));
    }
}
