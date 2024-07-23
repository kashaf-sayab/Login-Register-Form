<?php
class Database {
    private static $instance = null;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "myDB";
    public $conn;

    private function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    private function __clone() {}
    public function __wakeup() {}
}
?>
