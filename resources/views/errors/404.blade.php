<!DOCTYPE html>
<html lang="ru" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Не найдено</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        accent: '#ef4444',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-900 text-gray-100 flex items-center justify-center h-screen font-sans">
    <div class="text-center max-w-lg px-6">
        <img src="https://i.pinimg.com/736x/85/4e/7b/854e7bbcb0d4b9217a08b0f4c8b1191a.jpg" alt="Кот с пистолетом" class="w-64 mx-auto rounded-lg shadow-lg mb-6 opacity-90 hover:opacity-100 transition duration-300">
        <h1 class="text-8xl font-black text-accent mb-2 tracking-tighter">404</h1>
        <h2 class="text-2xl font-bold mb-4">Страница не найдена</h2>
        <p class="text-gray-400 mb-8">Возможно, вы промахнулись, или кот уже съел эту страницу.</p>
        <a href="/" class="inline-block bg-accent hover:bg-red-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:shadow-red-500/50 transition-all duration-300 transform hover:-translate-y-1">
            Вернуться на главную
        </a>
    </div>
</body>
</html>