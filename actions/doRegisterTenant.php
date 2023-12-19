<?php
    include_once '../config/database.php';
    include_once '../models/User.php';
    include_once '../utils/encrypt.php';
    include_once '../controller/RegistrationTenantController.php';
    include_once '../utils/helper.php';

    Helper::xFrameRemove();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../views/register-tenant.php');
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

    $tenant = RegistrationTenantController::getInstance()->registerTenant();
    // die(var_dump($user));
    if ($tenant) {
        header('Location: ../views/seller/home.php');
    } else {
        header('Location: ../views/seller/register-tenant.php');
    }
?>