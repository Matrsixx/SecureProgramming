<?php

  require_once './../config/database.php';
  require_once './../utils/encrypt.php';
  require_once './../utils/helper.php';

  Helper::xFrameRemove();

  session_start();

  Class ProfileController {
    private static $instance = null;
        private $conn;
        private function __construct() {
            $this->conn = Database::getInstance()->getConnection();
        }

        public static function getInstance() {
            if (!self::$instance) {
                self::$instance = new ProfileController();
            }
            return self::$instance;
        }

        public function uploadProfilePhoto() {
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              $token = $_SESSION['token'];
              $decodedToken = Encrypt::decodeJWT($token);
              $user = new User($decodedToken->username);

              $profilePhoto = $_FILES['profile-photo'];

              $checkPhoto = $this->isDataValid($profilePhoto);
              if ($checkPhoto) {
                  if ($this->doUploadProfilePhoto($checkPhoto, $user->getId())) {
                        $_SESSION['success_message'] =  "Profile Picture Updated!";
                        return true;
                  } else {
                        $_SESSION['error'] = "Profile Picture Update Failed!";
                        return false;
                  }
              } else {
                  return false;
              }
          }
      }

      private function isDataValid($profilePhoto) {
        if ($profilePhoto['size'] > 0) {
          $allowed_extensions = ["image/gif", "image/jpeg", "image/jpg", "image/png"];

          $finfo = finfo_open(FILEINFO_MIME_TYPE);
          $mime = finfo_file($finfo, $profilePhoto['tmp_name']);
          
          if (!in_array($mime, $allowed_extensions)) {
            $_SESSION['error'] = "File type not allowed!";
            return false;
          }
   
          finfo_close($finfo);
        
          if ($profilePhoto['size'] > 10 * 1000 * 1000) {
            $_SESSION['error'] = "File is too big!";
            return false;
          }

          $allowed_name_extensions = ["jpg", "jpeg", "png", "gif", "JPG", "JPEG", "PNG", "GIF"]; 

          $fileName = explode(".", $profilePhoto['name']);
          
          if (!in_array(end($fileName), $allowed_name_extensions)) {
            $_SESSION['error'] = "File name not allowed!";
            return false;
          }

          if (!in_array($profilePhoto['type'], $allowed_extensions)) {
            $_SESSION['error'] = "File type not allowed!";
            return false;
          }

          if (strpos($profilePhoto['name'], '/') !== false) {
            $_SESSION['error'] = "File name not allowed!";
            return false;
        }
          
    
          $target_directory = "../storage/";
    
          // <random code>_<filename>.<extension>
          $new_file_name = uniqid() . "_" . $profilePhoto['name'];
    
          if (move_uploaded_file($profilePhoto['tmp_name'], $target_directory . $new_file_name)) {
            $_SESSION['success_message'] = "File uploaded!";
            return $new_file_name;
          } else {
            $_SESSION['error'] = "File failed to upload!";
            return false;
          }
        }
    }
    
      private function doUploadProfilePhoto($profilePhoto, $userId) {
          $query = "UPDATE users SET Photo = ? WHERE id = ?";
          $stmt = $this->conn->prepare($query);
          $stmt->bind_param('si', $profilePhoto, $userId);
          $stmt->execute();

          if ($stmt->affected_rows > 0) {
              return true;
          } else {
              return false;
          }
      }
  }