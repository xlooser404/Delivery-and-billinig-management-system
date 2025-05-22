<?php
// models/User.php

class User {
    private $pdo;

    // Pass PDO connection into the constructor
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
