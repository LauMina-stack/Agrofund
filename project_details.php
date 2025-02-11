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

    // Fetch project details based on the project ID passed in the URL
    if (isset($_GET['id'])) {
        $projectId = intval($_GET['id']);
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = :id");
        $stmt->bindParam(':id', $projectId);
        $stmt->execute();
        $project = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Aucun projet trouvé.";
        exit;
    }
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
    <title>Détails du Projet - <?php echo htmlspecialchars($project['project_name']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-green-700 mb-4"><?php echo htmlspecialchars($project['project_name']); ?></h1>
        <p class="text-gray-700 mb-4"><?php echo nl2br(htmlspecialchars($project['project_description'])); ?></p>
        <p class="text-gray-700 mb-4"><strong>Objectif de Financement:</strong> <?php echo htmlspecialchars($project['funding_goal']); ?> XAF</p>
        <p class="text-gray-700 mb-4"><strong>Date de Création:</strong> <?php echo htmlspecialchars($project['created_at']); ?></p>

        <h2 class="text-2xl font-bold text-green-700 mb-4">Investir dans ce projet</h2>
        <form action="invest.php" method="POST">
            <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($project['id']); ?>">
            <div class="mb-4">
                <label for="investmentAmount" class="block text-gray-700">Montant à investir:</label>
                <input type="number" id="investmentAmount" name="investmentAmount" class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>
            <a href="donate.php?project_id=<?php echo htmlspecialchars($project['id']); ?>" class="bg-green-700 text-white p-2 rounded mt-4 hover:bg-green-800 transition duration-200">Investir</a>
        </form>
    </div>
</body>
</html>