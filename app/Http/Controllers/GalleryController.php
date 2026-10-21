<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::withCount(['photos' => function ($query) {
            $query->where('is_approved', true);
        }])->get();

        return view('gallery.index', compact('albums'));
    }

    public function album($slug)
    {
        $album = Album::where('slug', $slug)->firstOrFail();
        $photos = $album->photos()->where('is_approved', true)->latest()->paginate(12);

        return view('gallery.album', compact('album', 'photos'));
    }

    public function show($id)
    {
        $photo = Photo::where('is_approved', true)->findOrFail($id);
        return view('gallery.show', compact('photo'));
    }
}