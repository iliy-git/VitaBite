<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - VitaBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
@include('navbar')

<main class="flex-grow container mx-auto px-4 py-8">
    <article class="max-w-4xl mx-auto bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-8">
            <div class="flex justify-between items-start mb-6">
                <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">
                    {{ $post->category }}
                </span>

                @auth
                    <button id="bookmarkButton"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg transition-colors duration-200 {{ $isBookmarked ? 'bg-yellow-50 text-yellow-600 border border-yellow-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                            data-post-id="{{ $post->id }}">
                        <svg class="w-5 h-5" fill="{{ $isBookmarked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        <span id="bookmarksCount" class="font-medium">{{ $post->bookmarks_count }}</span>
                    </button>
                @else
                    <div class="flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        <span class="font-medium">{{ $post->bookmarks_count }}</span>
                    </div>
                @endauth
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
            <div class="text-gray-500 mb-6">{{ $post->created_at->format('d.m.Y') }}</div>

            <div class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">
                {{ $post->content }}
            </div>
        </div>
    </article>
</main>

@include('partials.footer')

@auth
    <script>
        document.getElementById('bookmarkButton').addEventListener('click', function() {
            const postId = this.dataset.postId;
            const button = this;
            const bookmarksCount = document.getElementById('bookmarksCount');

            fetch(`/posts/${postId}/bookmark`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.bookmarked) {
                        button.classList.remove('bg-gray-100', 'text-gray-600', 'hover:bg-gray-200');
                        button.classList.add('bg-yellow-50', 'text-yellow-600', 'border', 'border-yellow-200');
                        button.querySelector('svg').style.fill = 'currentColor';
                    } else {
                        button.classList.remove('bg-yellow-50', 'text-yellow-600', 'border', 'border-yellow-200');
                        button.classList.add('bg-gray-100', 'text-gray-600', 'hover:bg-gray-200');
                        button.querySelector('svg').style.fill = 'none';
                    }
                    bookmarksCount.textContent = data.bookmarks_count;
                });
        });
    </script>
@endauth

</body>
</html>
