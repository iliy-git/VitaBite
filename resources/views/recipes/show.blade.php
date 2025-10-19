<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }} - VitaBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
@include('navbar')

<main class="flex-grow container mx-auto px-4 py-8">
    <article class="max-w-4xl mx-auto bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-8">
            <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                        {{ $recipe->category }}
                    </span>
                <span class="inline-block bg-orange-100 text-orange-800 text-sm px-3 py-1 rounded-full">
                        {{ $recipe->difficulty }}
                    </span>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $recipe->title }}</h1>
            <p class="text-xl text-gray-600 mb-6">{{ $recipe->description }}</p>

            <div class="flex gap-6 text-sm text-gray-500 mb-8">
                <div>
                    <span>Подготовка: {{ $recipe->prep_time }} мин</span>
                </div>
                <div>
                    <span>Приготовление: {{ $recipe->cook_time }} мин</span>
                </div>
                <div>
                    <span>{{ $recipe->servings }} порции</span>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Ингредиенты</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        {!! nl2br(e($recipe->ingredients)) !!}
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Инструкция</h2>
                    <div>
                        {!! nl2br(e($recipe->instructions)) !!}
                    </div>
                </div>
            </div>
        </div>
    </article>

    @if($relatedRecipes->count() > 0)
        <section class="max-w-4xl mx-auto mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Похожие рецепты</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($relatedRecipes as $relatedRecipe)
                    <div class="bg-white rounded-lg shadow-sm p-4">
                        <h3 class="font-semibold text-gray-800 mb-2">{{ $relatedRecipe->title }}</h3>
                        <a href="{{ route('recipes.show', $relatedRecipe->slug) }}" class="text-green-600 hover:text-green-800 text-sm">
                            Смотреть рецепт
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
