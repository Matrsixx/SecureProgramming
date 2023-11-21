<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Update Profile</title>
    <link rel="stylesheet" href="../styles/update-profile.css">
    <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090297730372472842/LogoSEcropped.png" type="image/x-icon">
  </head>
  <body>
    <div class="form-container">
      <img src="https://cdn.discordapp.com/attachments/524461320314028052/1090299160135225344/logo.png" alt="Dry-It! Logo" class="logo">
      <h1>Update Profile</h1>
      <p>You can update your data in this menu</p>
      <br><br>
      <form action="UpdateProfile.php" method="POST">
        <?php 
          include 'Includes/db.php';
          session_start(); 
          ob_start();

          $message = " ";
          $username = $_SESSION['username'];

          if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $name = $_POST['name'];
  
            $hash = "$2y$10$";
            $salt = "iusesomecrazystrings22";
            $combine = $hash . $salt;
            $password = crypt($password, $combine);
  
            $query = "SELECT * FROM users WHERE username = '${username}' AND password = '${password}'";
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
            
            if($username == $data1_username && $password == $data1_password ){
              $query = "UPDATE users SET username = '$name', email = '$email' WHERE username = '$username'";
              $search_query = mysqli_query($connection, $query);
            }else{
              $error123 = "Wrong username or password";
            }
          }
          
        ?>
        
        <p><?php echo $username; ?></p>
        <p><?php echo $message; ?></p>
        <label for="name">Username:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <!-- <input id="button" type="submit" value="Update Profile" name="submit"> -->
        <button id="button" type="submit" value="submit" name="submit">Update Profile</button>
        <br>
      </form>
      
      <a href="#">Back to login</a>
    </div>
    

  </body>
</html>
