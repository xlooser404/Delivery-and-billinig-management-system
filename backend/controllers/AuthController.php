<?php
// controllers/AuthController.php
include('../config/db.php'); // Include your DB connection file

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=your_database_name", 'root', ''); // Replace with your actual DB credentials
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
