<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $recipes = [
            [
                'title' => 'Овсяная каша с ягодами',
                'description' => 'Питательный завтрак, который даст энергию на весь день.',
                'ingredients' => "Овсяные хлопья - 50г\nМолоко или вода - 200мл\nЯгоды свежие или замороженные - 100г\nМед - 1 ч.л.",
                'instructions' => "1. Залейте овсяные хлопья молоком или водой\n2. Варите на медленном огне 5-7 минут\n3. Добавьте ягоды и мед перед подачей",
                'prep_time' => 5,
                'cook_time' => 10,
                'servings' => 1,
                'difficulty' => 'легко',
                'category' => 'завтрак',
                'is_published' => true,
            ],
            [
                'title' => 'Салат с киноа и овощами',
                'description' => 'Легкий и полезный обед, богатый белком и клетчаткой.',
                'ingredients' => "Киноа - 100г\nОгурец - 1 шт\nПомидор - 1 шт\nСладкий перец - 1 шт\nОливковое масло - 1 ст.л.",
                'instructions' => "1. Отварите киноа согласно инструкции\n2. Нарежьте овощи кубиками\n3. Смешайте все ингредиенты\n4. Заправьте оливковым маслом",
                'prep_time' => 15,
                'cook_time' => 15,
                'servings' => 2,
                'difficulty' => 'средне',
                'category' => 'обед',
                'is_published' => true,
            ],
        ];

        foreach ($recipes as $recipe) {
            Recipe::create([
                'title' => $recipe['title'],
                'slug' => Str::slug($recipe['title']),
                'description' => $recipe['description'],
                'ingredients' => $recipe['ingredients'],
                'instructions' => $recipe['instructions'],
                'prep_time' => $recipe['prep_time'],
                'cook_time' => $recipe['cook_time'],
                'servings' => $recipe['servings'],
                'difficulty' => $recipe['difficulty'],
                'category' => $recipe['category'],
                'is_published' => $recipe['is_published'],
            ]);
        }
    }
}
