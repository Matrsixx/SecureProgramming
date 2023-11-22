<?php
    require_once('../config/database.php');
    require_once('../models/Transactions.php');

    $conn = Database::getInstance()->getConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_POST['user_id'];
        $tenant_id = $_POST['tenant_id'];
        $total_price = $_POST['total_price'];

        $query = "INSERT INTO transactionheader (TransactionPrice, TransactionDate, usersid, tenantid, TransactionProgress) VALUES (?, ?, ?, ?, 1)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssii', $total_price, date("Y-m-d"), $user_id, $tenant_id);
        $stmt->execute();
        $stmt->close();

        header("Location: ../views/home.php");
    }
?>