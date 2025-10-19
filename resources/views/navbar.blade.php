<nav class="bg-green-600 text-white">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold">VitaBite</a>

            <div class="flex space-x-6">
                <a href="{{ route('home') }}" class="hover:text-green-200">Главная</a>
                <a href="{{ route('posts.index') }}" class="hover:text-green-200">Статьи</a>
                <a href="{{ route('recipes.index') }}" class="hover:text-green-200">Рецепты</a>
                <a href="{{ route('about') }}" class="hover:text-green-200">О нас</a>

                <a href="{{ route('admin.dashboard') }}" class="hover:text-green-200">
                    <i class="fas fa-cog mr-1"></i>Админка
                </a>
            </div>
        </div>
    </div>
</nav>
