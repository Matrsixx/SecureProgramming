<?php
  include_once '../config/database.php';
  include_once '../models/User.php';
  include_once '../utils/encrypt.php';
  include_once '../controller/ProfileController.php';
  include_once '../utils/helper.php';

  session_start();

  Helper::xFrameRemove();

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        if (!isset($_SESSION['csrf-token'])) {
          echo "Invalid token";
          die();
          
        }else if($_POST['csrf-token'] !== $_SESSION['csrf-token']){
          echo "Invalid token";
          die();      
        }
      header('Location: ../views/profile.php');
      exit();
  }

  $photo = ProfileController::getInstance()->uploadProfilePhoto();
  // die(var_dump($photo));
  header('Location: ../views/profile.php');