<?php
    include_once '../config/database.php';
    include_once '../models/User.php';
    include_once '../utils/encrypt.php';
    include_once '../controller/RegistrationController.php';
    include_once '../utils/helper.php';

    Helper::xFrameRemove();

    session_start();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../views/register.php');
        exit();
    }

    if(!isset($_SESSION['csrf_token'])){
        $_SESSION['error'] = "Authorization Error";
        header('Location: ../index.php');
        die();
    }else if($_SESSION['csrf_token'] !== $_POST['csrf_token']){
        $_SESSION['error'] = "Authorization Error";
        header('Location: ../index.php');
        die();
    }

    $user = RegistrationController::getInstance()->registerUser();
    // die(var_dump($user));
    if ($user) {
        if ($user->getRole() === 'seller') {
            $_SESSION['token'] = Encrypt::encodeJWT($user);
            header('Location: ../views/seller/register-tenant.php');
        } else {
            header('Location: ../index.php');
        }
    } else {
        header('Location: ../views/register.php');
    }
?>