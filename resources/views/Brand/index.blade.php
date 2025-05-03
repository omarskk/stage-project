<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Marques</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <div class="min-h-screen">
        <!-- Navigation -->
     
        <nav class="bg-white shadow-md sticky top-0 z-50">
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
                <i class="fas fa-boxes text-blue-600 text-2xl"></i>
                <span class="text-xl font-bold text-gray-800">Gestion des Marques</span>
            </div>

            <!-- Bouton Ajouter une Marque -->
            <div>
                <a href="{{ route('brand.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                    Ajouter une Marque
                </a>
            </div>
        </div>
    </div>
</nav>


        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-800">Liste des Marques</h1>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Brands List or any content -->
                    <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Nom de la Marque</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-800">{{ $brand->name }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ route('brand.edit', $brand->id) }}" class="text-blue-600 hover:text-blue-800">                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('brand.destroy', $brand->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette marque ?')">
                                            <i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
