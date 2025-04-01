<?php
session_start(); // Start the session

function handleWhatsAppPay() {
    $stripeLink = "https://buy.stripe.com/test_aEU7vqeRmbDs7ss7ss";
    $message = "Je voudrais effectuer un payment: " . $stripeLink;
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
    <title>Projets - Faire un Investissement</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 p-6">
    <section class="donate-relative mt-6">
        <h1 class="text-3xl font-bold text-green-700 mb-4">Investir</h1>
        <div class="payment-options grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="container1 mb-4">
                <a href="https://buy.stripe.com/test_aEU7vqeRmbDs7ss7ss" target="_blank" rel="noopener noreferrer"
                 class="bg-green-600 text-white p-4 rounded-lg shadow hover:bg-green-700 transition duration-200 flex items-center justify-center">
                    <span class="font-semibold">Effectuer un paiement</span>
                    <i class="fas fa-credit-card ml-2"></i> <!-- Font Awesome icon -->
                </a>
            </div>
            <div class="container2">
                <form method="POST">
                    <button type="submit" name="whatsappPay" class="bg-blue-600 text-white p-4 rounded-lg shadow hover:bg-blue-700 transition duration-200 flex items-center justify-center">
                        <img src="./whatsapp.png" alt="WhatsApp" class="mr-2" />
                        <span class="font-semibold">Via WhatsApp</span>
                    </button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>