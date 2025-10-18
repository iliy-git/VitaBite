<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Основы здорового питания',
                'content' => 'Здоровое питание - это не диета, а образ жизни. Начните с простых правил: ешьте больше овощей, пейте воду и сократите сахар.',
                'category' => 'питание',
                'is_published' => true,
            ],
            [
                'title' => 'Польза регулярных тренировок',
                'content' => 'Всего 30 минут физической активности в день могут значительно улучшить ваше здоровье и настроение.',
                'category' => 'фитнес',
                'is_published' => true,
            ],
            [
                'title' => 'Как начать правильно питаться',
                'content' => 'Постепенные изменения работают лучше резких ограничений. Начните с замены вредных продуктов на полезные аналоги.',
                'category' => 'советы',
                'is_published' => true,
            ],
        ];

        foreach ($posts as $post) {
            Post::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'content' => $post['content'],
                'category' => $post['category'],
                'is_published' => $post['is_published'],
            ]);
        }
    }
}
