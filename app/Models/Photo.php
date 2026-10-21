<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'album_id', 'title', 'description', 'tags',
        'base64_data', 'mime_type', 'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}