<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Modèles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto py-8">
    <a href="{{ route('modele.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Ajouter un Modèle</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">Nom</th>
                <th class="p-3">Marque</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($modeles as $modele)
                <tr class="border-t">
                    <td class="p-3">{{ $modele->nom }}</td>
                    <td class="p-3">{{ $modele->brand->name }}</td>
                    <td class="p-3 flex space-x-2">
                        <form action="{{ route('modele.destroy', $modele->id) }}" method="POST" onsubmit="return confirm('Supprimer ce modèle ?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
