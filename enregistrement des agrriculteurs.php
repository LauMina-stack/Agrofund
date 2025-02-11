<html>
<head>
    <title>Farmers Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">  
</head>
<body class="bg-gray-100">
    <!-- Header Section -->
    <header class="bg-gray-700 text-white p-4">
        <div class="container mx-auto flex items-center">
            <div class="w-12 h-12 bg-gray-400 rounded-full mr-4"></div>
            <div>
                <h1 class="text-xl font-bold">Farmers Registration</h1>
                <p class="text-sm">Join our platform as a farmer</p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8 p-4">
        <div class="bg-white p-8 rounded shadow-md flex flex-col md:flex-row">
            <div class="md:w-1/2">
                <h2 class="text-2xl font-bold mb-4">Registration Form</h2>
                <p class="mb-6">Fill in your details</p>
                <form method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700">Farm Name</label>
                        <input type="text" name="Full Name" placeholder="Enter your farm's name" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="Email" placeholder="Enter your email address" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Location</label>
                        <input type="text" name="Location" placeholder="Enter your farm's location" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Password</label>
                        <input type="password" name="password" placeholder="Enter your password" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
                    <button type="submit" name="bouton1" class="bg-black text-white px-4 py-2 rounded">Register</button>
                    <div class="mb-4">
                        <label class="mb-4 text-green-700">
                            <a href="enregistrement des investissseurs.html">je suis investisseur</a>
                        </label>  
                    </div>
                </form>
            </div>
            <div class="md:w-1/2 flex justify-center items-center">
                <div class="w-64 h-64 bg-gray-200"></div>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-white mt-8 p-4">
        <div class="container mx-auto text-center">
            <div class="w-full h-32 bg-gray-200 mb-4 flex justify-center items-center">
                <p>Connect with backers and fund your farming projects</p>
            </div>
            <p class="text-gray-700">&copy; 2023 Crowdfunding Platform. All Rights Reserved.</p>
        </div>
    </footer>

   

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $Nom = filter_var(trim($_POST['Full Name']), FILTER_SANITIZE_STRING);
    $Email = filter_var(trim($_POST['Email']), FILTER_SANITIZE_EMAIL);
    $location = filter_var(trim($_POST['Location']), FILTER_SANITIZE_STRING);
    $motsdepasse = $_POST['password'];

    // Validate email
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='text-red-600'>Invalid email format.</div>";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($motsdepasse, PASSWORD_DEFAULT);
    $role = 'agriculteur';

    // Database connection
    $server = "localhost";
    $username = "root";
    $password = "";
    $db_name = "agrofund";

    $con = new mysqli($server, $username, $password, $db_name);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and execute the statement
    $stmt = $con->prepare("INSERT INTO utilisateur(nom, email, localisation, motDePasse, role) VALUES(?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $Nom, $Email, $location, $hashedPassword, $role);

    if ($stmt->execute()) {
        echo "<div class='text-green-600'>Inscription réussie</div>";
    } else {
        echo "<div class='text-red-600'>Erreur: " . $stmt->error . "</div>";
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
}
?>
</body>
</html>```php
