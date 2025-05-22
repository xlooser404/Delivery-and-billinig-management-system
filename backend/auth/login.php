<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../config/db.php'); // Ensure the path is correct
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Get user from DB
$query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    if ($user['password'] === $password) { // plain text check
        $_SESSION['user'] = $user;

        // Redirect based on role with success message
        if ($user['role'] === 'admin') {
            header("Location: ../../frontend/pages/admin_dashboard.php?success=login");
        } else if ($user['role'] === 'agent') {
            header("Location: ../../frontend/pages/agent_dashboard.html?success=login");
        } else {
            header("Location: ../../frontend/pages/login.html?error=unknown_role");
        }

        exit();
    } else {
        header("Location: ../../frontend/pages/login.html?error=invalid_password");
        exit();
    }
} else {
    header("Location: ../../frontend/pages/login.html?error=user_not_found");
    exit();
}
?>
