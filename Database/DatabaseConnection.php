<?php
require_once __DIR__ . '/../config.php';

class DatabaseConnection {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $this->conn = new PDO(
            "mysql:host=".DB_HOST.";dbname=".DB_NAME,
            DB_USER,
            DB_PASS
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}