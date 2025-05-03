<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded shadow-md animate-fade-in">
        <h2 class="text-2xl font-bold text-center mb-6 text-blue-600">
            <i class="fas fa-user-plus mr-2"></i>Créer un compte
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nom complet</label>
                <input id="name" name="name" type="text" class="w-full mt-1 px-4 py-2 border rounded" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Adresse email</label>
                <input id="email" name="email" type="email" class="w-full mt-1 px-4 py-2 border rounded" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Mot de passe</label>
                <input id="password" name="password" type="password" class="w-full mt-1 px-4 py-2 border rounded" required>
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700">Confirmation du mot de passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="w-full mt-1 px-4 py-2 border rounded" required>
                @error('password_confirmation')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:underline">
                    Déjà inscrit ?
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    S'inscrire
                </button>
            </div>
        </form>
    </div>

    <style>
        @keyframes fade-in {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }
    </style>
</body>
</html>
