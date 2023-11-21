<?php
    include_once '../config/database.php';
    include_once '../models/User.php';
    include_once '../utils/encrypt.php';
    include_once '../controller/RegistrationController.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../views/register.php');
        exit();
    }

    $user = RegistrationController::getInstance()->registerUser($_POST['username'], $_POST['password'], $_POST['confirm-password'], $_POST['email'], $_POST['role']);
    if ($user) {
        header('Location: ../index.php');
    } else {
        header('Location: ../views/register.php');
    }
?>