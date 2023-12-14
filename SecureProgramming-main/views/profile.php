<!DOCTYPE html>
<html>
<head>
  <?php 
      include "Includes/db.php";
      session_start(); 
      ob_start();
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
        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Profile Picture">
        <div class="profile-details">
          <h2><?php echo $_SESSION['username']; ?></h2>
        </div>
        <div class="action-button">
          <a href="UpdateProfile.php" style="text-decoration: none; color: inherit;">
            <button type="submit">Update Profile</button>
            <button type="submit">Change Password</button>
          </a>
        </div>
      </div>
      <div class="profile-secondary-info">
        <div class="profile-email">
          <h2>Email</h2>
          <p><?php echo $_SESSION['email']; ?></p>
        </div>
        <div class="profile-address">
          <h2>Address</h2>
          <p><?php 
            $query = "SELECT address FROM users WHERE id = '".$_SESSION['id']."'";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($result);
            echo $row['address'];
          ?></p>
        </div>
      </div>
		</section>
	</main>
</body>
</html>
