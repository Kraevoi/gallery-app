<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function create()
    {
        $albums = Album::all();
        return view('photos.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags' => 'nullable|string|max:255',
            'album_id' => 'required|exists:albums,id',
            'image' => 'required|image|max:10240', // максимум 10 МБ (10240 КБ)
        ]);

        $file = $request->file('image');
        
        // Конвертируем в base64
        $base64Data = base64_encode(file_get_contents($file->getRealPath()));
        $mimeType = $file->getMimeType();

        Photo::create([
            'user_id' => auth()->id(),
            'album_id' => $request->album_id,
            'title' => $request->title,
            'description' => $request->description,
            'tags' => $request->tags,
            'base64_data' => $base64Data,
            'mime_type' => $mimeType,
            'is_approved' => false, // пре-модерация
        ]);

        return redirect('/')->with('success', 'Фото загружено и отправлено на модерацию.');
    }
}