<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogiFlex - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-800 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md px-4">
    <!-- Carte de Connexion -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
        <!-- En-tête / Logo -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/Logo_LogiFlex.png') }}" alt="LogiFlex" class="h-12 mx-auto mb-3 object-contain">
            <h1 class="text-xl font-bold text-gray-800">Espace Collaborateur</h1>
            <p class="text-xs text-gray-500 mt-1">Réseau de stockage international</p>
        </div>

        <!-- Formulaire de Connexion -->
        <form action="{{ url('/entrepots') }}" method="GET">
            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-600 mb-1">Adresse Email</label>
                <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </span>
                    <input type="email" placeholder="nom.prenom@logiflex.com" required
                           class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="mb-6">
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-semibold text-gray-600">Mot de passe</label>
                    <a href="#" class="text-xs text-blue-600 hover:underline">Mot de passe oublié ?</a>
                </div>
                <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                    <input type="password" placeholder="••••••••" required
                           class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-900 hover:bg-blue-800 text-white text-sm py-2.5 rounded-md font-semibold transition shadow-sm">
                Se connecter
            </button>
        </form>
    </div>

    <!-- Pied de page discret -->
    <div class="text-center mt-6 text-xs text-gray-400">
        &copy; 2026 LogiFlex. Tous droits réservés.
    </div>
</div>

</body>
</html>
