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
        public function checkMaxAttempt($ip) {
            $sql = "SELECT * FROM attempt WHERE ip = ? AND timestamp > (now() - interval 10 minute)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $ip);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows >= 5) return true;
            return false;
        }
        public function createAttempt($ip) {
            $sql = "INSERT INTO attempt (ip) VALUES (?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $ip);
            $stmt->execute();
        }
        public function captchaValidation($token) {
            $secret = $this->conn->query("SELECT value FROM secret WHERE type = 'cloudflare_secret'")->fetch_assoc()['value'];
            $data = array(
                'secret' => $secret,
                'response' => $_POST['cf-turnstile-response']
            );
            $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $responseData = json_decode($response, true);
            
            if ($responseData['success'] === true) {
                return true;
            } else {
                $_SESSION['error'] = "Captcha Validation Failed!";
                return false;
            }
        }
    }
?>	