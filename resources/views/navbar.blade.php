<nav class="bg-green-600 text-white">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold">VitaBite</a>

            <div class="flex space-x-6">
                <a href="{{ route('home') }}" class="hover:text-green-200">Главная</a>
                <a href="{{ route('posts.index') }}" class="hover:text-green-200">Статьи</a>
                <a href="{{ route('recipes.index') }}" class="hover:text-green-200">Рецепты</a>
                <a href="{{ route('recipes.likes') }}" class="hover:text-green-200">
                    <i class="fas fa-heart mr-1"></i>Понравившиеся
                </a>
                <a href="{{ route('posts.bookmarks') }}" class="hover:text-green-200">
                    <i class="fas fa-bookmark mr-1"></i>Закладки
                </a>
                <a href="{{ route('about') }}" class="hover:text-green-200">О нас</a>
                @if ( auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-green-200">
                        <i class="fas fa-cog mr-1"></i>Админка
                    </a>
                @endif

            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-300">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        <i class="fas fa-sign-out-alt mr-2"></i>Выйти
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
