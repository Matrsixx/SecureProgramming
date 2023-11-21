<?php
    require_once '../config/database.php';
    require_once '../utils/encrypt.php';

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
                $username = $_POST['username'];
                $password = $_POST['password'];
                $user = new User($username, $password);
                if ($user->getId()) return $user;
                return false;
            }
        }
    }

    // $usernameerror = " ";
    // $passerror = " ";
    // $confirmpasserror = " ";
    // $emailerror = " ";
    // $submitsuccess = " ";

    // if(isset($_POST['submit'])){   

    //     $username = $_POST['username'];
    //     if(strlen($username) < 5 || !preg_match("/^[a-zA-Z ]*$/", $username) || empty($username)){
    //         $usernameerror = "Username minimal 5 character AND only alphabet AND not empty";
    //     }

    //     $pass = $_POST['password'];
    //     if(empty($pass) || strlen($pass) < 6 ){
    //         $passerror = "Password minimal 6 character AND not empty";
    //     }

    //     $confirmpass = $_POST['confirmpassword'];
    //     if(empty($pass) || $pass != $confirmpass){
    //         $confirmpasserror = "Password must match AND not empty";
    //     }

    //     $email = $_POST['email'];
    //     $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    //     if(!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)){
    //         $emailerror = "Email must valid AND not empty";
    //     }    
        
    //     if($emailerror == " " && $usernameerror == " " && $passerror == " " && $confirmpasserror == " "){
    //         $hash = "$2y$10$";
    //         $salt = "iusesomecrazystrings22";
    //         $combine = $hash . $salt;
    //         $pass = crypt($pass, $combine);

    //         $query = "INSERT INTO users(id,username,password,email) VALUES (NULL, '$username', '$pass', '$email')";


    //         mysqli_query($connection, $query);
            
    //         $submitsuccess = "Success";
    //     } 

    // }

?>	