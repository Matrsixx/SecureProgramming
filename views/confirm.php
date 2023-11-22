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
    <header>
        <?php
            include "../includes/navbar.php";
            require_once "../controller/LaundryController.php";
            require_once "../models/Laundry.php";
            require_once "../utils/Encrypt.php";
            session_start();
        ?>
	</header>

    <div class="bismilah">
        <h1 id="confirm-text">Confirmation Page</h1>

        <div id="top" class="laundry-info">
            <?php
                $laundry = LaundryController::getInstance()->getLaundryById($_GET['id']);
                if ($laundry !== NULL) {
                    $tenant_id = $laundry->getId();
                    $tenant_photo = $laundry->getTenantPhoto();
                    $tenant_name = $laundry->getTenantName();
                    $tenant_address = $laundry->getTenantAddress();
                    $tenant_phone = $laundry->getTenantPhone();
                } else {
                    throw new Exception("Laundry not found");
                }               
                echo "<img src='$tenant_photo' alt='Laundry Image'>";
                echo "<div class='laundry-details'>";
                echo "<h2>$tenant_name</h2>";
                echo "<p>$tenant_address</p>";
                echo "<p>$tenant_phone</p>";
                echo "</div>";
            ?>
        </div>

        <h1>Cart</h1>
        <div class="line"></div>
        <div>
            <h3>Service</h3>
            <?php 
                $order = explode(",", $_GET['orderlist']);
                $totalPrice = 0;
                foreach($order as $item){
                    $item = explode(":", $item);
                    $item_name = $item[0];
                    $item_quantity = $item[1];

                    $service = LaundryController::getInstance()->getServicebyName($item_name);

                    if ($service !== NULL) {
                        $item_price = $service->getServicePrice();
                        $tempPrice = $item_price * $item_quantity;
                        $totalPrice += $tempPrice;
                        echo "<p>$item_name ($item_quantity) @$item_price = $tempPrice</p><br>";
                    } else {
                        throw new Exception("Service not found");
                    }
                }
                echo "<br><p>Total Price: $totalPrice</p>";
            ?>
        </div>
        <br><br>

        <form action="../controller/TransactionController.php" method="POST">

            <?php
                $user_id = Encrypt::decodeJWT($_SESSION['token'])->user_id;
            ?>

            <input type="hidden" name="tenant_id" value="<?php echo $tenant_id; ?>">
            <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

            <button type="submit" value="submit" name="submit" id="s">Check Out</button>

        </form>

        <br><br><br>
    </div>
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
