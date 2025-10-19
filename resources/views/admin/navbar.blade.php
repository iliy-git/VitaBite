<nav class="bg-green-600 text-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold">VitaBite Admin</a>
                <span class="text-gray-400">|</span>
                <a href="{{ route('home') }}" target="_blank" class="text-gray-300 hover:text-white">
                    <i class="fas fa-external-link-alt mr-1"></i>На сайт
                </a>
            </div>
            <div class="flex space-x-8">
                <a href="{{ route('admin.dashboard') }}"
                   class="py-3 px-2 border-b-2 {{ request()->routeIs('admin.dashboard') ? 'border-green-400 text-white' : 'border-transparent text-gray-300 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i>Дашборд
                </a>
                <a href="{{ route('admin.posts.index') }}"
                   class="py-3 px-2 border-b-2 {{ request()->routeIs('admin.posts.*') ? 'border-green-400 text-white' : 'border-transparent text-gray-300 hover:text-white' }}">
                    <i class="fas fa-newspaper mr-2"></i>Посты
                </a>
                <a href="{{ route('admin.recipes.index') }}"
                   class="py-3 px-2 border-b-2 {{ request()->routeIs('admin.recipes.*') ? 'border-green-400 text-white' : 'border-transparent text-gray-300 hover:text-white' }}">
                    <i class="fas fa-utensils mr-2"></i>Рецепты
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <span class="text-gray-300">Администратор</span>
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
