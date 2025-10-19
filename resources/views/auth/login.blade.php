<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход - VitaBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
<div class="max-w-sm w-full">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">VitaBite</h1>
        <p class="text-gray-600 mt-2">Войдите в свой аккаунт</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 text-sm p-3 rounded-md">
                Неверный email или пароль
            </div>
        @endif

        <div>
            <input
                type="email"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}"
                required
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div>
            <input
                type="password"
                name="password"
                placeholder="Пароль"
                required
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="mr-2">
                <span class="text-sm text-gray-600">Запомнить меня</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:text-green-800">
                    Забыли пароль?
                </a>
            @endif
        </div>

        <button
            type="submit"
            class="w-full bg-green-600 text-white p-3 rounded-md hover:bg-green-700 font-medium">
            Войти
        </button>
    </form>

    @if (Route::has('register'))
        <div class="text-center mt-6">
            <span class="text-gray-600">Нет аккаунта?</span>
            <a href="{{ route('register') }}" class="text-green-600 hover:text-green-800 font-medium ml-1">
                Создать
            </a>
        </div>
    @endif
</div>
</body>
</html>
