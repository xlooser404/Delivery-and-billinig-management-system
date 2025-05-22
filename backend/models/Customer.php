<?php
// backend/models/Customer.php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

class Customer {
    private $conn;
    private $table = 'customers';

    public $id;
    public $name;
    public $store_name;
    public $email;
    public $phone;
    public $address;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all customers
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get single customer
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }

    // Create customer
    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  SET name = :name, store_name = :store_name, 
                      email = :email, phone = :phone, address = :address";
        
        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->store_name = htmlspecialchars(strip_tags($this->store_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->address = htmlspecialchars(strip_tags($this->address));

        // Bind parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':store_name', $this->store_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':address', $this->address);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update customer
    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET name = :name, store_name = :store_name, 
                      email = :email, phone = :phone, address = :address
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->store_name = htmlspecialchars(strip_tags($this->store_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->address = htmlspecialchars(strip_tags($this->address));

        // Bind parameters
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':store_name', $this->store_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':address', $this->address);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete customer
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>