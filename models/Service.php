<?php
    Class Service {
        private $conn;
        private $id;
        private $service_name;
        private $service_price;

        public function __construct($id, $service_name, $service_price) {
            $this->conn = Database::getInstance()->getConnection();

            $this->id = $id;
            $this->service_name = $service_name;
            $this->service_price = $service_price;
        }

        public function getId() {
            return $this->id;
        }
        public function getServiceName() {
            return $this->service_name;
        }
        public function getServicePrice() {
            return $this->service_price;
        }
    }
?>