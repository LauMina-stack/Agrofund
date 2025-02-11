<?php
session_start(); // Start the session


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