<?php
    session_start();
    include_once './../config/database.php';
    include_once './../models/User.php';
    include_once './../utils/encrypt.php';
    include_once './../controller/AuthController.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../views/login.php');
        exit();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = AuthController::getInstance()->userLogin($username, $password);

    if ($user) {
        $_SESSION['token'] = Encrypt::encodeJWT($user);
        header('Location: ../views/home.php');
    } else {
        $_SESSION['error_message'] = "Invalid Credential!";
        header('Location: ../index.php');
    }
?>