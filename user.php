<?php
require_once 'Database.php';

class User {
    private $db;

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->conn;
    }


    public function register($username, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('sss', $username, $email, $passwordHash);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    public function login($identifier, $password) {
        $stmt = $this->db->prepare("SELECT username, password FROM users WHERE username = ? OR email = ?");
        if ($stmt) {
            $stmt->bind_param('ss', $identifier, $identifier);
            $stmt->execute();
            $stmt->bind_result($username, $passwordHash);
            $stmt->fetch();
            if (password_verify($password, $passwordHash)) {
                return $username;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function checkEmailExists($email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
            return $count > 0;
        } else {
            return false;
        }
    }
}
?>
