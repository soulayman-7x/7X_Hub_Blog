<?php

class User{
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    // ==========================================
    // 1. Register
    // ==========================================

    public function register($username, $email, $password) {
        try {
            $query = "INSERT INTO " . $this->table . " (username, email, password) 
                        VALUES (:username, :email, :password)";
            $stmt = $this->conn->prepare($query);

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);

            if($stmt->execute()) {
                return true;
            }
            return false;

        } catch(PDOException $e) {
            //die("Database Error: " . $e->getMessage());
            return false;   
        }
    }

    // ==========================================
    // 2. Login
    // ==========================================

    public function login($email, $password) {
        try {
            $query = "SELECT id, username, password, role FROM " . $this->table . " WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($password, $row['password'])) {
                    return $row;
                }
            }
            return false;
        } catch(PDOException $e) {
            return false;
        }
    }
}
?>