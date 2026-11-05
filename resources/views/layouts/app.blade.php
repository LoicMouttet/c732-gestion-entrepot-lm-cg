<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogiFlex - Gestion d'Entrepôts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-800">

<!-- En-tête / Navbar agrandi -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between gap-4">
        <!-- Logo & Slogan avec url() de Laravel -->
        <div class="flex items-center gap-3">
            <a href="{{ url('/entrepots') }}" class="flex items-center">
                <img src="{{ asset('images/Logo_LogiFlex.png') }}" alt="LogiFlex" class="h-14 w-auto object-contain">
            </a>
            <span class="hidden md:inline text-sm text-gray-500 border-l pl-3 border-gray-300">
                    Réseau de stockage international
                </span>
        </div>

        <!-- Barre de recherche globale -->
        <div class="flex-1 max-w-md">
            <div class="relative">
                <input type="text"
                       placeholder="Rechercher un article (Nom ou Numéro)..."
                       class="w-full pl-4 pr-10 py-2.5 rounded-full border border-gray-300 focus:outline-none focus:border-blue-500 text-sm">
                <button class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
            </div>
        </div>

        <!-- Menu / Profil -->
        <div class="flex items-center gap-3">
            <button class="text-gray-600 text-2xl hover:text-blue-600">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
</header>

<!-- Contenu Principal -->
<main class="max-w-7xl mx-auto px-6 py-8">
    @yield('content')
</main>

</body>
</html>
