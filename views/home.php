<?php
  require_once './../utils/helper.php';

  Helper::xFrameRemove();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dry-It | Dashboard</title>
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090297730372472842/LogoSEcropped.png" type="image/x-icon">
  </head>
  <body>
    <!-- Header -->
    <header>
      <?php include "../includes/navbar.php" ?>
    </header>

    <?php
      include_once "../controller/LaundryController.php";
      include_once "../models/Laundry.php";
      include "../utils/encrypt.php";

      session_start();
        $x = new Encrypt();
        $decodedData = $x->decodeJWT($_SESSION['token']);
    
        if(!isset($_SESSION['token']) || !$decodedData){

          $_SESSION['error'] = "Authentication Error!";
          header('Location: ../index.php');
          exit();
        }

        $token = Encrypt::decodeJWT($_SESSION['token']);
        if($token->role !== "buyer"){
          header('Location: seller/home.php');
          exit();
        }
    ?>
        
    <!-- Cari Laundry -->
    <section class="search">
      <div class="container">
        <h2>Cari Laundry</h2>
        <form action = "./../actions/searchLaundry.php" method="GET">
          <input type="text" id="name" name="name" placeholder="Masukkan nama laundry">
          <button>Cari</button>
        </form>
      </div>
    </section>

    <!-- Laundry Terdekat -->
    <section class="nearby">
      <div class="container">
        <h2>Laundry Terdekat</h2>
        <div class="laundries">
          <?php
            if (!isset($_SESSION['laundries'])) {
              $laundries = LaundryController::getInstance()->getLaundry();
            } else {
              $laundries = $_SESSION['laundries'];
            }
            foreach ($laundries as $item) {
              $id = $item->getId();
              $name = $item->getTenantName();
              $address = $item->getTenantAddress();
              $photo = $item->getTenantPhoto();

              echo "<div class='laundry'>";
              echo "<a href='laundry-service.php?id=$id' style='text-decoration: none; color: inherit;'>";
              echo "<img src='../storage/$photo' alt='Laundry Image'>";
              echo "<h3>$name</h3>";
              echo "<p>$address</p>";
              echo "</a>";
              echo "</div>";
            }
            unset($_SESSION['laundries']);
          ?>
        </div>
      </div>
    </section>

  </body>
</html>
