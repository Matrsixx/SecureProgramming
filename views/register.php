<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>
  	<link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090665780112261120/LogoSEcropped.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../styles/register.css">
</head>
<body style="background-image: url(https://cdn.discordapp.com/attachments/524461320314028052/1090666262247518310/Untitleddesign.gif); background-size: cover;">
	<div class="login-box">
		<img src="https://cdn.discordapp.com/attachments/524461320314028052/1090665918171971675/Dry-It_Logo_Cadangan_cropped.png" alt="logo" srcset="" class="avatar">
		<h2>Register</h2>

		<form action="RegisterPage.php" method="POST">
			<div class="user-box">
				<input type="text" name="username" required="">
				<label>Username</label>
			</div>
			<div class="user-box">
				<input type="password" name="password" required="">
				<label>Password</label>
			</div>
      		<div class="user-box">
        		<input type="password" name="confirmpassword" required="">
				<label>Confirm Password</label>
			</div>
			<div class="user-box">
        		<input type="email" name="email" required="">
        		<label>Email</label>
      		</div>
			<p id="errortexts"><?php echo $usernameerror ?></p>
			<p id="errortexts"><?php echo $passerror ?></p>
			<p id="errortexts"><?php echo $confirmpasserror ?></p>
			<p id="errortexts"><?php echo $emailerror ?></p>
			<p class="successtext"><?php echo $submitsuccess ?></p>
			<input id="button" type="submit" value="Submit" name="submit">
			<br><br>
			<span>Already Have An Account? <a href="index.php" class="forgot-button"><b>Login</b></a></span>
		</form>
	</div>
</body>
</html>