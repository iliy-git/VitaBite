<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaBite - Здоровое питание</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
@include('navbar')

<main class="flex-grow container mx-auto px-4 py-8">
    <section class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Добро пожаловать в VitaBite</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Откройте для себя мир здорового питания с простыми рецептами и полезными советами
        </p>
    </section>

    <section class="mb-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Последние статьи</h2>
            <a href="{{ route('posts.index') }}" class="text-green-600 hover:text-green-800 font-medium">
                Все статьи →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full mb-3">
                            {{ $post->category }}
                        </span>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $post->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 120) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $post->created_at->format('d.m.Y') }}</span>
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-green-600 hover:text-green-800 font-medium">
                                Читать →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mb-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Популярные рецепты</h2>
            <a href="{{ route('recipes.index') }}" class="text-green-600 hover:text-green-800 font-medium">
                Все рецепты →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($recipes as $recipe)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
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
                        <div class="flex justify-between text-sm text-gray-500 mb-3">
                            <span>{{ $recipe->prep_time + $recipe->cook_time }} мин</span>
                            <span>{{ $recipe->servings }} порции</span>
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
    </section>
    <script>
        (function() {
            var captcha_version = 11;
            var captcha_done = false;
            var captcha_label = "Подтвердите, что вы не робот";
            var captcha_enemies = 4;
            var sound = true;
            var countdown = false;

            var overlay = document.createElement('div');
            overlay.id = 'doom-captcha-overlay';
            overlay.style.cssText = `
              position: fixed;
              top: 0; left: 0;
              width: 100%; height: 100%;
              background: rgba(0,0,0,0.92);
              display: flex;
              flex-direction: column;
              justify-content: center;
              align-items: center;
              z-index: 9999999;
              font-family: monospace;
              color: white;
            `;

            var html = '<p style="margin-bottom:20px; font-size:18px;">' + captcha_label + '</p>';
            html += '<iframe id="doom_captcha" src="https://vivirenremoto.github.io/doomcaptcha/captcha.html?version=' + captcha_version + '&sound=' + sound + '&countdown=' + countdown + '&enemies=' + captcha_enemies + '" style="width:600px;height:300px;border:3px solid #333;"></iframe>';

            overlay.innerHTML = html;
            document.body.appendChild(overlay);

            window.addEventListener('message', function(e) {
                if (e.origin === 'https://vivirenremoto.github.io') {
                    captcha_done = true;
                    document.getElementById('doom_captcha').style.borderColor = '#0f0';
                    setTimeout(function() {
                        overlay.style.display = 'none';
                    }, 500);
                }
            });

            document.addEventListener('click', function(e) {
                if (!captcha_done && !e.target.closest('#doom_captcha')) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, true);

            document.addEventListener('keydown', function(e) {
                if (!captcha_done) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, true);
        })();
    </script>

</main>


@include('partials.footer')
</body>
</html>
