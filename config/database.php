<?php

$host = 'localhost';
$user = 'monika';
$pass = 'Scanner@786';
$db = 'portfolio_db';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If connection is successful, show a success message
    // echo "Database connected successfully!";
} catch (PDOException $e) {
    // Handle connection error
    die("Error connecting to the database: " . $e->getMessage());
}

?>
