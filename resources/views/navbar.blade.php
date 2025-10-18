<nav class="bg-green-600 text-white shadow-lg">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold">VitaBite</a>

            <div class="flex space-x-6">
                <a href="{{ route('home') }}" class="hover:text-green-200 transition">Главная</a>
                <a href="{{ route('posts.index') }}" class="hover:text-green-200 transition">Статьи</a>
                <a href="{{ route('recipes.index') }}" class="hover:text-green-200 transition">Рецепты</a>
                <a href="{{ route('about') }}" class="hover:text-green-200 transition">О нас</a>

                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-green-200 transition">
                            <i class="fas fa-cog mr-1"></i>Админка
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
