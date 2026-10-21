@extends('layouts.app')
@section('title', $album->name)
@section('content')
    <h1 class="text-3xl font-bold mb-6">{{ $album->name }}</h1>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($photos as $photo)
            <a href="{{ route('gallery.show', $photo->id) }}" class="block bg-white dark:bg-gray-800 rounded overflow-hidden shadow hover:ring-2 hover:ring-accent">
                <img src="data:{{ $photo->mime_type }};base64,{{ $photo->base64_data }}" alt="{{ $photo->title }}" class="w-full h-48 object-cover">
                <div class="p-3">
                    <p class="font-semibold text-sm truncate">{{ $photo->title }}</p>
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-6">{{ $photos->links() }}</div>
@endsection