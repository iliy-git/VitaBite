<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - VitaBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
@include('navbar')

<main class="flex-grow container mx-auto px-4 py-8">
    <article class="max-w-4xl mx-auto bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-8">
                <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full mb-4">
                    {{ $post->category }}
                </span>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
            <div class="text-gray-500 mb-6">{{ $post->created_at->format('d.m.Y') }}</div>

            <div class="text-gray-700 text-lg leading-relaxed">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </article>

    @if($relatedPosts->count() > 0)
        <section class="max-w-4xl mx-auto mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Похожие статьи</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($relatedPosts as $relatedPost)
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <h3 class="font-semibold text-gray-800 mb-2">{{ $relatedPost->title }}</h3>
                        <a href="{{ route('posts.show', $relatedPost->slug) }}" class="text-green-600 hover:text-green-800 text-sm">
                            Читать далее
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</main>

@include('partials.footer')

</body>
</html>
