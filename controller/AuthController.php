<?php
    require_once './../config/database.php';
    require_once './../utils/encrypt.php';

    session_start();
    
    Class AuthController {
        private static $instance = null;
        private $conn;
        private function __construct() {
            $this->conn = Database::getInstance()->getConnection();
        }
        public static function getInstance() {
            if (!self::$instance) {
                self::$instance = new AuthController();
            }
            return self::$instance;
        }
        public function userLogin($username, $password) {
            if (empty($username)) {
                $_SESSION['error'] = "Username can't be empty!";
                return false;
            } else if (empty($password)) {
                $_SESSION['error'] = "Password can't be empty!";
                return false;
            } else if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
                $_SESSION['error'] = "Username Must be Alphabet!";
                return false;
            } else {
                $user = new User($username);
                if ($user->getId()) {
                    if (Encrypt::verifyPassword($password, $user->getPassword())) {
                        return $user;
                    }
                }
                return false;
            }
        }
    }
?>	