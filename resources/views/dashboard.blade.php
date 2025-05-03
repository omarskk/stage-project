<x-app-layout>
   

    <div class="py-10 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Message de bienvenue -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-700 mb-2">👋 Bienvenue {{ Auth::user()->name }}</h3>
                <p class="text-gray-600">Vous êtes connecté à votre espace de gestion de stock.</p>
            </div>

            <!-- Cartes de navigation -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Produits -->
                <a href="{{ route('products.index') }}" class="bg-white p-5 shadow rounded hover:bg-blue-50 transition transform hover:scale-105 duration-300 flex items-center gap-4">
                    <i class="fas fa-boxes text-blue-500 text-3xl"></i>
                    <div>
                        <h4 class="font-semibold text-gray-800 text-lg">Produits</h4>
                        <p class="text-sm text-gray-500">Voir et gérer les produits</p>
                    </div>
                </a>

                <!-- Utilisateurs (admin uniquement) -->
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('users.index') }}" class="bg-white p-5 shadow rounded hover:bg-red-50 transition transform hover:scale-105 duration-300 flex items-center gap-4">
                        <i class="fas fa-users-cog text-red-500 text-3xl"></i>
                        <div>
                            <h4 class="font-semibold text-gray-800 text-lg">Utilisateurs</h4>
                            <p class="text-sm text-gray-500">Gérer les utilisateurs</p>
                        </div>
                    </a>

                    <!-- Opérations -->
                    <a href="{{ route('operations.index') }}" class="bg-white p-5 shadow rounded hover:bg-green-50 transition transform hover:scale-105 duration-300 flex items-center gap-4">
                        <i class="fas fa-exchange-alt text-green-500 text-3xl"></i>
                        <div>
                            <h4 class="font-semibold text-gray-800 text-lg">Opérations</h4>
                            <p class="text-sm text-gray-500">Historique des entrées / sorties</p>
                        </div>
                    </a>
                @endif
            </div>

            <!-- Graphique de stock -->
            @if(Auth::user()->role === 'admin')
                <div class="flex justify-center mt-6">
                    <div class="bg-white p-6 rounded shadow" style="width: 50%;">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Statistiques de Stock</h3>
                        <canvas id="stockChart" width="300" height="400"></canvas>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <style>
        .stock-card {
            width: 30%;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('stockChart').getContext('2d');

        const stockChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($labels) !!}, // ['Produit A', 'Produit B', ...]
                datasets: [{
                    label: 'Quantité en stock',
                    data: {!! json_encode($data) !!}, // [120, 80, ...]
                    backgroundColor: [
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b',
                        '#ef4444',
                        '#8b5cf6',
                        '#14b8a6'
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
    </script>

    <!-- FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" defer></script>
</x-app-layout>
