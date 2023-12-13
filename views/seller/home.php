<?php
  require_once './../../utils/helper.php';

  Helper::xFrameRemove();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dry-It | Dashboard - Seller</title>
    <link rel="stylesheet" href="../../styles/home.css">
    <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090297730372472842/LogoSEcropped.png" type="image/x-icon">
  </head>
  <body>
    <!-- Header -->
    <header>
      <?php include "../../template/navbar.template.php" ?>
    </header>

    <?php
      include_once "../../utils/encrypt.php";
      include_once "../../controller/LaundryController.php";
      session_start();

      if(isset($_SESSION['token']) && Encrypt::decodeJWT($_SESSION['token'])){
        $token = Encrypt::decodeJWT($_SESSION['token']);
        if($token->role !== "seller"){
          header('Location: ../home.php');
          exit();
        }
      } else {
        $_SESSION['error'] = "Authentication Error!";
        header('Location: ../../index.php');
        exit();
      }
    ?>

    <h2 style='margin: 50px;'>Laundry Saya</h2>
    <div id="top" class="laundry-info">
        <?php
            $laundry = LaundryController::getInstance()->getLaundryByUserId($token->user_id);
            if ($laundry !== NULL) {
                $tenant_id = $laundry->getId();
                $tenant_photo = $laundry->getTenantPhoto();
                $tenant_name = $laundry->getTenantName();
                $tenant_address = $laundry->getTenantAddress();
                $tenant_phone = $laundry->getTenantPhone();
            } else {
                throw new Exception("Laundry not found");
            }               
            echo "<img src='../../storage/$tenant_photo' alt='Laundry Image'>";
            echo "<div class='laundry-details'>";
            echo "<h2>$tenant_name</h2>";
            echo "<p>$tenant_address</p>";
            echo "<p>$tenant_phone</p>";
            echo "</div>";
        ?>
    </div>

  </body>
</html>
