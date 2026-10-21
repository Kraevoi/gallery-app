@extends('layouts.app')
@section('title', 'Загрузка фото')
@section('content')
    <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow mt-10">
        <h1 class="text-2xl font-bold mb-4">Загрузить фото</h1>
        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
            @csrf
            <input name="title" placeholder="Название" class="w-full p-2 mb-3 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent" required>
            <textarea name="description" placeholder="Описание" class="w-full p-2 mb-3 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent" rows="3"></textarea>
            <input name="tags" placeholder="Теги (через запятую)" class="w-full p-2 mb-3 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent">
            <select name="album_id" class="w-full p-2 mb-3 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent" required>
                <option value="">Выберите альбом</option>
                @foreach($albums as $album)
                    <option value="{{ $album->id }}">{{ $album->name }}</option>
                @endforeach
            </select>
            <input type="file" name="image" accept="image/*" class="w-full p-2 mb-3 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600 focus:outline-none" required>
            <button class="w-full bg-accent hover:bg-red-600 text-white font-bold py-2 rounded transition duration-300">Загрузить (макс. 10 МБ)</button>
        </form>
    </div>
@endsection