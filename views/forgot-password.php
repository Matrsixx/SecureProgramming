<!DOCTYPE html>
<html>
<head>
	<title>Dry-It! Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="../styles/forgot-password.css">
	<link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090297730372472842/LogoSEcropped.png" type="image/x-icon">
</head>
<body>
	<div class="container">
		<div class="form-container">
            <img src="https://cdn.discordapp.com/attachments/524461320314028052/1090299160135225344/logo.png" alt="Dry-It! Logo" class="logo">
			<h2>Forgot Password</h2>
			<p>Please enter your email address to reset your password</p>
			
			<form action="forgot-password.php" method="POST">
				<?php 
					include 'Includes/db.php';
					$message = " ";
					if(isset($_POST['submit'])){
						$message = "If email is exist, your password will be reset.";
						$email = $_POST['email'];
						$password = $_POST['password'];
						$query = "SELECT * FROM users WHERE email LIKE '${email}'";
					
						$search_query = mysqli_query($connection, $query);
						$count = mysqli_num_rows($search_query);

						$hash = "$2y$10$";
                    	$salt = "iusesomecrazystrings22";
                    	$combine = $hash . $salt;
                    	$password = crypt($password, $combine);

						if($count != 0){
							$query = "UPDATE users SET password = '$password' WHERE email = '$email'";
							$search_query = mysqli_query($connection, $query);
						}
					}
					
				?>
				<p><?php echo $message; ?></p>
				<label for="email">Email:</label>
				<input type="email" id="email" name="email" required>
				<label for="email">Password:</label>
				<input type="password" id="email" name="password" required>
				<button type="submit" value="submit" name="submit">Reset Password</button>
			</form>

			<a href="index.php">Back to login</a>
		</div>
	</div>
</body>
</html>
