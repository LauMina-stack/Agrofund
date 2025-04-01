<?php
session_start();

// Database configuration
$host = 'localhost'; // Change if your database is hosted elsewhere
$dbname = 'agrofund'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the project ID is provided
    if (isset($_GET['id'])) {
        $projectId = intval($_GET['id']);

        // Fetch the project details from the database
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = :id");
        $stmt->bindParam(':id', $projectId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $project = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Projet non trouvé.";
            exit();
        }
    } else {
        echo "ID de projet manquant.";
        exit();
    }

    // Handle form submission for funding
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the investment amount and sanitize it
        $investmentAmount = trim($_POST['investmentAmount']);

        // Validate the investment amount to ensure it's a valid number
        if (!is_numeric($investmentAmount) || $investmentAmount <= 0) {
            $error = "Le montant de l'investissement doit être un nombre positif.";
        } else {
            // Update the current funding in the database
            $newFunding = $project['current_funding'] + $investmentAmount;

            // Check if the new funding exceeds the funding goal
            if ($newFunding > $project['funding_goal']) {
                $error = "L'investissement dépasse l'objectif de financement.";
            } else {
                $stmt = $pdo->prepare("UPDATE projects SET current_funding = :current_funding WHERE id = :id");
                $stmt->bindParam(':current_funding', $newFunding);
                $stmt->bindParam(':id', $projectId);

                // Execute the statement
                if ($stmt->execute()) {
                    $success = "Investissement ajouté avec succès!";
                    // Optionally redirect to another page
                    // header("Location: view_projects.php");
                    // exit();
                } else {
                    $error = "Erreur lors de l'ajout de l'investissement.";
                }
            }
        }
    }
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
    <title>Investir dans le Projet - Dashboard Agriculteur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-green-700">Investir dans le Projet</h1>
            <p class="text-gray-600">Projet: <?php echo htmlspecialchars($project['project_name']); ?></p>
        </div>

        <?php if (isset($error)): ?>
            <div class="mb-4 text-red-600 text-center"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="mb-4 text-green-600 text-center"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label for="investmentAmount" class="block text-gray-700">Montant de l'Investissement:</label>
                <input type="number" id="investmentAmount" name="investmentAmount" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="w-full bg-green-600 text-white font-bold py-2 rounded hover:bg-green-700">Investir</button>
            </div>
        </form>
    </div>
</body>
</html>