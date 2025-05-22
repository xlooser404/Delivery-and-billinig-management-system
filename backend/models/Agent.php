<?php
// backend/models/Agent.php

class Agent {
    private $conn;

    // Constructor accepts a database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to get all agents
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM agents");
        $stmt->execute();
        $result = $stmt->get_result();
        $agents = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $agents;
    }

    // Method to create a new agent
    public function create($name, $phone, $email, $address, $other_column) {
        $query = "INSERT INTO agents (name, phone, email, address, other_column) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $name, $phone, $email, $address, $other_column);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Method to update an existing agent
    public function update($id, $name, $phone, $email, $address, $other_column) {
        $query = "UPDATE agents SET name=?, phone=?, email=?, address=?, other_column=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $name, $phone, $email, $address, $other_column, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Method to delete an agent by ID
    public function delete($id) {
        $query = "DELETE FROM agents WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Method to get agent by ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM agents WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
