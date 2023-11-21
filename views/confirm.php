<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dry-It! | Confirmation Page</title>
    <link rel="stylesheet" href="../styles/confirm.css">
    <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090297730372472842/LogoSEcropped.png" type="image/x-icon">
</head>
<body>
    <div id="logo">
        <img src="https://cdn.discordapp.com/attachments/524461320314028052/1089862458090455070/Untitled-1.png"> 
    </div>

    <!-- <header>
        <div class="logo">
          <img src="https://media.discordapp.net/attachments/524461320314028052/1090298933110124737/logo2.png" alt="Dry-It Logo">
        </div>
        
        <nav>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Transaction</a></li>
            <li class="profile">
              <a href="#">Profile</a>
              <ul>
                <li><a href="#">View Profile</a></li>
                <li><a href="#">Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
	</header> -->


    <h1 id="confirm-text">Confirmation Page </h1>

    <div id="top">
        <?php
            $tenant_photo =$_GET['photo'];
            $tenant_name = $_GET['name'];
            $tenant_address = $_GET['address'];
            $tenant_phone = $_GET['phone'];
            $order = urldecode($_GET['orderlist']);
        ?>
        <img src="<?php echo $tenant_photo ?>" alt="Laundry Image" id="phototop" >
        <div>
            <div id="top-1">
              <h2 id="top-p"><?php echo $tenant_name ?></h2>
            </div>
            <p id="top-p"><?php echo $tenant_phone ?></p>
            <p id="top-p"><?php echo $tenant_address ?></p>
        </div>
        
    </div>

    <h1>User Information</h1>
    <div class="line"></div>

    <?php 
        include "Includes/db.php"; 
        session_start(); 
        ob_start();
    ?>

    <div>
        <?php
            $id = $_SESSION['id'];
            $query = "SELECT * FROM users WHERE id = $id;";

            $select_all_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_all_query)){
                $name = $row['username'];
                $email = $row['email'];
        ?>
        <p><strong><?php echo $name?></strong></p>
        <p><?php echo $email?></p>
    </div>
    <?php } ?>

    <h1>Add Ons</h1>
    <div class="line"></div>
    <br>
    <br>
    <label class="container">Pickup service
        <input type="radio" checked="checked" name="radio">
        <span class="checkmark"></span>
    </label>
    
    <br>

    <label class="container">Delivery service
        <input type="radio" name="radio">
        <span class="checkmark"></span>
    </label>
    
      
    
    <h1>Price</h1>
    <div class="line"></div>

    <div>
        <h3>Regular Wash</h3>

        <?php 
            $order = explode(",", $order);
            $totalprice = 0;
            $tenantid = 0;
            foreach($order as $item){
                $item = explode(":", $item);
                $item_name = $item[0];
                $item_quantity = $item[1];

                $query = "SELECT * FROM laundryservices WHERE serviceName = '$item_name';";
                $select_all_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_query)){
                    $item_price = $row['servicePrice'];
                    $item_category = $row['serviceCategory'];
                    $tenantid = $row['tenantID'];

                    $totalprice += $item_price * $item_quantity;

                    if($item_category == 0){
                        echo "<div id='Price'>";
                        echo "<p>$item_name</p>";
                        echo "<p>$item_quantity</p>";
                        echo "<p>Rp $item_price</p>";
                        echo "</div>";
                    }
                }
            } 
        ?>

        <h3>Express Wash</h3>

        <?php 
            foreach($order as $item){
                $item = explode(":", $item);
                $item_name = $item[0];
                $item_quantity = $item[1];

                $query = "SELECT * FROM laundryservices WHERE serviceName = '$item_name';";
                $select_all_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_query)){
                    $item_price = $row['servicePrice'];
                    $item_category = $row['serviceCategory'];

                    $totalprice += $item_price * $item_quantity;

                    if($item_category == 1){
                        echo "<div id='Price'>";
                        echo "<p>$item_name</p>";
                        echo "<p>$item_quantity</p>";
                        echo "<p>Rp $item_price</p>";
                        echo "</div>";
                    }
                }
            } 
        ?>
    </div>
    <br><br>

    <?php
        $parameterString = $_SERVER['QUERY_STRING'];
        $url = "Confirm.php?" . $parameterString;
    ?>

    <form action="<?php echo $url; ?>" method="POST">

        <?php

            // echo  "<script>console.log('haii')</script>";
            
            if(isset($_POST['submit'])){ 
                
                // echo "<script>console.log('test')</script>";

                $tanggalHariIni = date('Y-m-d H:i:s');
                $userid = $_SESSION['id'];
                $query = "INSERT INTO transactionheader(transactiondate,transactionprice,transactionprogress,usersid,tenantid) VALUES ('$tanggalHariIni', '$totalprice', 0, '$userid', '$tenantid')";
                mysqli_query($connection, $query);

                $query = "SELECT * FROM transactionheader ORDER BY transactiondate DESC LIMIT 1;";
                $select_all_query = mysqli_query($connection, $query);

                if ($select_all_query && mysqli_num_rows($select_all_query) > 0) {
                    $row = mysqli_fetch_assoc($select_all_query);
                    $id = $row['TransactionId'];
                }
                   

                foreach($order as $item){
                    $item = explode(":", $item);
                    $item_name = $item[0];
                    $item_quantity = $item[1];
    
                    $query = "SELECT * FROM laundryservices WHERE serviceName = '$item_name';";
                    $select_all_query = mysqli_query($connection, $query);
    
                    while($row = mysqli_fetch_assoc($select_all_query)){
                        $item_price = $row['servicePrice'];
                        $item_category = $row['serviceCategory'];
                        $serviceid = $row['serviceID'];
                        
                        $query = "INSERT INTO transactiondetail(transactionid,tenantid,serviceid,quantity) VALUES ('$id', '$tenantid', '$serviceid', '$item_quantity')";
                        mysqli_query($connection, $query);
                    }
                } 
                


                header("Location: payment-validation.php?price=$totalprice");
                exit;
            }
        ?>

        <button type="submit" value="submit" name="submit" id="s">Verify</button>

    </form>
    
    <br><br><br>
</body>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const verifyBtn = document.getElementById('verify-btn');

        verifyBtn.addEventListener('click', function() {
            window.location.href = 'payment-validation.php';
        });
    });
</script> -->
</html>
