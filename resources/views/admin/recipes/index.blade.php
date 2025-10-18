@extends('layouts.admin')

@section('title', 'Управление рецептами - VitaBite Admin')
@section('page-title', 'Управление рецептами')
@section('page-description', 'Создание и редактирование рецептов здорового питания')

    @section('content')
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Все рецепты</h2>
                    <a href="{{ route('admin.recipes.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Создать рецепт
                    </a>
                </div>
            </div>

            <div class="p-6">
                @if($recipes->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Категория</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Сложность</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Время</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recipes as $recipe)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $recipe->title }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($recipe->description, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full bg-blue-100 text-blue-800">
                                    {{ $recipe->category }}
                                </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full bg-orange-100 text-orange-800">
                                    {{ $recipe->difficulty }}
                                </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $recipe->prep_time + $recipe->cook_time }} мин
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $recipe->is_published ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $recipe->is_published ? 'Опубликован' : 'Черновик' }}
                                </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('recipes.show', $recipe->slug) }}" target="_blank"
                                               class="text-blue-600 hover:text-blue-800 transition" title="Просмотреть на сайте">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.recipes.edit', $recipe) }}"
                                               class="text-indigo-600 hover:text-indigo-800 transition" title="Редактировать">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.recipes.destroy', $recipe) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800 transition"
                                                        title="Удалить"
                                                        onclick="return confirm('Вы уверены, что хотите удалить этот рецепт?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $recipes->links() }}
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-utensils text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Рецептов пока нет</p>
                        <a href="{{ route('admin.recipes.create') }}" class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition">
                            <i class="fas fa-plus mr-2"></i>Создать первый рецепт
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endsection
