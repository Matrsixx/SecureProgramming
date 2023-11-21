<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>
  	<link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090665780112261120/LogoSEcropped.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="register.css">
</head>
<body style="background-image: url(https://cdn.discordapp.com/attachments/524461320314028052/1090666262247518310/Untitleddesign.gif); background-size: cover;">
	<div class="login-box">
		<img src="https://cdn.discordapp.com/attachments/524461320314028052/1090665918171971675/Dry-It_Logo_Cadangan_cropped.png" alt="logo" srcset="" class="avatar">
		<h2>Register</h2>

		<form action="RegisterPage.php" method="POST">

			<?php 
			include "Includes/db.php";
            $usernameerror = " ";
            $passerror = " ";
            $confirmpasserror = " ";
			$emailerror = " ";
            $submitsuccess = " ";

            if(isset($_POST['submit'])){   

                $username = $_POST['username'];
                if(strlen($username) < 5 || !preg_match("/^[a-zA-Z ]*$/", $username) || empty($username)){
                    $usernameerror = "Username minimal 5 character AND only alphabet AND not empty";
                }

                $pass = $_POST['password'];
                if(empty($pass) || strlen($pass) < 6 ){
                    $passerror = "Password minimal 6 character AND not empty";
                }

                $confirmpass = $_POST['confirmpassword'];
                if(empty($pass) || $pass != $confirmpass){
                    $confirmpasserror = "Password must match AND not empty";
                }

				$email = $_POST['email'];
                $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
                if(!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)){
                    $emailerror = "Email must valid AND not empty";
                }    
                
                if($emailerror == " " && $usernameerror == " " && $passerror == " " && $confirmpasserror == " "){
                    $hash = "$2y$10$";
                    $salt = "iusesomecrazystrings22";
                    $combine = $hash . $salt;
                    $pass = crypt($pass, $combine);

                    $query = "INSERT INTO users(id,username,password,email) VALUES (NULL, '$username', '$pass', '$email')";

    
                    mysqli_query($connection, $query);
                    
                    $submitsuccess = "Success";
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
			
			<input id="button" type="submit" value="submit" name="submit">

			<br><br>
			<span>Already Have An Account? <a href="index.php" class="forgot-button"><b>Login</b></a></span>
		</form>
	</div>
</body>
</html>