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
    <div class="flex flex-col lg:flex-row gap-8">
        <div class="lg:w-3/4">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Коллекция рецептов</h1>
                <p class="text-xl text-gray-600">Здоровые и вкусные блюда для каждого дня</p>
            </div>

            <div class="lg:hidden mb-4">
                <button id="filterToggle" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-left font-medium text-gray-700 hover:bg-gray-50 flex items-center justify-between">
                    <span>Фильтры</span>
                    <svg class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>

            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600">
                    Найдено рецептов: <span class="font-semibold">{{ $recipes->total() }}</span>
                </p>
                @if(request()->anyFilled(['category', 'difficulty', 'max_time', 'servings']))
                    <a href="{{ route('recipes.index') }}" class="text-sm text-red-600 hover:text-red-800 font-medium">
                        Сбросить фильтры
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                @foreach($recipes as $recipe)
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
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ $recipe->created_at->format('d.m.Y') }}</span>
                                <a href="{{ route('recipes.show', $recipe->slug) }}" class="text-green-600 hover:text-green-800 font-medium transition-colors duration-200">
                                    Смотреть рецепт →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $recipes->links() }}
        </div>

        <div class="lg:w-1/4">
            <div id="filterSidebar" class="lg:block hidden bg-white rounded-lg shadow-sm p-6 sticky top-4">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Фильтры</h2>
                </div>

                <form method="GET" action="{{ route('recipes.index') }}" id="filterForm">
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-3">Категория</h3>
                        <select name="category" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Все категории</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-3">Сложность</h3>
                        <select name="difficulty" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Любая сложность</option>
                            @foreach($difficulties as $difficulty)
                                <option value="{{ $difficulty }}" {{ request('difficulty') == $difficulty ? 'selected' : '' }}>
                                    {{ $difficulty }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-3">Макс. время (мин)</h3>
                        <select name="max_time" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Любое время</option>
                            <option value="15" {{ request('max_time') == '15' ? 'selected' : '' }}>До 15 минут</option>
                            <option value="30" {{ request('max_time') == '30' ? 'selected' : '' }}>До 30 минут</option>
                            <option value="60" {{ request('max_time') == '60' ? 'selected' : '' }}>До 1 часа</option>
                            <option value="120" {{ request('max_time') == '120' ? 'selected' : '' }}>До 2 часов</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-3">Порции</h3>
                        <select name="servings" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Любое количество</option>
                            @foreach($servingsOptions as $serving)
                                <option value="{{ $serving }}" {{ request('servings') == $serving ? 'selected' : '' }}>
                                    {{ $serving }} порций
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium">
                        Применить фильтры
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

@include('partials.footer')

</body>
</html>
