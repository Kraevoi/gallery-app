@extends('layouts.app')
@section('title', 'Альбомы')
@section('content')
    <h1 class="text-3xl font-bold mb-6">Альбомы</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($albums as $album)
            <a href="{{ route('gallery.album', $album->slug) }}" class="block bg-white dark:bg-gray-800 rounded shadow p-6 hover:ring-2 hover:ring-accent transition">
                <h2 class="text-xl font-semibold">{{ $album->name }}</h2>
                <p class="text-sm text-gray-500">{{ $album->photos_count }} фото</p>
            </a>
        @endforeach
    </div>
@endsection