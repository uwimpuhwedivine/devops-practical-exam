<?php
class Database {
    private $host = "25RP20136_db";
    private $db_name = "25RP20136_shareride_db";
    private $username = "root";
    private $password = "password";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

// Create database and table if not exists
function setupDatabase() {
    try {
        $temp_conn = new PDO("mysql:host=25RP20136_db", "root", "password");
        $temp_conn->exec("CREATE DATABASE IF NOT EXISTS 25RP20136_shareride_db");
        $temp_conn->exec("USE 25RP20136_shareride_db");
        
        $sql = "CREATE TABLE IF NOT EXISTS tbl_users (
            user_id INT AUTO_INCREMENT PRIMARY KEY,
            user_firstname VARCHAR(50) NOT NULL,
            user_lastname VARCHAR(50) NOT NULL,
            user_gender VARCHAR(10) NOT NULL,
            user_email VARCHAR(100) UNIQUE NOT NULL,
            user_password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        $temp_conn->exec($sql);
    } catch(PDOException $e) {
        // Silently fail - database will be created when accessed
    }
}

// Run setup
setupDatabase();
?> 