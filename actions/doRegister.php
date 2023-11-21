<?php
    include_once '../config/database.php';
    include_once '../models/User.php';
    include_once '../utils/encrypt.php';
    include_once '../controller/RegistrationController.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../views/register.php');
        exit();
    }

    $user = RegistrationController::getInstance()->registerUser();
    if ($user) {
        header('Location: ../index.php');
    } else {
        header('Location: ../views/register.php');
    }
?>