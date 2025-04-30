<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Catégorie</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Ajouter une Catégorie</h1>

    <form action="{{ route('category.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom</label>
            <input type="text" name="nom" id="nom" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('category.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Annuler</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enregistrer</button>
        </div>
    </form>
</div>

</body>
</html>
