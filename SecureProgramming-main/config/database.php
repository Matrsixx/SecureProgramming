<?php
    class Database {
        private static $instance = null;
        private $conn;

        private $hostname = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "dry-it";

        // Constructor dijadikan private agar koneksi hanya dibuat sekali
        private function __construct() {
            $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);

            if ($this->conn->connect_error) {
                die("Koneksi gagal: " . $this->conn->connect_error);
            }
        }

        // Method untuk mendapatkan instance koneksi
        public static function getInstance() {
            if (!self::$instance) {
                self::$instance = new Database();
            }
            return self::$instance;
        }

        // Method untuk mendapatkan koneksi
        public function getConnection() {
            return $this->conn;
        }
    }
?>