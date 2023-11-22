<?php
    include_once '../config/database.php';
    include_once '../models/Laundry.php';
    include_once '../controller/LaundryController.php';
    include_once '../utils/helper.php';

    session_start();

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        header('Location: ../views/home.php');
        exit();
    }

    if (!isset($_GET['name'])) {
        $laundries = LaundryController::getInstance()->getLaundry();
    } else {
        $name = Helper::stripTags($_GET['name']);
        $laundries = LaundryController::getInstance()->getLaundry('%' . $name . '%');
    }
    $_SESSION['laundries'] = $laundries;
    header('Location: ../views/home.php');
?>