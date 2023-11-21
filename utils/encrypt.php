<?php
    Class Encrypt {
        private const secretKey = "rahasiabangetnichgaboong";
        public static function encryptPassword($password) {
            $hash = "$2y$10$";
            $salt = "1usESoM3cr4zYstRiNgs21";
            $combine = $hash . $salt;
            $password = crypt($password, $combine);
            return $password;
        }

        public static function verifyPassword($inputPassword, $password) {
            $inputPassword = self::encryptPassword($inputPassword);
            if ($inputPassword === $password) {
                return true;
            } else {
                return false;
            }
        }

        public static function encodeJWT($user) {
            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];

            $userData = [
                'user_id' => $user->getId(),
                'username' => $user->getUsername(),
                'role' => $user->getRole(),
                'iat' => time(),
                'exp' => time() + (60 * 60)
            ];

            $header = base64_encode(json_encode($header));
            $userData = base64_encode(json_encode($userData));

            // Membuat signature token dengan menggunakan HMAC-SHA256
            $signature = hash_hmac('sha256', $header . '.' . $userData, self::secretKey, true);
            $signature = base64_encode($signature);

            // Membuat token dengan menggabungkan payload dan signature, dipisahkan oleh titik
            $token = $header . '.' . $userData . '.' . $signature;
            
            return $token;
        }

        public static function decodeJWT($token) {
            $token = explode('.', $token);
            $header = json_decode(base64_decode($token[0]));
            $userData = json_decode(base64_decode($token[1]));
            $signature = $token[2];

            // Membuat signature token dengan menggunakan HMAC-SHA256
            $signatureCheck = hash_hmac('sha256', $token[0] . '.' . $token[1], self::secretKey, true);
            $signatureCheck = base64_encode($signatureCheck);

            // Membandingkan signature yang dibuat dengan signature dalam token
            if ($signatureCheck === $signature) {
                return $userData;
            } else {
                return false;
            }
        }
    }
?>