<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'Inventaire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <!-- Navigation -->
        <nav class="bg-white shadow-md">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      <!-- Logo -->
      <div class="flex items-center space-x-3">
        <i class="fas fa-boxes text-blue-600 text-2xl"></i>
        <span class="text-xl font-bold text-gray-800">Gestion d'Inventaire</span>
      </div>

      <!-- Bouton hamburger -->
      <div class="md:hidden">
        <button id="menu-toggle" class="text-gray-700 focus:outline-none">
          <i class="fas fa-bars text-2xl"></i>
        </button>
      </div>

      <!-- Liens desktop -->
      <div class="hidden md:flex items-center space-x-6">
        <a href="/category" class="text-gray-700 hover:text-blue-600 font-semibold transition">Catégories</a>
        <a href="/brands" class="text-gray-700 hover:text-blue-600 font-semibold transition">Marques</a>
        <a href="/modele" class="text-gray-700 hover:text-blue-600 font-semibold transition">Modèles</a>
      </div>
    </div>
  </div>

  <!-- Menu mobile -->
  <div id="mobile-menu" class="hidden md:hidden px-4 pb-4">
    <a href="/category" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Catégories</a>
    <a href="/brands" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Marques</a>
    <a href="/modele" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Modèles</a>
  </div>
</nav>

<!-- Script pour toggle menu -->
<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  toggleBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>



        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Header with Add Button + View Switch -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Liste des Produits</h1>
                <div class="flex gap-4">
                    <!-- View Switch Buttons -->
                    <button onclick="switchView('table')" class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded">
                        <i class="fas fa-table"></i> Vue Tableau
                    </button>
                    <button onclick="switchView('card')" class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded">
                        <i class="fas fa-th-large"></i> Vue Carte
                    </button>
                    <!-- Add Product -->
                    <a href="{{ route('products.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Ajouter
                    </a>
                </div>
            </div>

            <!-- Table View -->
            <div id="tableView">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Marque</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Modèle</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Catégorie</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $product->id }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $product->brand->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $product->modele->nom }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $product->category->nom }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ number_format($product->price, 2) }} €</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 inline-flex text-xs font-semibold rounded-full
                                            {{ $product->quantity > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->quantity }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Card View -->
            <div id="cardView" class="hidden grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition duration-300">
                    <div class="mb-2 flex justify-between">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
                        <span class="text-sm text-gray-500">{{ $product->type }}</span>
                    </div>
                    <p class="text-sm text-gray-500 mb-1"><strong>Marque:</strong> {{ $product->brand->name }}</p>
                    <p class="text-sm text-gray-500 mb-1"><strong>Modèle:</strong> {{ $product->modele->nom }}</p>
                    <p class="text-sm text-gray-500 mb-1"><strong>Catégorie:</strong> {{ $product->category->nom }}</p>
                    <p class="text-sm text-gray-500 mb-1"><strong>Prix:</strong> {{ number_format($product->price, 2) }} €</p>
                    <p class="text-sm mb-2">
                        <strong>Quantité:</strong>
                        <span class="px-2 py-1 rounded-full text-xs 
                              {{ $product->quantity > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                              {{ $product->quantity }}
                        </span>
                    </p>
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- JS pour basculer entre les vues -->
    <script>
        function switchView(view) {
            document.getElementById('tableView').style.display = view === 'table' ? 'block' : 'none';
            document.getElementById('cardView').style.display = view === 'card' ? 'grid' : 'none';
        }
    </script>
</body>
</html>
