<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogiFlex - Connexion</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .btn-logiflex {
            background-color: #1e3a8a;
        }
        .btn-logiflex:hover {
            background-color: #172554;
        }
        /* Effet de fond dynamique et immersif style logistique internationale */
        .bg-logistics-pattern {
            background-image: linear-gradient(to bottom right, rgba(15, 23, 42, 0.9), rgba(30, 58, 138, 0.85)),
            url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-logistics-pattern min-h-screen flex items-center justify-center font-sans p-4 relative overflow-hidden">

<!-- Éléments lumineux décoratifs d'arrière-plan -->
<div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
<div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>

<!-- Carte de Connexion en Verre Dépoli (Glassmorphism) -->
<div class="max-w-md w-full bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 overflow-hidden p-8 relative z-10 transform transition-all duration-300 hover:shadow-blue-900/50">

    <!-- Logo LogiFlex transparent en h-24 sans sous-titre -->
    <div class="flex flex-col items-center mb-8">
        <img src="{{ asset('images/Logo_LogiFlex_transparent.png') }}" alt="LogiFlex Logo" class="h-24 object-contain drop-shadow-sm">
    </div>

    <!-- Formulaire -->
    <div class="space-y-5">
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Nom d'utilisateur / Email</label>
            <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                        <i class="fa-solid fa-user text-xs"></i>
                    </span>
                <input type="text" placeholder="nom@logiflex.com" class="w-full bg-gray-50/80 border border-gray-300 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900 focus:bg-white transition-all">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Mot de passe</label>
            <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </span>
                <input type="password" placeholder="••••••••" class="w-full bg-gray-50/80 border border-gray-300 rounded-xl pl-10 pr-10 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900 focus:bg-white transition-all">
                <span class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 cursor-pointer hover:text-gray-600">
                        <i class="fa-solid fa-eye-slash text-sm"></i>
                    </span>
            </div>
        </div>

        <!-- Options (Se souvenir / Mot de passe oublié) -->
        <div class="flex items-center justify-between text-xs text-gray-600 pt-1">
            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" class="rounded border-gray-300 text-blue-900 focus:ring-blue-900">
                <span>Se souvenir de moi</span>
            </label>
            <a href="#" class="text-blue-900 font-semibold hover:underline">Mot de passe oublié ?</a>
        </div>

        <div class="pt-3">
            <a href="{{ url('/entrepots') }}" class="block w-full text-center btn-logiflex text-white font-semibold py-3.5 px-4 rounded-xl text-sm transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                Se Connecter <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
    </div>

    <!-- Footer discret de la carte -->
    <div class="mt-8 text-center border-t border-gray-100 pt-4">
        <p class="text-[11px] text-gray-400">LogiFlex v2.4 • Système de gestion sécurisé</p>
    </div>
</div>

</body>
</html>
