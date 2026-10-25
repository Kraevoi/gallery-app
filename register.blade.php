@extends('layouts.app')
@section('title', 'Регистрация')
@section('content')
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow mt-10">
        <h1 class="text-2xl font-bold mb-4 text-center">Регистрация</h1>
        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input name="name" placeholder="Имя" class="w-full p-2 mb-3 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent" required>
            <input name="email" type="email" placeholder="Email" class="w-full p-2 mb-3 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent" required>
            <input name="password" type="password" placeholder="Пароль" class="w-full p-2 mb-3 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent" required>
            <input name="password_confirmation" type="password" placeholder="Повторите пароль" class="w-full p-2 mb-3 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent" required>
            <button class="w-full bg-accent hover:bg-red-600 text-white font-bold py-2 rounded transition duration-300">Зарегистрироваться</button>
        </form>
        <p class="mt-4 text-sm text-center text-gray-500">Уже есть аккаунт? <a href="{{ route('login') }}" class="text-accent hover:underline">Войти</a></p>
    </div>
@endsection