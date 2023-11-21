<?php
    Class Encrypt {
        public static function encryptPassword($password) {
            $hash = "$2y$10$";
            $salt = "1usESoM3cr4zYstRiNgs21";
            $combine = $hash . $salt;
            $password = crypt($password, $combine);
            return $password;
        }
    }
?>