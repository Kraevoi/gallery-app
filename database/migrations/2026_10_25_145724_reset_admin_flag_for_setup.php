<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Сбрасываем флаг is_admin у всех пользователей, чтобы открыть маршрут настройки
        DB::table('users')->update(['is_admin' => false]);
    }

    public function down(): void
    {
        // Ничего не делаем
    }
};