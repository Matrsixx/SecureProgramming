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
      <?php include "../Includes/navbar.php" ?>
    </header>

    <?php
      $search = '%';
      include "Includes/db.php";
    ?>
        
    <!-- Cari Laundry -->
    <section class="search">
      <div class="container">
        <h2>Cari Laundry</h2>
        <form action = "Home.php" method="GET">
          <input type="text" id="name" name="name" placeholder="Masukkan nama laundry">
          <button>Cari</button>

          <?php
            if (isset($_GET['name'])) {
              $name = $_GET['name'];
              $search = '%' . $name . '%';
            }
          ?>

        </form>
      </div>
    </section>

    <!-- Laundry Terdekat -->
    <section class="nearby">
      <div class="container">
        <h2>Laundry Terdekat</h2>
        <div class="laundries">
          <?php
            $query = "SELECT * FROM tenant WHERE name LIKE '$search'";

            $select_all_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_query)){
              $tenant_id = $row['id'];
              $tenant_name = $row['name'];
              $tenant_address = $row['address'];
              $tenant_photo = $row['Photo'];
              $tenant_phone = $row['phone'];
          ?>
          <div class="laundry">
            <a href="LaundryService.php?id=<?php echo base64_encode($tenant_id) ?>&name=<?php echo urlencode($tenant_name) ?>&address=<?php echo urlencode($tenant_address) ?>&photo=<?php echo urlencode($tenant_photo) ?>&phone=<?php echo urlencode($tenant_phone) ?>" style="text-decoration: none; color: inherit;">
              <img src="<?php echo $tenant_photo ?>" alt="Laundry Image">
              <h3><?php echo $tenant_name ?></h3>
              <p><?php echo $tenant_address ?></p>
            </a>
          </div>

          <?php } ?>
        </div>
      </div>
    </section>

  </body>
</html>
