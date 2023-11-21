<?php
    session_start();
    include_once '../config/database.php';
    include_once '../models/User.php';
    include_once '../utils/encrypt.php';
    include_once '../controller/AuthController.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../views/login.php');
        exit();
    }

    $user = AuthController::getInstance()->userLogin($_POST['username'], $_POST['password']);
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: ../views/home.php');
    } else {
        $_SESSION['error'] = "Invalid Credential!";
        header('Location: ../index.php');
    }
?>