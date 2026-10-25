@extends('layouts.app')
@section('title', 'Загрузка фото')
@section('content')
    <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Загрузить фото</h1>
        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
            @csrf
            <input name="title" placeholder="Название" class="w-full p-2 mb-2 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600" required>
            <textarea name="description" placeholder="Описание" class="w-full p-2 mb-2 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600" rows="3"></textarea>
            <input name="tags" placeholder="Теги (через запятую)" class="w-full p-2 mb-2 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600">
            <select name="album_id" class="w-full p-2 mb-2 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600" required>
                <option value="">Выберите альбом</option>
                @foreach($albums as $album)
                    <option value="{{ $album->id }}">{{ $album->name }}</option>
                @endforeach
            </select>
            <input type="file" name="image" accept="image/*" class="w-full p-2 mb-2 rounded bg-gray-100 dark:bg-gray-700 border dark:border-gray-600" required>
            <button class="w-full bg-accent text-white py-2 rounded mt-2">Загрузить (макс. 10 МБ)</button>
        </form>
    </div>
@endsection