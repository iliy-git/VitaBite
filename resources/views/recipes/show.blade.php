<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }} - VitaBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
@include('navbar')

<main class="flex-grow container mx-auto px-4 py-8">
    <article class="max-w-4xl mx-auto bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-8">
            <div class="flex justify-between items-start mb-6">
                <div class="flex gap-2">
                    <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                        {{ $recipe->category }}
                    </span>
                    <span class="bg-orange-100 text-orange-800 text-sm px-3 py-1 rounded-full">
                        {{ $recipe->difficulty }}
                    </span>
                </div>

                <!-- Блок с лайками -->
                @auth
                    <button id="likeButton"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg transition-colors duration-200 {{ $isLiked ? 'bg-red-50 text-red-600 border border-red-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                            data-recipe-id="{{ $recipe->id }}">
                        <svg class="w-5 h-5" fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span id="likesCount" class="font-medium">{{ $recipe->likes_count }}</span>
                    </button>
                @else
                    <div class="flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-600 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span class="font-medium">{{ $recipe->likes_count }}</span>
                    </div>
                @endauth
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $recipe->title }}</h1>
            <p class="text-lg text-gray-600 mb-6">{{ $recipe->description }}</p>

            <div class="flex gap-6 text-sm text-gray-500 mb-8">
                <span>Подготовка: {{ $recipe->prep_time }} мин</span>
                <span>Приготовление: {{ $recipe->cook_time }} мин</span>
                <span>{{ $recipe->servings }} порции</span>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Ингредиенты</h2>
                    <div class="bg-gray-50 rounded-lg p-4 whitespace-pre-line">
                        {{ $recipe->ingredients }}
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Инструкция</h2>
                    <div class="whitespace-pre-line">
                        {{ $recipe->instructions }}
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>

@include('partials.footer')

@auth
    <script>
        document.getElementById('likeButton').addEventListener('click', function() {
            const recipeId = this.dataset.recipeId;
            const button = this;
            const likesCount = document.getElementById('likesCount');

            fetch(`/recipes/${recipeId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.liked) {
                        button.classList.remove('bg-gray-100', 'text-gray-600', 'hover:bg-gray-200');
                        button.classList.add('bg-red-50', 'text-red-600', 'border', 'border-red-200');
                        button.querySelector('svg').style.fill = 'currentColor';
                    } else {
                        button.classList.remove('bg-red-50', 'text-red-600', 'border', 'border-red-200');
                        button.classList.add('bg-gray-100', 'text-gray-600', 'hover:bg-gray-200');
                        button.querySelector('svg').style.fill = 'none';
                    }
                    likesCount.textContent = data.likes_count;
                });
        });
    </script>
@endauth

</body>
</html>
