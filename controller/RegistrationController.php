<?php

  require_once '../config/database.php';
  require_once '../utils/encrypt.php';
  require_once '../utils/helper.php';

  Helper::xFrameRemove();

  session_start();

  Class RegistrationController {
      private static $instance = null;
      private $conn;

      private function __construct() {
          $this->conn = Database::getInstance()->getConnection();
      }

      public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new RegistrationController();
        }
        return self::$instance;
    }

      public function registerUser() {
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              $username = $_POST['username'];
              $password = $_POST['password'];
              $confirmPassword = $_POST['confirm-password'];
              $email = $_POST['email'];
              $role = $_POST['role'];

              if ($this->isDataValid($username, $password, $confirmPassword, $email, $role)) {
                  if ($this->doRegistration($username, $password, $email, $role)) {
                        $_SESSION['success_message'] =  "Registration Success!";
                        return new User($username);
                  } else {
                        $_SESSION['error'] = "Registration Failed!";
                        return false;
                  }
              } else {
                  return false;
              }
          }
      }

      private function isDataValid($username, $password, $confirmPassword, $email, $role) {
          if (empty($username) || empty($password) || empty($confirmPassword) || empty($email) || empty($role)) {
            $_SESSION['error'] = "All Field Must be Filled!";
            return false;
          }

          if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
            $_SESSION['error'] = "Username Must be Alphabet!";
            return false;
          }

          if (strlen($password) < 6) {
            $_SESSION['error'] = "Password Must be at least 6 character long!";
            return false;
          }

          if (!preg_match('/[A-Z]/', $password) ||
          !preg_match('/[a-z]/', $password) ||
          !preg_match('/[0-9]/', $password) ||
          !preg_match('/[!@#$%^&*()_+{}|:<>?~]/', $password)) {
            $_SESSION['error'] = "Password Must be at least 1 uppercase letter / Must be at least 1 special character! / Must be at least 1 number!";
            return false;
          }

          if ($password !== $confirmPassword) {
            $_SESSION['error'] = "Password Must be Match!";
            return false;
          }

          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email is Not Valid!";
            return false;
          }

          if ($role !== 'buyer' && $role !== 'seller') {
            $_SESSION['error'] = "Role is Not Valid!";
              return false;
          }

          return true;
      }

      private function doRegistration($username, $password, $email, $role) {
            $encPassword = Encrypt::encryptPassword($password);
            $query = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('ssss', $username, $encPassword, $email, $role);
            $stmt->execute();

            // die(var_dump($stmt->affected_rows));

            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
      }
  }