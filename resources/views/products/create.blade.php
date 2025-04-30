<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <i class="fas fa-boxes text-blue-600 text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-gray-800">Gestion d'Inventaire</span>
                    </div>
                </div>
            </div>
        </nav>
        @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Erreur ! </strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="bg-white shadow-md rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-800">Ajouter un Produit</h1>
                </div>

                <div class="p-6">
                    <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nom -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                                <input name="name" type="text" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Marque -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Marque</label>
                                <select name="brand_id" id="brand_id" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Sélectionner une Marque --</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Modèle -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Modèle</label>
                                <select name="modele_id" id="modele_id" required disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Sélectionner une Marque d'abord --</option>
                                </select>
                            </div>

                            <!-- Catégorie -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                                <select name="category_id" id="category_id" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Sélectionner une Catégorie --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Prix -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Prix (€)</label>
                                <input name="price" type="number" step="0.01" required
                                       class="w-full px-4 py-2 pl-8 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Quantité -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Quantité</label>
                                <input name="quantity" type="number" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="form-group">
    <label for="type">Type</label>
    <select name="type" class="form-control" required>
        <option value="entrée">Entrée</option>
        <option value="sortie">Sortie</option>
    </select>
</div>


                        <!-- Actions -->
                        <div class="flex justify-end pt-4 space-x-4">
                            <a href="{{ route('products.index') }}"
                               class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                                Annuler
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                Ajouter le Produit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script AJAX -->
    <script>
        document.getElementById('brand_id').addEventListener('change', function () {
            let brandId = this.value;
            let modeleSelect = document.getElementById('modele_id');

            modeleSelect.innerHTML = '<option value="">Chargement...</option>';
            modeleSelect.disabled = true;

            if (brandId) {
                fetch('/get-modeles/' + brandId)
                    .then(response => response.json())
                    .then(data => {
                        modeleSelect.innerHTML = '<option value="">-- Sélectionner un Modèle --</option>';
                        data.forEach(modele => {
                            modeleSelect.innerHTML += `<option value="${modele.id}">${modele.nom}</option>`;
                        });
                        modeleSelect.disabled = false;
                    });
            } else {
                modeleSelect.innerHTML = '<option value="">-- Sélectionner une Marque d\'abord --</option>';
                modeleSelect.disabled = true;
            }
        });
    </script>
</body>
</html>
