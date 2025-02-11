*
<html>
<head>
    <title>Dashboard - Agriculteur</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">  
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <div class="bg-green-500 text-white w-64 min-h-screen p-4">
        <h2 class="text-2xl font-bold mb-6">Dashboard Agriculteur</h2>
        <nav>
            <ul>
                <li class="mb-4">
                    <a href="dasbord investisseurs.php" class="flex items-center p-2 hover:bg-green-700 rounded" aria-label="Mes Projets">
                        <i class="fas fa-project-diagram mr-2"></i> Mes Projets
                    </a>
                </li>
                <li class="mb-4">
                    <a href="nuveau projet.php" class="flex items-center p-2 hover:bg-green-700 rounded" aria-label="Nouveau Projet">
                        <i class="fas fa-plus mr-2"></i> Nouveau Projet
                    </a>
                </li>
                <li class="mb-4">
                    <a href="nuveau projet.php" class="flex items-center p-2 hover:bg-green-700 rounded" aria-label="Modifier Projet">
                        <i class="fas fa-plus mr-2"></i> Modifier un Projet
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <!-- Mes Projets Section -->
        <section id="mes-projets" class="mb-8">
            <h2 class="text-2xl font-bold text-green-700 mb-4">Mes Projets</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Project Card -->
                <div class="bg-white p-4 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    <h3 class="text-xl font-bold mb-2">Projet 1</h3>
                    <p class="text-gray-700 mb-2">Description du projet 1</p>
                    <p class="text-gray-700 mb-2">Nombre d'investisseurs: 10</p>
                    <div class="mb-2">
                        <label class="block text-gray-700">Progression des fonds:</label>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-green-500 h-4 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-green-700 text-white p-2 rounded hover:bg-green-800 transition duration-200" aria-label="Voir Détails">Voir Détails</button>
                        <button class="bg-blue-900 text-white p-2 rounded hover:bg-blue-800 transition duration-200" aria-label="Modifier">Modifier</button>
                        <button class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition duration-200" aria-label="Suspendre">Suspendre</button>
                    </div>
                </div>
                <!-- Repeat for other projects -->
            </div>
        </section>

        <!-- Footer Section -->
        <footer class="bg-white p-4 mt-8 rounded-lg shadow-md">
            <div class="text-center">
                <p class="text-gray-700">&copy; 2023 Crowdfunding Platform. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>