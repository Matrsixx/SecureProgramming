<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="./styles/index.css">
	<link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090665780112261120/LogoSEcropped.png" type="image/x-icon">
</head>
<body style="background-image: url(https://cdn.discordapp.com/attachments/524461320314028052/1090666262247518310/Untitleddesign.gif); background-size: cover;">
	<div class="login-box">
		<img src="https://cdn.discordapp.com/attachments/524461320314028052/1090665918171971675/Dry-It_Logo_Cadangan_cropped.png" alt="logo" srcset="" class="avatar">
		<h2>Login</h2>
		<?php
			session_start();

			if (isset($_SESSION['token'])) {
				header("Location: ./views/home.php");
			}

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
		<form action="./actions/doLogin.php" method="POST">
			<div class="user-box">
				<input type="text" name="username" required>
				<label>Username</label>
			</div>
			<div class="user-box">
				<input type="password" name="password" required>
				<label>Password</label>
			</div>
			<br>
			<input id="button" type="submit" value="Submit" name="submit">
			<br><br>
			<!-- <a href="/views/forgot-password.php" class="forgot-button"><b>Forgot Password?</b></a> -->
			<br><br>
			<span>Don't Have An Account? <a href="./views/register.php" class="forgot-button"><b>Register</b></a></span>
			
		</form>
	</div>
</body>
</html>
