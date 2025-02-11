<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Sample details array (you would typically fetch this from a database)
$details = [
    [
        'key' => 1,
        'src' => 'path/to/image1.jpg',
        'alt' => 'Image 1',
        'heading' => 'Projet 1',
        'personName' => 'Agriculteur 1',
        'fundDetails' => 'Détails de financement 1',
    ],
    [
        'key' => 2,
        'src' => 'path/to/image2.jpg',
        'alt' => 'Image 2',
        'heading' => 'Projet 2',
        'personName' => 'Agriculteur 2',
        'fundDetails' => 'Détails de financement 2',
    ],
    // Add more projects as needed
];

function handleWhatsAppPay() {
    $stripeLink = "https://buy.stripe.com/test_aEU7vqeRmbDs7ss7ss";
    $message = "Je voudrais effectuer un payement: " . $stripeLink;
    $encodedMessage = urlencode($message);
    $whatsappLink = "https://wa.me/?text=" . $encodedMessage;
    echo "<script>window.open('$whatsappLink');</script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['whatsappPay'])) {
    handleWhatsAppPay();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets - Faire un Don</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-3xl font-bold mb-4">Projets</h1>

    <div class="search mb-4">
        <input type="text" placeholder="Rechercher un agriculteur.." class="p-2 border border-gray-300 rounded" />
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($details as $item): ?>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <img src="<?php echo htmlspecialchars($item['src']); ?>" alt="<?php echo htmlspecialchars($item['alt']); ?>" class="mb-4" />
                <h2 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($item['heading']); ?></h2>
                <p class="mb-2"><strong>Nom:</strong> <?php echo htmlspecialchars($item['personName']); ?></p>
                <p class="mb-2"><strong>Détails de Financement:</strong> <?php echo htmlspecialchars($item['fundDetails']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <section class="donate-relative mt-6">
        <div class="payment-options">
            <div class="container1 mb-4">
                <a href="https://buy.stripe.com/test_aEU7vqeRmbDs7ss7ss" target="_blank" rel="noopener noreferrer" class="bg-green-600 text-white p-3 rounded hover:bg-green-700 transition duration-200">Effectuer un payement</a>
            </div>
            <div class="container2">
                <form method="POST">
                    <button type="submit" name="whatsappPay" class="bg-blue-600 text-white p-3 rounded hover:bg-blue-700 transition duration-200">
                        <div class="flex items-center">
                            <img src="./whatsapp.png" alt="WhatsApp" class="mr-2" />
                            <span>Via WhatsApp</span>
                        </div>
                    </button>
                </form>
 </div>
        </div>
    </section>
</body>
</html>