<?php
// backend/controllers/customersController.php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once '../config/db.php';
require_once '../models/Customer.php';

try {
    // Initialize Customer model
    $customer = new Customer($conn);

    // Handle add customer
    if(isset($_POST['add_customer'])) {
        $customer->name = $_POST['name'] ?? '';
        $customer->store_name = $_POST['store_name'] ?? '';
        $customer->email = $_POST['email'] ?? '';
        $customer->phone = $_POST['phone'] ?? '';
        $customer->address = $_POST['address'] ?? '';

        if($customer->create()) {
            $_SESSION['success'] = "Customer added successfully";
        } else {
            $_SESSION['error'] = "Failed to add customer";
        }
        header("Location: http://localhost/deliverymgmtsys/frontend/pages/customers.php");
        exit();
    }

    // Handle update customer
    if(isset($_POST['update_customer'])) {
        $customer->id = $_POST['id'] ?? '';
        $customer->name = $_POST['name'] ?? '';
        $customer->store_name = $_POST['store_name'] ?? '';
        $customer->email = $_POST['email'] ?? '';
        $customer->phone = $_POST['phone'] ?? '';
        $customer->address = $_POST['address'] ?? '';

        if($customer->update()) {
            $_SESSION['success'] = "Customer updated successfully";
        } else {
            $_SESSION['error'] = "Failed to update customer";
        }
        header("Location: http://localhost/deliverymgmtsys/frontend/pages/customers.php");
        exit();
    }

    // Handle delete customer
    if(isset($_POST['delete_customer'])) {
        $customer->id = $_POST['id'] ?? '';

        if($customer->delete()) {
            $_SESSION['success'] = "Customer deleted successfully";
        } else {
            $_SESSION['error'] = "Failed to delete customer";
        }
        header("Location: http://localhost/deliverymgmtsys/frontend/pages/customers.php");
        exit();
    }

} catch (Exception $e) {
    // Log the error and show a generic message
    error_log($e->getMessage());
    $_SESSION['error'] = "An error occurred while processing your request";
    header("Location: http://localhost/deliverymgmtsys/frontend/pages/customers.php");
    exit();
}