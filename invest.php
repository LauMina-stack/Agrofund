<?php
session_start();

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
<nav class="flex items-center justify-between flex-wrap bg-green-500 p-6 fixed w-full z-10">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <a href="landing page.php" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" stroke="currentColor" 
            stroke-linecap="round" stroke-linejoin="round" stroke-width="3" aria-hidden="false" class="me-2" viewBox="0 0 640 512">
              <path d="M272.2 64.6l-51.1 51.1c-15.3 4.2-29.5 11.9-41.5 22.5L153 161.9C142.8 171 129.5 176 115.8 176H96V304c20.4 .6 
              39.8 8.9 54.3 23.4l35.6 35.6 7 7 0 0L219.9 397c6.2 6.2 16.4 6.2 22.6 0c1.7-1.7 3-3.7 3.7-5.8c2.8-7.7 9.3-13.5 17.3-15.3s16.4 .6 
              22.2 6.5L296.5 393c11.6 11.6 30.4 11.6 41.9 0c5.4-5.4 8.3-12.3 8.6-19.4c.4-8.8 5.6-16.6 13.6-20.4s17.3-3 24.4 2.1c9.4 6.7 22.5 5.8 
              30.9-2.6c9.4-9.4 9.4-24.6 0-33.9L340.1 243l- 35.8 33c-27.3 25.2-69.2 25.6-97 .9c-31.7-28.2-32.4-77.4-1.6-106.5l70.1-66.2C303.2 78.4 
              339.4 64 377.1 64c36.1 0 71 13.3 97.9 37.2L505.1 128H544h40 40c8.8 0 16 7.2 16 16V352c0 17.7-14.3 32-32 32H576c -11.8 0-22.2-6.4- 27.7-16H463.4c-3.4 6.7-7.9 13.1-13.5 18.7c-17.1 17.1-40.8 23.8-63 20.1c-3.6 7.3-8.5 14.1-14.6 20.2c-27. 3 27.3-70 30-100.4 8.1c-25.1 20.8-62.5 19.5-86-4.1L159 404l-7-7-35.6-35.6c-5.5-5.5-12.7-8.7-20.4-9.3C96 369.7 81.6 384 64 384H32c-17.7 0-32-14.3-32-32V144c0-8.8 7.2-16 16-16H56 96h19.8c2 0 3.9-.7 5.3-2l26.5-23.6C175.5  77.7 211.4 64 248.7 64H259c4.4 0 8.9 .2 13.2 .6zM544 320V176H496c-5.9 0-11.6-2.2-15.9-6.1l-36.9-32.8c-18.2-16.2-41.7-25.1-66.1-25.1c-25.4 0-49.8 9.7-68.3 27.1l-70.1 66.2c-10.3 9.8-10.1 26.3 .5 35.7c9.3 8.3 23.4 8.1 32.5-.3l71.9-66.4c9.7-9 24.9-8.4 33.9 1.4s8.4 24.9-1.4 33.9l-.8 .8 74.4 74.4c10 10 16.5 22.3 19.4 35.1H544zM64 336a16 16 0 1 0 -32 0 16 16 0 1 0 32 0zm528 16a16 16 0 1 0 0-32 16 16 0 1 0 0 32z"/></svg>
            <strong class="text-white">AgroFund</strong>
        </a>
    </div>
    <div class="block lg:hidden">
        <button class="flex items-center px-3 py-2 border rounded text-white border-white hover:text-green-600 hover:border-green-600">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0v-2zm0 6h20v2H0v-2z"/></svg>
        </button>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
            <a href="project.php" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-green-200 mr-4" onclick="checkAuth('project.php')">Projet</a>
            <a href="dashboard.php" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-green-200 mr-4" onclick="checkAuth('signup.php')">Dashboard</a>
        </div>
    </div>
</nav>
<br>
<br>
<br>

<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-4xl font-bold text-green-700 mb-4 text-center">
        <?php echo htmlspecialchars($project['project_name']); ?>
    </h1>

    <div class="mb-4 text-center">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($project['image']); ?>" alt="Project Image" class="w-full h-64 object-cover rounded-md">
    </div>

    <p class="text-black mb-4 text-center">
        <?php echo nl2br(htmlspecialchars($project['project_description'])); ?>
    </p>
    <p class="text-black mb-4 text-center">
        <strong>Objectif de Financement:</strong> 
        <?php echo htmlspecialchars($project['funding_goal']); ?> XAF
    </p>

    <p class="text-gray-700 mb-4 text-center"><strong>Date de Création:</strong>
     <?php echo htmlspecialchars($project['created_at']); ?>
    </p>

    <p class="text-gray-700 mb-4 text-center"><strong>Documents:</strong>
        <a href="uploads/<?php echo htmlspecialchars($project['document']); ?>" class="text-blue-500 underline" download>Télécharger le document</a>
    </p>

    <h2 class="text-3xl font-bold text-green-700 mb-4 text-center">Investir dans ce projet</h2>
    
    <div class="flex justify-center space-x-4">
        <a href="donate.php?project_id=<?php echo htmlspecialchars($project['id']); ?>" class="bg-green-700 text-white p-2 rounded hover:bg-green-800 transition duration-200">Investir via un service externe</a>
        <a href="invest.php?project_id=<?php echo htmlspecialchars($project['id']); ?>" class="bg-green-700 text-white p-2 rounded hover:bg-green-800 transition duration-200">Investir</a>
    </div>
</div>
</body>
</html>