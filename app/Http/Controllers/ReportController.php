<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $photo = Photo::findOrFail($id);

        Report::create([
            'photo_id' => $photo->id,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Жалоба отправлена администратору.');
    }
}