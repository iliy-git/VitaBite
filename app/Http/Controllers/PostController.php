<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)
            ->withCount('bookmarks')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->withCount('bookmarks')
            ->firstOrFail();

        $isBookmarked = auth()->check() ? $post->isBookmarkedByUser(auth()->id()) : false;

        return view('posts.show', compact('post', 'isBookmarked'));
    }
}
