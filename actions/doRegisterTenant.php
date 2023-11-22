<?php
    include_once '../config/database.php';
    include_once '../models/User.php';
    include_once '../utils/encrypt.php';
    include_once '../controller/RegistrationTenantController.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../views/register-tenant.php');
        exit();
    }

    $tenant = RegistrationTenantController::getInstance()->registerTenant();
    // die(var_dump($user));
    if ($tenant) {
        header('Location: ../views/seller/home.php');
    } else {
        header('Location: ../views/register.php');
        unset($_SESSION['token']);
        session_destroy();
    }
?>