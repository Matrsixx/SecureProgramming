<?php
	session_start();
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	require_once './utils/helper.php';

	Helper::xFrameRemove();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="./styles/index.css">
	<link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090665780112261120/LogoSEcropped.png" type="image/x-icon">
	<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>
<body style="background-image: url(https://cdn.discordapp.com/attachments/524461320314028052/1090666262247518310/Untitleddesign.gif); background-size: cover;">
	<div class="login-box">
		<img src="https://cdn.discordapp.com/attachments/524461320314028052/1090665918171971675/Dry-It_Logo_Cadangan_cropped.png" alt="logo" srcset="" class="avatar">
		<h2>Login</h2>
		<?php
			require_once './utils/encrypt.php';	
			
			

			if (isset($_SESSION['token'])) {
				$token = $_SESSION['token'];
				$decodedToken = Encrypt::decodeJWT($token);

				if ($decodedToken->role === 'buyer') {
					header('Location: ./views/buyer/home.php');
				} else if ($decodedToken->role === 'seller') {
					header('Location: ./views/seller/home.php');
				}
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
			<div class="cf-turnstile" data-sitekey="0x4AAAAAAANj8c6gD3Mangzj" data-theme="light" data-callback="onSuccess"></div>
			<br>
			<input type="hidden" name="csrf_token" value=<?php echo $_SESSION['csrf_token'] ?>>

			<input id="button" type="submit" value="Submit" name="submit" disabled="true">
			<br><br>
			<!-- <a href="/views/forgot-password.php" class="forgot-button"><b>Forgot Password?</b></a> -->
			<br><br>
			<span>Don't Have An Account? <a href="./views/register.php" class="forgot-button"><b>Register</b></a></span>
			
		</form>
	</div>
</body>
</html>

<script>
	function onSuccess(token) {
		document.getElementById("button").disabled = false;

		var tokenInput = document.createElement('input');
		tokenInput.type = 'hidden';
		tokenInput.name = 'cf-turnstile-response';
		tokenInput.value = token;

		const form = document.querySelector('form[action="./actions/doLogin.php"]');
		form.appendChild(tokenInput);
	}
</script>