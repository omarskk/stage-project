<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="text-center animate-fade-in">
        <div class="text-4xl font-bold mb-6 text-blue-700 flex items-center justify-center gap-3">
            <i class="fas fa-desktop"></i> Gestion de Stock
        </div>

        <div class="space-x-4">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition duration-300">
                <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
            </a>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition duration-300">
                <i class="fas fa-user-plus mr-2"></i> S'inscrire
            </a>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }
    </style>

</body>
</html>
