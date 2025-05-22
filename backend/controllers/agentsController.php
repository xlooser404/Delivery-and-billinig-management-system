// backend/controllers/agentsController.php
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Use your existing db.php connection
require_once __DIR__ . '/../config/db.php';  // This provides $conn directly

// Include Agent model
require_once __DIR__ . '/../models/Agent.php';

// Create an instance of the Agent model with existing connection
$agentModel = new Agent($conn);


// Create the database connection
$database = new Database();
$conn = $database->getConnection();

// Create an instance of the Agent model
$agentModel = new Agent($conn);

// Get the action from the form submission
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Handle actions based on form input (add, edit, delete)
if ($action == 'add') {
    // Add a new agent
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $other_column = $_POST['other_column']; // If you have another column to insert

    if ($agentModel->create($name, $phone, $email, $address, $other_column)) {
        header("Location: ../../frontend/pages/agents.php");
    }
}

if ($action == 'edit') {
    // Edit an existing agent
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $other_column = $_POST['other_column']; // If you have another column to update

    if ($agentModel->update($id, $name, $phone, $email, $address, $other_column)) {
        header("Location: ../../frontend/pages/agents.php");
    }
}

if ($action == 'delete') {
    // Delete an agent
    $id = $_POST['id'];
    if ($agentModel->delete($id)) {
        header("Location: ../../frontend/pages/agents.php");
    }
}
?>
