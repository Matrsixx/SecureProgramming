<!DOCTYPE html>
<html>
<head>
  <?php
      session_start(); 
      include_once "../utils/encrypt.php";
      include_once "../models/User.php";
      include_once "../config/database.php";   
      
      $x = new Encrypt();
      $decodedData = $x->decodeJWT($_SESSION['token']);
  
      if(!isset($_SESSION['token']) || !$decodedData){

        $_SESSION['error'] = "Authentication Error!";
        header('Location: ../index.php');
        exit();
      }
    
      
      $x = new Encrypt();
      $decodedData = $x->decodeJWT($_SESSION['token']);
      $username = $decodedData->username;
      $role = $decodedData->role;

      $user = new User($username);
      $email = $user->getEmail();
      $photo = $user->getPhoto();
	?>
	<title>Dry-It! | Profile</title>
	<link rel="stylesheet" type="text/css" href="../styles/profile.css">
  <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090665780112261120/LogoSEcropped.png" type="image/x-icon">
</head>
<body>
  <header>
    <?php include "../includes/navbar.php" ?>
  </header>

  <main>
    <section class="profile">
      <div class="profile-main-info">
          <?php if ($photo): ?>
            <img src="<?php echo "../storage/". $photo; ?>" alt="Profile Picture">
          <?php else: ?>
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Default Profile Picture">
          <?php endif; ?>
          <div class="profile-details">
            <h2><?php echo $username ?></h2>
          </div>
        <form action="../actions/doUploadPhoto.php" method="post" enctype="multipart/form-data">
          <label for="profile-photo">Upload Profile Photo:</label>
          <input type="file" name="profile-photo" id="profile-photo" accept="image/*">
          <br><br>
          <input id="button" type="submit" value="Update Profile Photo" name="submit">
          <br><br>
          <?php
            if (isset($_SESSION['error'])) {
              $error = $_SESSION['error'];
              echo "<p style='color: red;'>$error</p>";
              echo "<br>";
              unset($_SESSION['error']);
            } 
          ?>

          <?php
            if (isset($_SESSION['success_message'])) {
              $success = $_SESSION['success_message'];
              echo "<p style='color: green;'>$success</p>";
              echo "<br>";
              unset($_SESSION['success_message']);
            } 
          ?>
        </form>
      </div>
      <div class="profile-secondary-info">
        <div class="profile-email">
          <h2>Email</h2>
          <p><?php echo $email ?></p>
        </div>
        <div class="profile-address">
          <h2>Role</h2>
          <p><?php echo $role ?></p>
        </div>
      </div>
    </section>
  </main>
</body>

</html>
