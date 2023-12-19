<?php
  include_once '../config/database.php';
  include_once '../models/User.php';
  include_once '../utils/encrypt.php';
  include_once '../controller/ProfileController.php';
  include_once '../utils/helper.php';

  Helper::xFrameRemove();

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: ../views/profile.php');
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


  $photo = ProfileController::getInstance()->uploadProfilePhoto();
  // die(var_dump($photo));
  header('Location: ../views/profile.php');