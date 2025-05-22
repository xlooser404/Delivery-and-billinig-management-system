<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config/db.php';

// Enable MySQLi error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Sanitize function (simple fallback)
function sanitize($value) {
    return htmlspecialchars(trim($value));
}

// ADD AGENT
if (isset($_POST['add_agent'])) {
    $name       = sanitize($_POST['name']);
    $phone      = sanitize($_POST['phone']);
    $email      = sanitize($_POST['email']);
    $address    = sanitize($_POST['address']);
    $other_column = sanitize($_POST['other_column']); // Add any other column you need

    try {
        $stmt = $conn->prepare("INSERT INTO agents (name, phone, email, address, other_column, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $name, $phone, $email, $address, $other_column);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        die("Error inserting agent: " . $e->getMessage());
    }

    header("Location: ../../frontend/pages/agents.php");
    exit();
}

// UPDATE AGENT
if (isset($_POST['update_agent'])) {
    $id         = intval($_POST['id']);
    $name       = sanitize($_POST['name']);
    $phone      = sanitize($_POST['phone']);
    $email      = sanitize($_POST['email']);
    $address    = sanitize($_POST['address']);
    $other_column = sanitize($_POST['other_column']); // Add any other column you need

    try {
        $stmt = $conn->prepare("UPDATE agents SET name=?, phone=?, email=?, address=?, other_column=? WHERE id=?");
        $stmt->bind_param("sssssi", $name, $phone, $email, $address, $other_column, $id);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        die("Error updating agent: " . $e->getMessage());
    }

    header("Location: ../../frontend/pages/agents.php");
    exit();
}

// DELETE AGENT
if (isset($_POST['delete_agent'])) {
    $id = intval($_POST['id']);

    try {
        $stmt = $conn->prepare("DELETE FROM agents WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        die("Error deleting agent: " . $e->getMessage());
    }

    header("Location: ../../frontend/pages/agents.php");
    exit();
}
?>
