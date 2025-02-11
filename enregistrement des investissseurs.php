<html>
<head>
    <title>Crowdfunding Platform - Growers Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">  
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-black text-white p-4 flex justify-between items-center">
        <div class="text-xl font-bold">Crowdfunding Platform</div>
        <nav class="space-x-4">
            <a class="hover:underline" href="enregistrement des investissseurs.html">Growers</a>
            <a class="hover:underline" href="#">Farmers</a>
        </nav>
    </header>
    
    <!-- Main Content -->
    <main class="bg-gray-300 p-8">
        <div class="max-w-7xl mx-auto bg-white p-8">
            <div class="flex items-center mb-8">
                <img alt="Profile image placeholder" class="rounded-full w-24 h-24 mr-4" src="https://storage.googleapis.com/a1aa/image/s1gTkkZTPoE353fEZ5D7Hx8TjXdn-_9uQMp09_Zgnmo.jpg" />
                <div>
                    <h1 class="text-2xl font-bold">Growers Registration</h1>
                    <p class="text-gray-600">Join our platform as a grower</p>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2">
                    <img alt="Placeholder image for registration" class="w-full h-auto" src="https://storage.googleapis.com/a1aa/image/_u6F57oGcD-pRxYM5VBimjCTZJ_tkJlTtB8iObnq_9Q.jpg" />
                </div>
                <div class="w-1/2 pl-8">
                    <h2 class="text-3xl font-bold mb-4">Registration Form</h2>
                    <p class="mb-4">Fill in your details</p>
                    <form method="POST">
                        <div class="mb-4">
                            <label class="block text-gray-700">Full Name</label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="Full_Name" placeholder="Enter your full name" type="text" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Email</label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="Email" placeholder="Enter your email address" type="email" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Location</label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="Location" placeholder="Enter your location" type="text" required />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Password</label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="password" placeholder="Enter your password" type="password" required />
                        </div>
                        <button class="bg-black text-white px-4 py-2 rounded" name="bouton1" type="submit">Register</button>
                        <label class="mt-4 block">
                            <a href="enregistrement des agrriculteurs.php">Je suis agriculteur</a>
                        </label>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="bg-white text-center py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-gray-200 p-8 mb-8">
                <p>Join the community of growers and start crowdfunding your projects</p>
            </div>
            <p>© 2023 Crowdfunding Platform. All Rights Reserved.</p>
        </div>
    </footer>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Nom = $_POST['Full_Name'];
        $Email = $_POST['Email'];
        $location = $_POST['Location'];
        $motsdepasse = $_POST['password'];
        $role = 'investisseur'; // Make sure to wrap in quotes

        $server = "localhost";
        $username = "root";
        $password = "";
        $db_name = "agrofund";

        $con = new mysqli($server, $username, $password, $db_name);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        if (isset($_POST['bouton1'])) {
            $stmt = $con->prepare("INSERT INTO utilisateur(nom, email, localisation, motDePasse, role) VALUES(?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $Nom, $Email, $location, $motsdepasse, $role);
            if ($stmt->execute()) {
                echo "Inscription réussie";
            } else {
                echo "Erreur: " . $stmt->error;
            }
            $stmt->close();
        }
        $con->close();
    }
    ?>
</body>
</html>