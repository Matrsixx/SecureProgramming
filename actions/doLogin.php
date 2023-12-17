<?php
    session_start();
    include_once './../config/database.php';
    include_once './../models/User.php';
    include_once './../utils/encrypt.php';
    include_once './../controller/AuthController.php';
    include_once '../utils/helper.php';

    Helper::xFrameRemove();
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../index.php');
        exit();
    }

    if (AuthController::getInstance()->checkMaxAttempt($_SERVER['REMOTE_ADDR'])) {
        $_SESSION['error'] = "Too Many Login Attempt!<br>Please Try Again Later!";
        header('Location: ../index.php');
        exit();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = AuthController::getInstance()->userLogin($username, $password);
    AuthController::getInstance()->createAttempt($_SERVER['REMOTE_ADDR']);

    if (!AuthController::getInstance()->captchaValidation($_POST['cf-turnstile-response'])) {
        header('Location: ../index.php');
        exit();
    }

    if ($user) {
        $_SESSION['token'] = Encrypt::encodeJWT($user);
        header('Location: ../views/home.php');
    } else {
        $_SESSION['error'] = "Invalid Credential!";
        header('Location: ../index.php');
    }
?>