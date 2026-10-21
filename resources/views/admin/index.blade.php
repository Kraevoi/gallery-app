@extends('layouts.app')
@section('title', 'Админ-панель')
@section('content')
    <h1 class="text-3xl font-bold mb-6">Админ-панель</h1>

    <!-- Статистика -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border-l-4 border-accent">
            <h2 class="text-xl font-semibold mb-2">На модерации</h2>
            <p class="text-3xl text-accent font-bold">{{ $pendingPhotos->count() }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border-l-4 border-red-500">
            <h2 class="text-xl font-semibold mb-2">Жалобы</h2>
            <p class="text-3xl text-red-500 font-bold">{{ $reports->count() }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border-l-4 border-blue-500">
            <h2 class="text-xl font-semibold mb-2">Пользователи</h2>
            <p class="text-3xl text-blue-500 font-bold">{{ $users->count() }}</p>
        </div>
    </div>

    <!-- Блок модерации фото -->
    <div class="bg-white dark:bg-gray-800 rounded shadow p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Фото на модерации</h2>
        @if($pendingPhotos->isEmpty())
            <p class="text-gray-500">Нет фото на модерации.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($pendingPhotos as $photo)
                    <div class="border dark:border-gray-700 p-4 rounded flex gap-4 items-center">
                        <img src="data:{{ $photo->mime_type }};base64,{{ $photo->base64_data }}" alt="{{ $photo->title }}" class="w-24 h-24 object-cover rounded">
                        <div class="flex-1">
                            <p class="font-semibold">{{ $photo->title }}</p>
                            <p class="text-sm text-gray-500">Загрузил: {{ $photo->user->name ?? 'Удален' }}</p>
                            <p class="text-sm text-gray-500">Альбом: {{ $photo->album->name ?? 'Удален' }}</p>
                            <div class="mt-2 flex gap-2">
                                <form method="POST" action="{{ route('admin.approve', $photo->id) }}">@csrf
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">Одобрить</button>
                                </form>
                                <form method="POST" action="{{ route('admin.reject', $photo->id) }}">@csrf
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Отклонить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Блок жалоб -->
    <div class="bg-white dark:bg-gray-800 rounded shadow p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Жалобы на фото</h2>
        @if($reports->isEmpty())
            <p class="text-gray-500">Жалоб нет.</p>
        @else
            <div class="flex flex-col gap-4">
                @foreach($reports as $report)
                    <div class="border dark:border-gray-700 p-4 rounded flex gap-4 items-start">
                        @if($report->photo)
                            <img src="data:{{ $report->photo->mime_type }};base64,{{ $report->photo->base64_data }}" class="w-16 h-16 object-cover rounded">
                        @endif
                        <div class="flex-1">
                            <p class="font-semibold text-accent">{{ $report->reason }}</p>
                            <p class="text-sm text-gray-500">Пожаловался: {{ $report->user->name ?? 'Аноним' }}</p>
                            @if($report->photo)
                                <a href="{{ route('gallery.show', $report->photo->id) }}" class="text-sm text-blue-500 underline">Посмотреть фото</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Блок пользователей -->
    <div class="bg-white dark:bg-gray-800 rounded shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Пользователи</h2>
        @if($users->isEmpty())
            <p class="text-gray-500">Пользователей нет.</p>
        @else
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b dark:border-gray-700">
                        <th class="py-2">Имя</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Статус</th>
                        <th class="py-2">Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-2">{{ $user->name }}</td>
                            <td class="py-2">{{ $user->email }}</td>
                            <td class="py-2">
                                @if($user->is_blocked)
                                    <span class="text-red-500">Заблокирован</span>
                                @else
                                    <span class="text-green-500">Активен</span>
                                @endif
                            </td>
                            <td class="py-2">
                                <form method="POST" action="{{ route('admin.block', $user->id) }}">@csrf
                                    <button class="text-sm px-3 py-1 rounded {{ $user->is_blocked ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} text-white">
                                        {{ $user->is_blocked ? 'Разблокировать' : 'Заблокировать' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection