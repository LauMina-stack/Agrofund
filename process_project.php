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
        // Get the form data and sanitize it
        $projectName = trim($_POST['projectName']);
        $projectDescription = trim($_POST['projectDescription']);
        $fundingGoal = trim($_POST['fundingGoal']);

        // Validate the funding goal to ensure it's a valid number
        if (!is_numeric($fundingGoal) || $fundingGoal < 0) {
            echo "L'objectif de financement doit être un nombre positif.";
            exit;
        }

        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO projects (project_name, project_description, funding_goal) VALUES (:project_name, :project_description, :funding_goal)");

        // Bind parameters
        $stmt->bindParam(':project_name', $projectName);
        $stmt->bindParam(':project_description', $projectDescription);
        $stmt->bindParam(':funding_goal', $fundingGoal);

        // Execute the statement
       // if ($stmt->execute()) {
          //  echo "Nouveau projet ajouté avec succès!";
      //  } else {
        //    echo "Erreur lors de l'ajout du projet.";
       // }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
}

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all projects from the database
    $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
    exit;
}try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all projects from the database
    $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
    exit;
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
        .description {
            max-height: 4.5em; /* Adjust this value to control how much text is visible */
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        .description.expanded {
            max-height: 100em; /* Allow full height when expanded */
        }
    </style>
    <script>
        function toggleDescription(id) {
            const description = document.getElementById(id);
            description.classList.toggle('expanded');
            const button = document.getElementById('toggle-button-' + id);
            button.textContent = description.classList.contains('expanded') ? 'Lire moins' : 'Lire plus';
        }
    </script>
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
  

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold text-green-700 mb-4">Mes Projets</h1>

        <!-- Projects List -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (count($projects) > 0): ?>
                <?php foreach ($projects as $project): ?>
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-bold text-green-700 mb-2"><?php echo htmlspecialchars($project['project_name']); ?></h2>
                        <p class="description" id="description-<?php echo htmlspecialchars($project['id']); ?>">
                            <?php echo nl2br(htmlspecialchars($project['project_description'])); ?>
                        </p>
                        <button id="toggle-button-description-<?php echo htmlspecialchars($project['id']); ?>" 
                                class="text-blue-500 underline mt-2" 
                                onclick="toggleDescription('description-<?php echo htmlspecialchars($project['id']); ?>')">
                            Lire plus
                        </button>
                        <p class="text-gray-700 mb-2"><strong>Objectif de Financement:</strong> <?php echo htmlspecialchars($project['funding_goal']); ?> XAF</p>
                        <p class="text-gray-700 mb-4"><strong>Date de Création:</strong> <?php echo htmlspecialchars($project['created_at']); ?></p>
                        <a href="project_details.php?id=<?php echo htmlspecialchars($project['id']); ?>" class="bg-green-600 text-white p-2 rounded hover:bg-green-700 transition duration-200">Voir Détails</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-700">Aucun projet enregistré.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>