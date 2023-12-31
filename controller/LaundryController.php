<?php
    require_once __DIR__ . "/../config/database.php";
    require_once __DIR__ . "/../models/Laundry.php";
    require_once __DIR__ . "/../models/Service.php";
    require_once __DIR__ . "/../utils/helper.php";

    Helper::xFrameRemove();

    Class LaundryController {
        private static $instance = null;
        private $conn;
        private function __construct() {
            $this->conn = Database::getInstance()->getConnection();
        }

        public static function getInstance() {
            if (!self::$instance) {
                self::$instance = new LaundryController();
            }
            return self::$instance;
        }

        public function getLaundry($param = '%') {
            $sql = "SELECT * FROM tenant WHERE name LIKE ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $param);
            $stmt->execute();
            $result = $stmt->get_result();
            $laundries = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $laundries[] = new Laundry($row['id'], $row['name'], $row['address'], $row['photo'], $row['phone']);
                }
            }
            return $laundries;
        }

        public function getLaundryById($id) {
            $sql = "SELECT * FROM tenant WHERE id =?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return new Laundry($row['id'], $row['name'], $row['address'], $row['photo'], $row['phone']);
            }
            return NULL;
        }

        public function getLaundryByUserId($id) {
            $sql = "SELECT * FROM tenant WHERE user_id =?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return new Laundry($row['id'], $row['name'], $row['address'], $row['photo'], $row['phone']);
            }
            return NULL;
        }

        public function getService() {
            $sql = "SELECT * FROM laundryservice";
            $result = $this->conn->query($sql);
            $services = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $services[] = new Service($row['id'], $row['servicename'], $row['serviceprice']);
                }
                return $services;
            }
            return NULL;
        }
        
        public function getServicebyName($name) {
            $sql = "SELECT * FROM laundryservice WHERE servicename=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return new Service($row['id'], $row['servicename'], $row['serviceprice']);
            }
            return NULL;
        }
    }
?>