<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Modèle</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Ajouter un Modèle</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('modele.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom du Modèle</label>
            <input type="text" name="nom" id="nom" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="brand_id" class="block text-gray-700 font-semibold mb-2">Marque</label>
            <select name="brand_id" id="brand_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">-- Choisir une marque --</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('modele.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Annuler</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
        </div>
    </form>
</div>

</body>
</html>
