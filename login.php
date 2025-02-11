<html>
<head>
    <title>Login - Plateforme de Financement Participatif</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">  

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-blue-900">Bienvenue sur notre plateforme</h1>
            <p class="text-gray-600">Connectez-vous ou inscrivez-vous pour continuer</p>
        </div>
        <div class="mb-4">
            <label for="userType" class="block text-gray-700">Je suis un:</label>
            <select id="userType" class="w-full p-2 border border-gray-300 rounded mt-1">
                <option value="agriculteur">Agriculteur</option>
                <option value="investisseur">Investisseur</option>
            </select>
        </div>
        <div id="loginForm">
            <form>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" id="email" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Mot de passe:</label>
                    <input type="password" id="password" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <button type="submit" class="w-full bg-blue-900 text-white p-2 rounded mt-4">Se connecter</button>
            </form>
            <p class="text-center text-gray-600 mt-4">Pas encore de compte? <a href="#" id="showSignup" class="text-green-500">Inscrivez-vous</a></p>
        </div>
        <div id="signupForm" class="hidden">
            <form>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nom:</label>
                    <input type="text" id="name" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="emailSignup" class="block text-gray-700">Email:</label>
                    <input type="email" id="emailSignup" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <div class="mb-4">
                    <label for="passwordSignup" class="block text-gray-700">Mot de passe:</label>
                    <input type="password" id="passwordSignup" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                </div>
                <button type="submit" class="w-full bg-green-500 text-white p-2 rounded mt-4">S'inscrire</button>
            </form>
            <p class="text-center text-gray-600 mt-4">Déjà un compte? <a href="#" id="showLogin" class="text-blue-900">Connectez-vous</a></p>
        </div>
    </div>
    <script>
        document.getElementById('showSignup').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('signupForm').classList.remove('hidden');
        });

        document.getElementById('showLogin').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('signupForm').classList.add('hidden');
            document.getElementById('loginForm').classList.remove('hidden');
        });
    </script>

<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$db_name = "agrofund";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nom, email, motDePasse, role FROM utilisateur WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['motDePasse'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirection selon le rôle de l'utilisateur
            if ($user['role'] == 'agriculteur') {
                header("Location: dasbord investisseurs.php");
            } elseif ($user['role'] == 'investisseur') {
                header("Location: dashboard investissseur.php");
            } else {
                header("Location: login.php"); // Redirection par défaut
            }
            exit();
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    } else {
        $error = "Utilisateur non trouvé.";
    }
}
?>
</body>
</html>