<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dry-It | Transaction</title>
    <link rel="stylesheet" href="../styles/transaction.css">
    <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090297730372472842/LogoSEcropped.png" type="image/x-icon">
  </head>
  <body>
    <header>
      <?php include "../includes/navbar.php" ?>
    </header>

    <div class="tab">
    
      <form action="../actions/doTransaction.php" method="POST">
        <button class="tablinks" id="lefttab" type="submit" value="Ongoing" name="ongoingsubmit"><h3>Ongoing Transaction</h3></button>
        <button class="tablinks" id="righttab" type="submit" value="Past" name="pastsubmit"><h3>Past Transaction</h3></button>
      </form>
      <!-- <div id="tab1" class="tabcontent"> -->
        <div>
          <?php
              session_start();
              for($i = 0; $i < $_SESSION['count']; $i++){    
            ?>
            <div class="laundry container">
              <div class="leftcolumn">
                <!-- <img src="<?php echo $_SESSION['Data'][$i][5]?>" alt="Laundry 1">  -->
              </div>
              <div class="middlecolumn">
                <div class="info">
                  <h3><?php echo $_SESSION['Data'][$i][2] ?></h3>
                  <p><?php echo $_SESSION['Data'][$i][3] ?></p>
                </div>
              </div>
              <div class="rightcolumn">
                <div class="info">
                  <p><?php 
                  $date = strtotime($_SESSION['Data'][$i][0]);
                  echo date("d - m - Y", $date);
                  ?></p>
                  <p><?php 
                    // if ($transaction_progress == 0) {
                    //   echo "On Progress";
                    // }
                  ?></p>
                  <p><?php echo 'Rp ', $_SESSION['Data'][$i][1]?></p>
                </div>
              </div>
              <button id="order-received-btn" onclick="onChangeProgress(<?php echo $transaction_id; ?>)">Order Received</button>
            </div>
            <?php } ?>
        </div>
      </div>

 
</body>

</html>