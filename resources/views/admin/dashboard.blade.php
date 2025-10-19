<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель - VitaBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
@include('admin.navbar')

<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Панель управления</h1>
        <p class="text-gray-600 mt-2">Управление контентом сайта VitaBite</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-newspaper text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-700">Посты</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Post::count() }}</p>
                    <a href="{{ route('admin.posts.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">Управление →</a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-utensils text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-700">Рецепты</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Recipe::count() }}</p>
                    <a href="{{ route('admin.recipes.index') }}" class="text-green-600 hover:text-green-800 text-sm">Управление →</a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-eye text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-700">Опубликовано</h3>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ \App\Models\Post::where('is_published', true)->count() + \App\Models\Recipe::where('is_published', true)->count() }}
                    </p>
                    <span class="text-purple-600 text-sm">Активный контент</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <i class="fas fa-edit text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-700">Черновики</h3>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ \App\Models\Post::where('is_published', false)->count() + \App\Models\Recipe::where('is_published', false)->count() }}
                    </p>
                    <span class="text-orange-600 text-sm">На модерации</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-blue-600 text-white px-6 py-4">
                <h2 class="text-xl font-medium flex items-center">
                    <i class="fas fa-newspaper mr-3"></i>
                    Управление постами
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <a href="{{ route('admin.posts.create') }}"
                       class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-md flex items-center justify-center">
                        <i class="fas fa-plus mr-2"></i>
                        Создать новый пост
                    </a>

                    <a href="{{ route('admin.posts.index') }}"
                       class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-3 px-4 rounded-md flex items-center justify-center">
                        <i class="fas fa-list mr-2"></i>
                        Просмотреть все посты
                    </a>
                </div>

                @php
                    $recentPosts = \App\Models\Post::latest()->limit(3)->get();
                @endphp

                @if($recentPosts->count() > 0)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-3">Последние посты</h3>
                        <div class="space-y-2">
                            @foreach($recentPosts as $post)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                        <span class="font-medium text-gray-700">{{ Str::limit($post->title, 40) }}</span>
                                    </div>
                                    <div class="flex gap-3">
                                        <a href="{{ route('posts.show', $post->slug) }}" target="_blank"
                                           class="text-blue-600 hover:text-blue-800" title="Просмотреть на сайте">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.posts.edit', $post) }}"
                                           class="text-green-600 hover:text-green-800" title="Редактировать">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-green-600 text-white px-6 py-4">
                <h2 class="text-xl font-medium flex items-center">
                    <i class="fas fa-utensils mr-3"></i>
                    Управление рецептами
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <a href="{{ route('admin.recipes.create') }}"
                       class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-4 rounded-md flex items-center justify-center">
                        <i class="fas fa-plus mr-2"></i>
                        Создать новый рецепт
                    </a>

                    <a href="{{ route('admin.recipes.index') }}"
                       class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-3 px-4 rounded-md flex items-center justify-center">
                        <i class="fas fa-list mr-2"></i>
                        Просмотреть все рецепты
                    </a>
                </div>

                @php
                    $recentRecipes = \App\Models\Recipe::latest()->limit(3)->get();
                @endphp

                @if($recentRecipes->count() > 0)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-3">Последние рецепты</h3>
                        <div class="space-y-2">
                            @foreach($recentRecipes as $recipe)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                        <span class="font-medium text-gray-700">{{ Str::limit($recipe->title, 40) }}</span>
                                    </div>
                                    <div class="flex gap-3">
                                        <a href="{{ route('recipes.show', $recipe->slug) }}" target="_blank"
                                           class="text-blue-600 hover:text-blue-800" title="Просмотреть на сайте">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.recipes.edit', $recipe) }}"
                                           class="text-green-600 hover:text-green-800" title="Редактировать">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
        @php
            $unpublishedPosts = \App\Models\Post::where('is_published', false)->latest()->limit(5)->get();
        @endphp
        @if($unpublishedPosts->count() > 0)
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <h3 class="text-lg font-medium text-yellow-800 mb-4 flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    Посты на модерации
                </h3>
                <div class="space-y-2">
                    @foreach($unpublishedPosts as $post)
                        <div class="flex justify-between items-center p-2 hover:bg-yellow-100 rounded">
                            <span class="text-yellow-700">{{ Str::limit($post->title, 30) }}</span>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-yellow-600 hover:text-yellow-800 text-sm">
                                Опубликовать
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @php
            $unpublishedRecipes = \App\Models\Recipe::where('is_published', false)->latest()->limit(5)->get();
        @endphp
        @if($unpublishedRecipes->count() > 0)
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <h3 class="text-lg font-medium text-yellow-800 mb-4 flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    Рецепты на модерации
                </h3>
                <div class="space-y-2">
                    @foreach($unpublishedRecipes as $recipe)
                        <div class="flex justify-between items-center p-2 hover:bg-yellow-100 rounded">
                            <span class="text-yellow-700">{{ Str::limit($recipe->title, 30) }}</span>
                            <a href="{{ route('admin.recipes.edit', $recipe) }}" class="text-yellow-600 hover:text-yellow-800 text-sm">
                                Опубликовать
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
</body>
@include('partials.footer')
</html>
