<!DOCTYPE html>
<html>
<head>
  <?php 
      include "Includes/db.php";
      session_start(); 
      ob_start();
	?>
	<title>Halaman Pembayaran</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
  <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090665780112261120/LogoSEcropped.png" type="image/x-icon">
</head>
<body>
	<main>
		<section class="profile">
      <div class="profile-main-info">
        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Profile Picture">
        <div class="profile-details">
          <h2><?php echo $_SESSION['username']; ?></h2>
          <p>Change Profile Picture</p>
          <p>Remove Profile Picture</p>
        </div>
        <!-- <div class="action-button">
          <button type="submit">Change Profile</button>
          <button type="submit">Change Password</button>
        </div> -->
      </div>
      <div class="profile-secondary-info">
        <div class="profile-email">
          <h2>Email</h2>
          <p><?php echo $_SESSION['email']; ?></p>
        </div>
      </div>
		</section>
	</main>
</body>
</html>
