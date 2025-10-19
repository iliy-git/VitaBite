@extends('layouts.admin')

@section('title', 'Редактирование рецепта - VitaBite Admin')
@section('page-title', 'Редактирование рецепта')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-medium text-gray-900">Редактирование: {{ $recipe->title }}</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.recipes.update', $recipe) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Название рецепта *
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $recipe->title) }}"
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Описание рецепта *
                        </label>
                        <textarea name="description"
                                  id="description"
                                  rows="3"
                                  required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $recipe->description) }}</textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="prep_time" class="block text-sm font-medium text-gray-700 mb-1">
                                Время подготовки (мин) *
                            </label>
                            <input type="number"
                                   name="prep_time"
                                   id="prep_time"
                                   value="{{ old('prep_time', $recipe->prep_time) }}"
                                   min="1"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="cook_time" class="block text-sm font-medium text-gray-700 mb-1">
                                Время готовки (мин) *
                            </label>
                            <input type="number"
                                   name="cook_time"
                                   id="cook_time"
                                   value="{{ old('cook_time', $recipe->cook_time) }}"
                                   min="0"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="servings" class="block text-sm font-medium text-gray-700 mb-1">
                                Порции *
                            </label>
                            <input type="number"
                                   name="servings"
                                   id="servings"
                                   value="{{ old('servings', $recipe->servings) }}"
                                   min="1"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                                Категория *
                            </label>
                            <select name="category"
                                    id="category"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ old('category', $recipe->category) == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="difficulty" class="block text-sm font-medium text-gray-700 mb-1">
                                Сложность *
                            </label>
                            <select name="difficulty"
                                    id="difficulty"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Выберите сложность</option>
                                @foreach($difficulties as $difficulty)
                                    <option value="{{ $difficulty }}" {{ old('difficulty', $recipe->difficulty) == $difficulty ? 'selected' : '' }}>
                                        {{ $difficulty }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="ingredients" class="block text-sm font-medium text-gray-700 mb-1">
                            Ингредиенты *
                        </label>
                        <textarea name="ingredients"
                                  id="ingredients"
                                  rows="6"
                                  required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('ingredients', $recipe->ingredients) }}</textarea>
                        @error('ingredients')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="instructions" class="block text-sm font-medium text-gray-700 mb-1">
                            Инструкция приготовления *
                        </label>
                        <textarea name="instructions"
                                  id="instructions"
                                  rows="8"
                                  required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('instructions', $recipe->instructions) }}</textarea>
                        @error('instructions')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox"
                               name="is_published"
                               id="is_published"
                               value="1"
                               {{ old('is_published', $recipe->is_published) ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_published" class="ml-2 text-sm text-gray-700">
                            Опубликован
                        </label>
                    </div>
                </div>

                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('admin.recipes.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-md transition-colors flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Назад к списку
                    </a>
                    <div class="flex gap-3">
                        <a href="{{ route('recipes.show', $recipe->slug) }}"
                           target="_blank"
                           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition-colors flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            Просмотр
                        </a>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition-colors flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Обновить рецепт
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
