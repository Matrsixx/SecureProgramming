<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090665780112261120/LogoSEcropped.png" type="image/x-icon">
</head>
<body style="background-image: url(https://cdn.discordapp.com/attachments/524461320314028052/1090666262247518310/Untitleddesign.gif); background-size: cover;">
	<div class="login-box">
		<img src="https://cdn.discordapp.com/attachments/524461320314028052/1090665918171971675/Dry-It_Logo_Cadangan_cropped.png" alt="logo" srcset="" class="avatar">
		<h2>Login</h2>
		<form  action="index.php" method="POST">
			<?php 
				include "Includes/db.php";
				$error123 = ' ';
				if(isset($_POST['submit'])){
					
					session_start();
					$username = $_POST['username'];
					$password = $_POST['password'];

					$hash = "$2y$10$";
                    $salt = "iusesomecrazystrings22";
                    $combine = $hash . $salt;
                    $password = crypt($password, $combine);
					$data1_id = ' ';
					$data1_username = '';
					$data1_password = '';
					
					
					$query = "SELECT * FROM users WHERE username LIKE '${username}'";
					$select_query = mysqli_query($connection, $query);
					while($row = mysqli_fetch_array($select_query)){
						$data1_id = $row['id'];
						$data1_username = $row['username'];
						$data1_password = $row['password'];
						$data1_email = $row['email'];
					}
						
					
					if($username == $data1_username && $password == $data1_password ){
						$_SESSION['id'] = $data1_id;
						$_SESSION['username'] = $data1_username;
						$_SESSION['email'] = $data1_email;
						$_SESSION['password'] = $data1_password;
							 
						header("Location: profile.php");
					}else{
						$error123 = "Wrong username or password";
					}
					
				}
			?>	

			<div class="user-box">
				<input type="text" name="username" required="">
				<label>Username</label>
			</div>
			<div class="user-box">
				<input type="password" name="password" required="">
				<label>Password</label>
			</div>
			<p class="errortext"><?php echo $error123 ?></p>
			<br>
			<input id="button" type="submit" value="submit" name="submit">
			<br><br>
			<a href="forgot-password.php" class="forgot-button"><b>Forgot Password?</b></a>
			<br><br>
			<span>Dont Have An Account? <a href="register.php" class="forgot-button"><b>Register</b></a></span>
			
		</form>
	</div>
</body>
</html>
