<?php
    require_once('../config/database.php');
    require_once('../models/Transactions.php');
    require_once "../utils/Encrypt.php";
    require_once "LaundryController.php";

    session_start();   
    $conn = Database::getInstance()->getConnection();
     
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id_jwt = Encrypt::decodeJWT($_SESSION['token'])->user_id;
        $user_id = $_POST['user_id'];

        if($user_id_jwt != $user_id){
            $_SESSION['error'] = "Authentication Error!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }


        $order_list = $_POST['order_list'];
        $tenant_id = $_POST['tenant_id'];

        $order = explode(",", $order_list);
        $totalPrice = 0;
        foreach($order as $item){
            $item = explode(":", $item);
            $item_name = $item[0];
            $item_quantity = $item[1];

            $service = LaundryController::getInstance()->getServicebyName($item_name);

            if ($service !== NULL) {
                $item_price = $service->getServicePrice();
                $tempPrice = $item_price * $item_quantity;
                $totalPrice += $tempPrice;
            } else {
                throw new Exception("Service not found");
                die();
            }
        }

        $query = "INSERT INTO transactionheader (TransactionPrice, TransactionDate, usersid, tenantid, TransactionProgress) VALUES (?, ?, ?, ?, 1)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssii', $totalPrice, date("Y-m-d"), $user_id, $tenant_id);
        $stmt->execute();
        $stmt->close();

        header("Location: ../views/home.php");
    }
?>