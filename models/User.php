<?php
    Class User {
        private $conn;
        private $id;
        private $username;
        private $email;
        private $role;

        public function __construct($username, $password) {
            $this->conn = Database::getInstance()->getConnection();

            $password = Encrypt::encryptPassword($password);
            $query = "SELECT * FROM users WHERE username=? AND password=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->email = $row['email'];
                $this->role = $row['role'];
            } else {
                $this->id = NULL;
            }
        }

        public function getId() {
            return $this->id;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getRole() {
            return $this->role;
        }

        public function getUser() {
            return $this->id ? $this : NULL;
        }
    }
?>