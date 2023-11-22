<?php
    include_once '../config/database.php';
    include_once '../models/Laundry.php';
    include_once '../controller/LaundryController.php';

    session_start();

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        header('Location: ../views/home.php');
        exit();
    }

    if (!isset($_GET['name'])) {
        $laundries = LaundryController::getInstance()->getLaundry();
    } else {
        $laundries = LaundryController::getInstance()->getLaundry('%' . $_GET['name'] . '%');
    }
    $_SESSION['laundries'] = $laundries;
    header('Location: ../views/home.php');
?>