<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Закладки статей - VitaBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
@include('navbar')

<main class="flex-grow container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Статьи в закладках</h1>
            <p class="text-xl text-gray-600">Статьи, которые вы сохранили для чтения</p>
        </div>

        @if($bookmarkedPosts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($bookmarkedPosts as $post)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6">
                            <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full mb-3">
                                {{ $post->category }}
                            </span>
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $post->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 120) }}</p>

                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-2 text-gray-500">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                    </svg>
                                    <span class="text-sm">{{ $post->bookmarks_count }}</span>
                                </div>
                                <span class="text-sm text-gray-500">{{ $post->created_at->format('d.m.Y') }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-green-600 hover:text-green-800 font-medium">
                                    Читать →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $bookmarkedPosts->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Нет статей в закладках</h3>
                <p class="text-gray-500 mb-4">Добавляйте статьи в закладки, чтобы вернуться к ним позже</p>
                <a href="{{ route('posts.index') }}" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    Найти статьи
                </a>
            </div>
        @endif
    </div>
</main>

@include('partials.footer')
</body>
</html>
