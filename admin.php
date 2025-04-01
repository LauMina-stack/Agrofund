<?php
// dashboard.php
session_start();
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login3.php');
    exit;
}

// Logout functionality
if (isset($_POST['logout'])) {
    session_destroy();
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

// Fetch data
$totalProjects = getTotalProjects($pdo);
$totalFunds = getTotalFunds($pdo);
$activeUsers = getActiveUsers($pdo);
$recentProjects = getRecentProjects($pdo);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="bg-green-600 text-white w-64 space-y-6 py-7 px-2">
            <div class="text-2xl font-bold text-center mb-8">
                AgroFund
            </div>
            
            <nav>
                <a href="#" class="block py-2.5 px-4 rounded hover:bg-green-700">Dashboard</a>
                <a href="project.php" class="block py-2.5 px-4 rounded hover:bg-green-700">Projects</a>
                <a href="farmers.php" class="block py-2.5 px-4 rounded hover:bg-green-700">Farmers</a>
                <a href="transactions.php" class="block py-2.5 px-4 rounded hover:bg-green-700">Transactions</a>
                <a href="reports.php" class="block py-2.5 px-4 rounded hover:bg-green-700">Reports</a>
                <a href="settings.php" class="block py-2.5 px-4 rounded hover:bg-green-700">Paramètres</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
                <div class="flex items-center">
                    <span class="mr-4">Bienvenue, Admin</span>
                    <form method="POST" action="">
                        <button type="submit" name="logout" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Déconnexion</button>
                    </form>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm">Total Projets</h3>
                    <p class="text-3xl font-bold"><?php echo htmlspecialchars($totalProjects); ?></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm">Funds Raised</h3>
                    <p class="text-3xl font-bold">XAF<?php echo number_format($totalFunds); ?></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm">Utilisateurs Actif</h3>
                    <p class="text-3xl font-bold"><?php echo htmlspecialchars($activeUsers); ?></p>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Recent Projets</h2>
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-600 border-b">
                            <th class="pb-3">Projet</th>
                            
                            <th>Montant</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentProjects as $project): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3"><?php echo htmlspecialchars($project['project_name']); ?></td>
                        <td>XAF<?php echo number_format($project['funding_goal']); ?></td>
                            <td>
                                <span class="px-2 py-1 text-sm rounded-full 
                                    <?php echo $project['status'] === 'Active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                                    <?php echo htmlspecialchars($project['status']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                <a href="add_project.php" class="bg-green-600 text-white p-4 rounded-lg hover:bg-green-700 text-center">Ajouter un Projet</a>
                <a href="manage_users.php" class="bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 text-center">Gérer les Utilisateurs</a>
                <a href="review_transactions.php" class="bg-yellow-600 text-white p-4 rounded-lg hover:bg-yellow-700 text-center">Voir les Transactions</a>
                <a href="update_settings.php" class="bg-purple-600 text-white p-4 rounded-lg hover:bg-purple-700 text-center">Mettre à Jour les Paramètres</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// Example database functions
function getTotalProjects($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM projects");
    return $stmt->fetchColumn();
}

function getTotalFunds($pdo) {
    $stmt = $pdo->query("SELECT SUM(current_funding) FROM projects");
    return $stmt->fetchColumn() ?: 0; // Return 0 if NULL
}

function getActiveUsers($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM utilisateur WHERE status = 'active'");
    return $stmt->fetchColumn();
}

function getRecentProjects($pdo) {
    $stmt = $pdo->query("SELECT project_name, funding_goal, status FROM projects ORDER BY created_at DESC LIMIT 5");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>