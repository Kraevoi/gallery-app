<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Удаляем всех пользователей, чтобы освободить секретный маршрут
        DB::table('users')->truncate();
    }

    public function down(): void
    {
        // Ничего не делаем
    }
};