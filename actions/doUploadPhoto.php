<?php
  include_once '../config/database.php';
  include_once '../models/User.php';
  include_once '../utils/encrypt.php';
  include_once '../controller/ProfileController.php';

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: ../views/profile.php');
      exit();
  }

  $photo = ProfileController::getInstance()->uploadProfilePhoto();
  // die(var_dump($photo));
  header('Location: ../views/profile.php');