<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Modèles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-white shadow-md sticky top-0 z-50 mb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Bouton retour -->
            <div class="flex items-center space-x-4">
                <a href="/products" class="text-gray-600 hover:text-blue-600 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span class="font-medium">Retour</span>
                </a>
            </div>

            <!-- Titre principal -->
            <div class="flex items-center space-x-2">
                <i class="fas fa-car text-blue-600 text-2xl"></i>
                <span class="text-xl font-bold text-gray-800">Liste des Modèles</span>
            </div>

            <!-- Bouton Ajouter -->
            <div>
                <a href="{{ route('modele.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                    Ajouter un Modèle
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- CONTENU PRINCIPAL -->
<div class="max-w-4xl mx-auto px-4">
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-3">Nom</th>
                <th class="p-3">Marque</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($modeles as $modele)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3">{{ $modele->nom }}</td>
                    <td class="p-3">{{ $modele->brand->name }}</td>
                    <td class="p-3 flex space-x-2">
                        <form action="{{ route('modele.destroy', $modele->id) }}" method="POST" onsubmit="return confirm('Supprimer ce modèle ?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
