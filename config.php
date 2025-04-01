<?php
// config.php

 
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'agrofund'); 
define('DB_USER', 'root'); 
define('DB_PASS', ''); 

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Database connection failed: " . $e->getMessage());
}

/* Optional: Set the default timezone
date_default_timezone_set('GMT + 1'); */

// Optional: Define a function to check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}



// Optional: Define a function to get the current user's username
function getCurrentUsername() {
    return $_SESSION['username'] ?? null;
}
?>