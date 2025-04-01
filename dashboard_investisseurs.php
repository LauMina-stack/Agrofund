<?php
session_start();

// Database configuration
$host = 'localhost'; // Change if your database is hosted elsewhere
$dbname = 'agrofund'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

// Check if user is logged in
if (!isset($_SESSION['user_id'])) { // Ensure you are checking the correct session variable
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch projects created by the logged-in user
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in session
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = :user_id"); // Use user_id to filter projects
    $stmt->bindParam(':user_id', $userId); // Bind the correct variable
    $stmt->execute();

    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Projets - Dashboard Agriculteur</title>
    
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
    <div class="bg-green-500 text-white w-64 min-h-screen p-4 shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Dashboard Agriculteur</h2>
        <nav>
            <ul>
                <li class="mb-4">
                    <a href="dashboard_investisseurs.php" class="flex items-center p-2 hover:bg-green-700 rounded transition duration-200" aria-label="Mes Projets">
                        <i class="fas fa-project-diagram mr-2"></i> Mes Projets
                    </a>
                </li>
                <li class="mb-4">
                    <a href="nuveau projet.php" class="flex items-center p-2 hover:bg-green-700 rounded transition duration-200" aria-label="Nouveau Projet">
                        <i class="fas fa-plus mr-2"></i> Nouveau Projet
                    </a>
                </li>
                <li class="mb-4">
                    <a href="suspend_project.php" class="flex items-center p-2 hover:bg-green-700 rounded transition duration-200" aria-label="Suspendre Projet">
                        <i class="fas fa-times mr-2"></i> Suspendre Projet
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold text-green-700 mb-4">Mes Projets</h1>

        <?php if (count($projects) > 0): ?>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-green-700 mb-4">Projets Crée</h2>
                <ul>
                    <?php foreach ($projects as $project): ?>
                        <li class="mb-4 p-4 border border-gray-300 rounded">
                            <h3 class="text-xl font-semibold"><?php echo htmlspecialchars($project['project_name']); ?></h3>
                            <p class="text-gray-600"><?php echo htmlspecialchars($project['project_description']); ?></p>
                            <p class="text-gray-800 font-bold">Objectif de Financement: <?php echo htmlspecialchars($project['funding_goal']); ?> XAF</p>
                            <p class="text-gray-500">Statut: <?php echo htmlspecialchars($project['status']); ?></p>
                            <a href="suspend_project.php?id=<?php echo $project['id']; ?>" class="text-red-600 hover:underline">Suspendre le projet</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <p class="text-gray-600">Aucun projet trouvé.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>