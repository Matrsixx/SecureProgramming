<?php
		session_start();

		require_once './../../utils/helper.php';

		Helper::xFrameRemove();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Tenant Page</title>
  	<link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090665780112261120/LogoSEcropped.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../../styles/register.css">
</head>
<body style="background-image: url(https://cdn.discordapp.com/attachments/524461320314028052/1090666262247518310/Untitleddesign.gif); background-size: cover;">
	<div class="login-box">
		<img src="https://cdn.discordapp.com/attachments/524461320314028052/1090665918171971675/Dry-It_Logo_Cadangan_cropped.png" alt="logo" srcset="" class="avatar">
		<h2>Register Tenant</h2>

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

		<?php 
				session_start();
				// Generate a token
				$_SESSION['csrf-token'] = bin2hex(random_bytes(32)); 
		?>

		<form action="../../actions/doRegisterTenant.php" method="POST" enctype="multipart/form-data">
			<div class="user-box">
				<input type="text" name="tenant-name" required="">
				<label>Tenant Name</label>
			</div>
			<div class="user-box">
				<input type="text" name="tenant-address" required="">
				<label>Tenant Address</label>
			</div>
      		<div class="user-box">
        		<input type="text" name="tenant-phone" required="">
				<label>Phone</label>
			</div>
			<div>
					<label>Photo</label>
          <input type="file" name="tenant-photo">
      </div>
	  		<input type="hidden" name="csrf-token" value="<?=$_SESSION['csrf-token']?>">
			<input id="button" type="submit" value="Submit" name="submit">
		</form>
	</div>
</body>
</html>