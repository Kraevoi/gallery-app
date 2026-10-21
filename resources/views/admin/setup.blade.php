@extends('layouts.app')
@section('title', 'Создание администратора')
@section('content')
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Секретная настройка админа</h1>
        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('admin.setup.post') }}">
            @csrf
            <input name="name" placeholder="Имя" class="w-full p-2 mb-2 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600" required>
            <input name="email" type="email" placeholder="Email" class="w-full p-2 mb-2 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600" required>
            <input name="password" type="password" placeholder="Пароль" class="w-full p-2 mb-2 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600" required>
            <input name="secret_password" type="password" placeholder="Секретный пароль из .env" class="w-full p-2 mb-2 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600" required>
            <button class="w-full bg-accent text-white py-2 rounded mt-2">Создать админа</button>
        </form>
    </div>
@endsection