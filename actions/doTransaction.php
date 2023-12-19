<?php
    session_start();
    include_once '../config/database.php';
    include_once '../models/Transactions.php';
    include_once '../utils/encrypt.php';
    include_once '../utils/helper.php';

    Helper::xFrameRemove();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../views/Transaction.php?error=1');
        $_SESSION['error'] = "Bad Request!";
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

    $x = new Encrypt();
    $decodedData = $x->decodeJWT($_SESSION['token']);
    $id = $decodedData->user_id;

    $_SESSION['count'] = 0;
    if(isset($_POST['ongoingsubmit']) && isset($id)){
        
        $Data = Transaction::getInstance()->getTransaction($_POST['ongoingsubmit'], $id);
        $_SESSION['Data'] = array();

        
        while($row = $Data->fetch_assoc()){
            $temp = array($row['TransactionDate'], $row['TransactionPrice'], $row['name'], $row['address'], $row['photo'], $row['phone']);    
            array_push($_SESSION['Data'], $temp);
            $_SESSION['count']++;
        } 
        
        header('Location: ../views/transaction.php');

    }else if(isset($_POST['pastsubmit']) && isset($id)){
        $Data = Transaction::getInstance()->getTransaction($_POST['pastsubmit'], $id);
        $_SESSION['Data'] = array();

        while($row = $Data->fetch_assoc()){
            $temp = array($row['TransactionDate'], $row['TransactionPrice'], $row['name'], $row['address'], $row['photo'], $row['phone']);    
            array_push($_SESSION['Data'], $temp);
            $_SESSION['count']++;
        }
      
        header('Location: ../views/transaction.php');
    }else{
        header('Location: ../views/transaction.php?error=1');
        $_SESSION['error'] = "Authentication Error!";
        exit();
    }
?>