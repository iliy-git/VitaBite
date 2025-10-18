<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все рецепты - VitaBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
@include('navbar')

<main class="flex-grow container mx-auto px-4 py-8">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Коллекция рецептов</h1>
        <p class="text-xl text-gray-600">Здоровые и вкусные блюда для каждого дня</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($recipes as $recipe)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
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
                    <p class="text-gray-600 mb-4">{{ $recipe->description }}</p>
                    <div class="flex justify-between text-sm text-gray-500 mb-4">
                        <span>⏱️ {{ $recipe->prep_time + $recipe->cook_time }} мин</span>
                        <span>🍽️ {{ $recipe->servings }} порции</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">{{ $recipe->created_at->format('d.m.Y') }}</span>
                        <a href="{{ route('recipes.show', $recipe->slug) }}" class="text-green-600 hover:text-green-800 font-medium">
                            Смотреть рецепт →
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $recipes->links() }}
</main>

@include('partials.footer')
</body>
</html>
