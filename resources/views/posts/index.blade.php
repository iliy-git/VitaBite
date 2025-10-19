<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все статьи - VitaBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
@include('navbar')

<main class="flex-grow container mx-auto px-4 py-8">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Все статьи о здоровом питании</h1>
        <p class="text-xl text-gray-600">Полезные советы и рекомендации для вашего здоровья</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($posts as $post)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6">
                    <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full mb-3">
                        {{ $post->category }}
                    </span>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $post->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 120) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">{{ $post->created_at->format('d.m.Y') }}</span>
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-green-600 hover:text-green-800 font-medium">
                            Читать →
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $posts->links() }}
</main>

@include('partials.footer')

</body>
</html>
