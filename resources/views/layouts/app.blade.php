<!DOCTYPE html>
<html lang="ru" class="{{ auth()->check() ? auth()->user()->theme : 'dark' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Фотогалерея')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        accent: '#ef4444', // красный акцент
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">
        <nav class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('gallery.index') }}" class="text-xl font-bold text-accent">Фотогалерея</a>
            <div class="flex items-center gap-4">
                <button onclick="toggleTheme()" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">🌙/☀️</button>
                @auth
                    <span class="text-sm">{{ auth()->user()->name }}</span>
                    <a href="{{ route('photos.create') }}" class="text-sm text-accent hover:underline">Загрузить фото</a>
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.index') }}" class="text-sm text-accent hover:underline">Админка</a>
                @endif
                    <form method="POST" action="{{ route('logout') }}">@csrf <button class="text-sm text-gray-500 hover:text-red-500">Выйти</button></form>
                @else
                    <a href="{{ route('login') }}" class="text-sm">Вход</a>
                    <a href="{{ route('register') }}" class="text-sm">Регистрация</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-7xl mx-auto px-4 py-8 w-full">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'light' : 'dark');
        }
        // Применяем сохранённую тему
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        }
    </script>
</body>
</html>