<!DOCTYPE html>
<html>
	<head>
		<title>Dry-It! Update Password</title>
		<link rel="stylesheet" type="text/css" href="../styles/update-password.css">
		<link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090297730372472842/LogoSEcropped.png" type="image/x-icon">
	</head>
	<body>
		<div class="container">
			<div class="form-container">
				<img src="https://cdn.discordapp.com/attachments/524461320314028052/1090299160135225344/logo.png" alt="Dry-It! Logo" class="logo">
				<h2>Update Password</h2>
				<br>
				<form action="update-password.php" method="POST">
					<?php
						include 'Includes/db.php';
						session_start(); 
						ob_start();
						$message = " ";
						$username = $_SESSION['username'];
						$confirmpasserror = " ";
						$confirmpasserror1 = " ";

						if(isset($_POST['submit'])){   
							$password = $_POST['old_password'];
							$hash = "$2y$10$";
							$salt = "iusesomecrazystrings22";
							$combine = $hash . $salt;
							$password = crypt($password, $combine);
							$pass = $_POST['new_password'];
							$confirmpass = $_POST['confirm_password'];

							if(empty($pass) || $pass != $confirmpass){
								$confirmpasserror = "Password must match AND not empty";
							}


							$query = "SELECT * FROM users WHERE username = '${username}'";
							$data1_id = ' ';
							$data1_username = '';
							$data1_password = '';
							$data1_address = ' ';

							$select_query = mysqli_query($connection, $query);
							while($row = mysqli_fetch_array($select_query)){
								$data1_id = $row['id'];
								$data1_username = $row['username'];
								$data1_password = $row['password'];
								$data1_email = $row['email'];
								$data1_address = $row['address'];
							}

							if($password != $data1_password){
								$confirmpasserror1 = "Wrong Password";
							}

							if($confirmpasserror == " " && $confirmpasserror1 == " "){
								$confirmpass = crypt($confirmpass, $combine);
								$query = "UPDATE users SET password = '$confirmpass' WHERE username LIKE '$username'";
								$search_query = mysqli_query($connection, $query);
							}

						}
					?>

					<p><?php echo $confirmpasserror ?></p>
					<p><?php echo $confirmpasserror1 ?></p>
					<span>Old Password : </span>
					<input type="password" id="old_password" name="old_password" required>
					<span>New Password : </span>
					<input type="password" id="new_password" name="new_password" required>
					<span>Confirm Password : </span>
					<input type="password" id="confirm_password" name="confirm_password" required>
					<br><br>
					<button type="submit" value="submit" name="submit">Save</button>
				</form>
				<a href="profile-page.php">Back to profile</a>
			</div>
		</div>
	</body>
</html>