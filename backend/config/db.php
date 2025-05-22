// backend/config/Database.php
<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "thenuka_db";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch(Exception $exception) {
            error_log("Database error: " . $exception->getMessage());
            throw $exception; // Re-throw for controller to handle
        }
        
        return $this->conn;
    }
}