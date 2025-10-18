<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $relatedPosts = Post::where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->limit(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }
}
