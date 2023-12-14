<?php

  require_once '../config/database.php';
  require_once '../utils/encrypt.php';
  require_once '../utils/helper.php';

  Helper::xFrameRemove();

  session_start();

  Class RegistrationTenantController {
      private static $instance = null;
      private $conn;

      private function __construct() {
          $this->conn = Database::getInstance()->getConnection();
      }

      public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new RegistrationTenantController();
        }
        return self::$instance;
    }

      public function registerTenant() {
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              $token = $_SESSION['token'];
              $decodedToken = Encrypt::decodeJWT($token);
              $user = new User($decodedToken->username);

              $tenantName = $_POST['tenant-name'];
              $tenantAddress = Helper::stripTags($_POST['tenant-address']);
              $tenantPhone = $_POST['tenant-phone'];
              $tenantPhoto = $_FILES['tenant-photo'];
              $tenantPhoto['name'] = Helper::stripTags($tenantPhoto['name']);

              $registeredTenant = $this->isDataValid($tenantName, $tenantAddress, $tenantPhone, $tenantPhoto);
              if ($registeredTenant) {
                  if ($this->doRegistrationTenant($tenantName, $tenantAddress, $tenantPhone, $registeredTenant, $user->getId())) {
                        $_SESSION['success_message'] =  "Registration Tenant Success!";
                        return true;
                  } else {
                        $_SESSION['error'] = "Registration Tenant Failed!";
                        return false;
                  }
              } else {
                  return false;
              }
          }
      }

      private function isDataValid($tenantName, $tenantAddress, $tenantPhone, $tenantPhoto) {
          if ($this->isTenantNameTaken($tenantName)) {
            $_SESSION['error'] = "Tenant Name is already taken!";
            return false;
          }
          if (empty($tenantName) || empty($tenantAddress) || empty($tenantPhone) || empty($tenantPhoto)) {
            $_SESSION['error'] = "All Field Must be Filled!";
            return false;
          }

          if (!preg_match("/^[a-zA-Z ]*$/", $tenantName)) {
            $_SESSION['error'] = "Tenant Name Must be Alphabet!";
            return false;
          }

          if (!preg_match("/^[0-9 ]*$/", $tenantPhone)) {
            $_SESSION['error'] = "Tenant Phone Must be Numeric!";
            return false;
          }

          if ($tenantPhoto['size'] > 0) {
            if ($tenantPhoto['size'] > 10 * 1000 * 1000) {
              $_SESSION['error'] = "File is too big!";
              return false;
            } 

            $allowed_extensions = ["image/gif", "image/jpeg", "image/jpg", "image/png"];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $tenantPhoto['tmp_name']);
            
            if (!in_array($mime, $allowed_extensions)) {
              $_SESSION['error'] = "File type not allowed!";
              return false;
            }
    
            finfo_close($finfo);

            $allowed_name_extensions = ["jpg", "jpeg", "png", "gif", "JPG", "JPEG", "PNG", "GIF"]; 

            $fileName = explode(".", $tenantPhoto['name']);
            
            if (!in_array(end($fileName), $allowed_name_extensions)) {
              $_SESSION['error'] = "File name not allowed!";
              return false;
            }

            if (!in_array($tenantPhoto['type'], $allowed_extensions)) {
              $_SESSION['error'] = "File type not allowed!";
              return false;
            }

            if (strpos($tenantPhoto['name'], '/') !== false) {
              $_SESSION['error'] = "File name not allowed!";
              return false;
          }
      
            $target_directory = "../storage/";
      
            // <random code>_<filename>.<extension>
            $new_file_name = uniqid() . "_" . $tenantPhoto['name'];
      
            if (move_uploaded_file($tenantPhoto['tmp_name'], $target_directory . $new_file_name)) {
              $_SESSION['success_message'] = "File uploaded!";
              return $new_file_name;
            } else {
              $_SESSION['error'] = "File failed to upload!";
              return false;
            }
          } else {
            $_SESSION['error'] = "Photo must be uploaded with size more than 0!";
            return false;
          }
      }
      private function isTenantNameTaken($tenantName) {
        $stmt = $this->conn->prepare("SELECT id FROM tenant WHERE name = ?");
        $stmt->bind_param("s", $tenantName);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        $stmt->close();

        return $count > 0;
    }

      private function doRegistrationTenant($tenantName, $tenantAddress, $tenantPhone, $photoName, $userId) {
            $query = "INSERT INTO tenant (user_id, name, address, photo, phone) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('issss', $userId, $tenantName, $tenantAddress, $photoName, $tenantPhone);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
      }
  }