<?php 
    include_once '../utils/helper.php';

    Helper::xFrameRemove();

    session_start();
    $_SESSION = array();
    session_destroy();
    unset($_SESSION);
    header("Location: ../index.php");
    exit();
?>