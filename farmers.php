<?php
// farmers.php
session_start();
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login3.php');
    exit;
}

// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=agrofund', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . htmlspecialchars($e->getMessage()));
}

// Fetch farmers
function getFarmers($pdo) {
    $stmt = $pdo->query("SELECT * FROM farmers ORDER BY name ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$farmers = getFarmers($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <aside class="bg-green-600 text-white w-64 space-y-6 py-7 px-2">
            <div class="text-2xl font-bold text-center mb-8">AgroFund</div>
            <nav>
                <a href="dashboard.php" class="block py-2.5 px-4 rounded hover:bg-green-700">Dashboard</a>
                <a href="project.php" class="block py-2.5 px-4 rounded hover:bg-green-700">Projets</a>
                <a href="farmers.php" class="block py-2.5 px-4 rounded hover:bg-green-700">Agriculteur</a>
                <a href="transactions.php" class="block py-2.5 px-4 rounded hover:bg-green-700">Transactions</a>
                <a href="reports.php" class="block py-2.5 px-4 rounded hover:bg-green-700">Rapports</a>
                <a href="settings.php" class="block py-2.5 px-4 rounded hover:bg-green-700">Paramètres</a>
            </nav>
        </aside>

        <div class="flex-1 p-8">
            <h1 class="text-3xl font-bold mb-4">Agiculteurs</h1>
            <a href="add_farmer.php" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 mb-4">Add Farmer</a>
            <div class="bg-white rounded-lg shadow p-6">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-600 border-b">
                            <th class="pb-3">Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($farmers as $farmer): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3"><?php echo htmlspecialchars($farmer['name']); ?></td>
                            <td><?php echo htmlspecialchars($farmer['email']); ?></td>
                            <td><?php echo htmlspecialchars($farmer['phone']); ?></td>
                            <td>
                                <a href="edit_farmer.php?id=<?php echo $farmer['id']; ?>" class="text-blue-600 hover:underline">Edit</a>
                                <a href="delete_farmer.php?id=<?php echo $farmer['id']; ?>" class="text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>