@extends('layouts.admin')

@section('title', 'Редактирование поста - VitaBite Admin')
@section('page-title', 'Редактирование поста')

@section('content')
    <div class="bg-white rounded-lg shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-medium text-gray-900">Редактирование: {{ $post->title }}</h2>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Заголовок поста *
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $post->title) }}"
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

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
                                <option value="{{ $category }}" {{ old('category', $post->category) == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                            Содержание поста *
                        </label>
                        <textarea name="content"
                                  id="content"
                                  rows="12"
                                  required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox"
                               name="is_published"
                               id="is_published"
                               value="1"
                               {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_published" class="ml-2 text-sm text-gray-700">
                            Опубликован
                        </label>
                    </div>
                </div>

                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('admin.posts.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-md transition-colors flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Назад к списку
                    </a>
                    <div class="flex gap-3">
                        <a href="{{ route('posts.show', $post->slug) }}"
                           target="_blank"
                           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition-colors flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            Просмотр
                        </a>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition-colors flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Обновить пост
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
