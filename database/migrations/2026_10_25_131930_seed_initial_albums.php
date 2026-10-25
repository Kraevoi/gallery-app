<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Album;

return new class extends Migration
{
    public function up(): void
    {
        // Проверяем, нет ли уже альбомов, чтобы не дублировать при повторном запуске
        if (Album::count() === 0) {
            Album::create(['name' => 'Природа', 'slug' => 'priroda']);
            Album::create(['name' => 'Город', 'slug' => 'gorod']);
            Album::create(['name' => 'Животные', 'slug' => 'zhivotnye']);
        }
    }

    public function down(): void
    {
        // Ничего не удаляем, чтобы не потерять данные
    }
};