@extends('layouts.admin')

@section('title', 'Управление постами - VitaBite Admin')
@section('page-title', 'Управление постами')
@section('page-description', 'Создание и редактирование статей о здоровом питании')

    @section('content')
        <div class="bg-white rounded-lg shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-900">Все посты</h2>
                    <a href="{{ route('admin.posts.create') }}" class="bg-green-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Создать пост
                    </a>
                </div>
            </div>

            <div class="p-6">
                @if($posts->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Заголовок</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Категория</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Статус</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дата</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Действия</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($posts as $post)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        {{ $post->category }}
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs font-medium rounded-full {{ $post->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $post->is_published ? 'Опубликован' : 'Черновик' }}
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $post->created_at->format('d.m.Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-4">
                                            <a href="{{ route('posts.show', $post->slug) }}" target="_blank"
                                               class="text-blue-600 hover:text-blue-800" title="Просмотреть на сайте">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.posts.edit', $post) }}"
                                               class="text-blue-600 hover:text-blue-800" title="Редактировать">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-800"
                                                        title="Удалить"
                                                        onclick="return confirm('Вы уверены, что хотите удалить этот пост?')">
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
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-newspaper text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Постов пока нет</p>
                        <a href="{{ route('admin.posts.create') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                            <i class="fas fa-plus mr-2"></i>Создать первый пост
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endsection
