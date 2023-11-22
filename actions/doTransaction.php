<?php
    session_start();
    include_once '../config/database.php';
    include_once '../models/Transactions.php';
    include_once '../utils/encrypt.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../views/Transaction.php?error=1');
        $_SESSION['error_message'] = "Wrong Request Method!";
        exit();
    }

    if(!isset($_SESSION['token'])){

        $_SESSION['error_message'] = "login first!";
        header('Location: ../index.php');
        exit();
    }

    $x = new Encrypt();
    $decodedData = $x->decodeJWT($_SESSION['token']);
    $id = $decodedData->user_id;

    $_SESSION['count'] = 0;
    if(isset($_POST['ongoingsubmit']) && isset($id)){
        
        $Data = Transaction::getInstance()->getTransaction($_POST['ongoingsubmit'], $id);
        $_SESSION['Data'] = array();

        
        while($row = $Data->fetch_assoc()){
            $temp = array($row['TransactionDate'], $row['TransactionPrice'], $row['name'], $row['address'], $row['Photo'], $row['phone']);    
            array_push($_SESSION['Data'], $temp);
            $_SESSION['count']++;
        } 
        
        header('Location: ../views/transaction.php');

    }else if(isset($_POST['pastsubmit']) && isset($id)){
        $Data = Transaction::getInstance()->getTransaction($_POST['pastsubmit'], $id);
        $_SESSION['Data'] = array();

        while($row = $Data->fetch_assoc()){
            $temp = array($row['TransactionDate'], $row['TransactionPrice'], $row['name'], $row['address'], $row['Photo'], $row['phone']);    
            array_push($_SESSION['Data'], $temp);
            $_SESSION['count']++;
        }
      
        header('Location: ../views/transaction.php');
    }else{
        header('Location: ../views/transaction.php?error=1');
        $_SESSION['error_message'] = "login first!";
        exit();
    }
?>