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
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">

<!-- Formulaire de Connexion Centré -->
<div class="max-w-md w-full bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden mx-4">
    <div class="bg-blue-900 text-white px-6 py-6 text-center">
        <h2 class="text-xl font-bold">Connexion à LogiFlex</h2>
        <p class="text-xs text-blue-200 mt-1">Réseau de stockage international</p>
    </div>
    <div class="p-8 space-y-5">
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Adresse email</label>
            <input type="email" placeholder="admin@logiflex.com" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900">
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Mot de passe</label>
            <input type="password" placeholder="••••••••" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-900">
        </div>
        <a href="{{ url('/entrepots') }}" class="block w-full text-center bg-blue-900 hover:bg-blue-800 text-white font-medium py-2.5 px-4 rounded-lg text-sm transition shadow-sm">
            Se connecter
        </a>
    </div>
</div>

</body>
</html>
