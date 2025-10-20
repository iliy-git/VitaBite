<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostBookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostBookmarkController extends Controller
{
    public function toggleBookmark(Post $post)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Необходимо авторизоваться'
            ], 401);
        }

        $existingBookmark = PostBookmark::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->first();

        if ($existingBookmark) {
            $existingBookmark->delete();
            $bookmarked = false;
            $message = 'Удалено из закладок';
        } else {
            PostBookmark::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id
            ]);
            $bookmarked = true;
            $message = 'Добавлено в закладки';
        }

        return response()->json([
            'success' => true,
            'bookmarked' => $bookmarked,
            'bookmarks_count' => $post->bookmarks()->count(),
            'message' => $message
        ]);
    }

    public function userBookmarks()
    {
        $bookmarkedPosts = Auth::user()->bookmarkedPosts()
            ->where('is_published', true)
            ->withCount('bookmarks')
            ->orderBy('post_bookmarks.created_at', 'desc')
            ->paginate(12);

        return view('posts.bookmarks', compact('bookmarkedPosts'));
    }
}
