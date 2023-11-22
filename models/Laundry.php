<?php
    Class Laundry {
        private $conn;
        private $id;
        private $tenant_name;
        private $address;
        private $tenant_photo;
        private $phone;

        public function __construct($id, $tenant_name, $address, $tenant_photo, $phone) {
            $this->conn = Database::getInstance()->getConnection();

            $this->id = $id;
            $this->tenant_name = $tenant_name;
            $this->address = $address;
            $this->tenant_photo = $tenant_photo;
            $this->phone = $phone;
        }

        public function getId() {
            return $this->id;
        }
        public function getTenantName() {
            return $this->tenant_name;
        }
        public function getTenantAddress() {
            return $this->address;
        }
        public function getTenantPhoto() {
            return $this->tenant_photo;
        }
        public function getTenantPhone() {
            return $this->phone;
        }
    }
?>