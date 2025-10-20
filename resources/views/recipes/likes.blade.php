<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Понравившиеся рецепты - VitaBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
@include('navbar')

<main class="flex-grow container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Понравившиеся рецепты</h1>
            <p class="text-xl text-gray-600">Рецепты, которые вам понравились</p>
        </div>

        @if($likedRecipes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($likedRecipes as $recipe)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                                    {{ $recipe->category }}
                                </span>
                                <span class="inline-block bg-orange-100 text-orange-800 text-sm px-3 py-1 rounded-full">
                                    {{ $recipe->difficulty }}
                                </span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $recipe->title }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-2">{{ $recipe->description }}</p>

                            <div class="flex justify-between text-sm text-gray-500 mb-4">
                                <span>{{ $recipe->prep_time + $recipe->cook_time }} мин</span>
                                <span>{{ $recipe->servings }} порции</span>
                            </div>

                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-2 text-gray-500">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    <span class="text-sm">{{ $recipe->likes_count }}</span>
                                </div>
                                <span class="text-sm text-gray-500">{{ $recipe->created_at->format('d.m.Y') }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <a href="{{ route('recipes.show', $recipe->slug) }}" class="text-green-600 hover:text-green-800 font-medium transition-colors duration-200">
                                    Смотреть рецепт →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $likedRecipes->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Нет понравившихся рецептов</h3>
                <p class="text-gray-500 mb-4">Отмечайте рецепты, которые вам понравились, и они появятся здесь</p>
                <a href="{{ route('recipes.index') }}" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    Найти рецепты
                </a>
            </div>
        @endif
    </div>
</main>

@include('partials.footer')
</body>
</html>
