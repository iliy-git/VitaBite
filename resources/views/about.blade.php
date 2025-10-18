<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас - VitaBite</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
@include('navbar')

<main class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">О VitaBite</h1>

            <div class="prose max-w-none text-lg text-gray-700 leading-relaxed">
                <p class="mb-6">
                    <strong>VitaBite</strong> - это проект, созданный с любовью к здоровому образу жизни и правильному питанию.
                    Мы верим, что здоровое питание должно быть доступным, вкусным и простым.
                </p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Наша миссия</h2>
                <p class="mb-6">
                    Помочь каждому человеку сделать здоровое питание простой и приятной привычкой.
                    Мы собираем лучшие рецепты и полезные советы, чтобы вы могли легко внедрить
                    здоровые привычки в свою повседневную жизнь.
                </p>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Что мы предлагаем</h2>
                <ul class="list-disc list-inside mb-6 space-y-2">
                    <li>Проверенные рецепты здоровых блюд</li>
                    <li>Полезные статьи о питании и здоровье</li>
                    <li>Простые советы для начинающих</li>
                    <li>Инspирацию для здорового образа жизни</li>
                </ul>

                <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Наши принципы</h2>
                <div class="grid md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-green-800 mb-2">Простота</h3>
                        <p class="text-green-700">Рецепты, которые сможет приготовить каждый</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-blue-800 mb-2">Польза</h3>
                        <p class="text-blue-700">Только проверенная информация о здоровье</p>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-orange-800 mb-2">Вкус</h3>
                        <p class="text-orange-700">Здоровое питание может быть вкусным</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-purple-800 mb-2">Доступность</h3>
                        <p class="text-purple-700">Ингредиенты, которые легко найти</p>
                    </div>
                </div>

                <p class="text-center text-gray-600 mt-8 border-t pt-6">
                    Присоединяйтесь к нашему сообществу и начните свой путь к здоровому образу жизни уже сегодня!
                </p>
            </div>
        </div>
    </div>
</main>

@include('partials.footer')
</body>
</html>
