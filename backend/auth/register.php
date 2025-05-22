<?php

include('../config/db.php');  // Make sure path is correct

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // still plain
    $role = $_POST['role'];

    // Check if user/email exists
    $checkQuery = "SELECT * FROM users WHERE email = '$email' OR name = '$name'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Redirect back with error
        header("Location: ../../frontend/pages/register.html?error=exists");
        exit();
    } else {
        $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
        
        if (mysqli_query($conn, $query)) {
            // Redirect to login with success
            header("Location: ../../frontend/pages/login.html?success=registered");
            exit();
        } else {
            // Redirect back with DB error
            header("Location: ../../frontend/pages/register.html?error=db");
            exit();
        }
    }
}
?>
