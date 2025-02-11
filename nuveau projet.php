<html>
<head>
    <title>Dashboard - Agriculteur</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
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
    <div class="bg-green-600 text-white w-64 min-h-screen p-4 shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Dashboard Agriculteur</h2>
        <nav>
            <ul>
                <li class="mb-4">
                    <a href="#mes-projets" class="flex items-center p-2 hover:bg-green-700 rounded transition duration-200" aria-label="Mes Projets">
                        <i class="fas fa-project-diagram mr-2"></i> Mes Projets
                    </a>
                </li>
                <li class="mb-4">
                    <a href="#nuveau-projet" class="flex items-center p-2 hover:bg-green-700 rounded transition duration-200" aria-label="Nouveau Projet">
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
        <h1 class="text-3xl font-bold text-green-700 mb-4">Bienvenue sur le Dashboard</h1>

        <!-- Nouveau Projet Section -->
        <section id="nouveau-projet" class="mb-8">
            <h2 class="text-2xl font-bold text-green-700 mb-4">Ajouter un Nouveau Projet</h2>
            <div class="bg-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                <form action="process_project.php" method="POST">
                    <div class="mb-4">
                        <label for="projectName" class="block text-gray-700">Nom du Projet:</label>
                        <input type="text" id="projectName" name="projectName" class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="projectDescription" class="block text-gray-700">Description:</label>
                        <textarea id="projectDescription" name="projectDescription" class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-green-500" rows="4" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="fundingGoal" class="block text-gray-700">Objectif de Financement:</label>
                        <input type="text" id="fundingGoal" name="fundingGoal" class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    </div>
                    <button type="submit" class="bg-green-700 text-white p-2 rounded mt-4 hover:bg-green-800 transition duration-200">Ajouter Projet</button>
                </form>
            </div>
        </section>

    </div>

    <?php
// Database configuration
$host = 'localhost'; // Change if your database is hosted elsewhere
$dbname = 'agrofund'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $projectName = $_POST['projectName'];
        $projectDescription = $_POST['projectDescription'];
        $fundingGoal = $_POST['fundingGoal'];

        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO projects (project_name, project_description, funding_goal) VALUES (:project_name, :project_description, :funding_goal)");

        // Bind parameters
        $stmt->bindParam(':project_name', $projectName);
        $stmt->bindParam(':project_description', $projectDescription);
        $stmt->bindParam(':funding_goal', $fundingGoal);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Nouveau projet ajouté avec succès!";
        } else {
            echo "Erreur lors de l'ajout du projet.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
}
?>

</body>
</html>