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
      <button class="tablinks" id="lefttab" onclick="openTab(event, 'tab1')"><h3>Ongoing Transaction</h3></button>
      <button class="tablinks" id="righttab" onclick="openTab(event, 'tab2')"><h3>Past Transaction</h3></button>

      <div id="tab1" class="tabcontent">
        <div>
          <?php
              include "Includes/db.php";

              session_start();
              $id = $_SESSION['id'];
              $query = "SELECT * FROM transactionheader JOIN tenant ON transactionheader.TenantId = tenant.id JOIN users ON transactionheader.usersid = users.id WHERE transactionheader.TransactionProgress = 0 AND transactionheader.usersid = $id;";

              $select_all_query = mysqli_query($connection, $query);

              while($row = mysqli_fetch_assoc($select_all_query)){
                $tenant_name = $row['name'];
                $tenant_address = $row['address'];
                $tenant_photo = $row['Photo'];
                $tenant_phone = $row['phone'];
                $transaction_id = $row['TransactionId'];
                $transaction_date = $row['TransactionDate'];
                $transaction_progress = $row['TransactionProgress'];
                $transaction_price = $row['TransactionPrice'];
            ?>
            <div class="laundry container">
              <div class="leftcolumn">
                <img src="<?php echo $tenant_photo ?>" alt="Laundry 1">
              </div>
              <div class="middlecolumn">
                <div class="info">
                  <h3><?php echo $tenant_name ?></h3>
                  <p><?php echo $tenant_address ?></p>
                  <p><?php echo $tenant_phone ?></p>
                </div>
              </div>
              <div class="rightcolumn">
                <div class="info">
                  <p><?php 
                  $date = strtotime($transaction_date);
                  echo date("d - m - Y", $date);
                  ?></p>
                  <p><?php 
                    if ($transaction_progress == 0) {
                      echo "On Progress";
                    }
                  ?></p>
                  <p><?php echo 'Rp ', $transaction_price?></p>
                </div>
              </div>
              <button id="order-received-btn" onclick="onChangeProgress(<?php echo $transaction_id; ?>)">Order Received</button>
            </div>
            <?php } ?>
        </div>
      </div>

      <div id="tab2" class="tabcontent">
      <div>
          <?php
              include "Includes/db.php";

              $id = $_SESSION['id'];
              $query = "SELECT * FROM transactionheader JOIN tenant ON transactionheader.TenantId = tenant.id JOIN users ON transactionheader.usersid = users.id WHERE transactionheader.TransactionProgress = 1 AND transactionheader.usersid = $id;";

              $select_all_query = mysqli_query($connection, $query);

              while($row = mysqli_fetch_assoc($select_all_query)){
                $tenant_name = $row['name'];
                $tenant_address = $row['address'];
                $tenant_photo = $row['Photo'];
                $tenant_phone = $row['phone'];
                $transaction_date = $row['TransactionDate'];
                $transaction_progress = $row['TransactionProgress'];
                $transaction_price = $row['TransactionPrice'];
            ?>
            <div class="laundry container">
              <div class="leftcolumn">
                <img src="<?php echo $tenant_photo ?>" alt="Laundry 1">
              </div>
              <div class="middlecolumn">
                <div class="info">
                  <h3><?php echo $tenant_name ?></h3>
                    <p><?php echo $tenant_address ?></p>
                    <p><?php echo $tenant_phone ?></p>
                </div>
              </div>
              <div class="rightcolumn">
                <div class="info">
                  <p><?php 
                  $date = strtotime($transaction_date);
                  echo date("d - m - Y", $date);
                  ?></p>
                  <p><?php 
                    if ($transaction_progress == 1) {
                      echo "Order Completed";
                    }
                  ?></p>
                  <p><?php echo 'Rp ', $transaction_price?></p>
                </div>
              </div>
            </div>

            <?php } ?>
        </div>
      </div>
    </div>

    <?php
      include "Includes/db.php";

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];

        $query = "UPDATE transactionheader SET TransactionProgress = 1 WHERE TransactionId = $id;";
        $update_query = mysqli_query($connection, $query);

        // if ($update_query) {
        //   echo "Success";
        // } else {
        //   echo "Error";
        // }
      }
    ?>

    
    <script>
        function openDefaultTab() {
          document.getElementById("lefttab").click();
        }

        function openTab(evt, tabName) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " active";
        }

        document.addEventListener("DOMContentLoaded", openDefaultTab);

        function onChangeProgress(id) {
          var xhr = new XMLHttpRequest();
          var url = 'Transaction.php';
          var method = 'POST';
          var data = new FormData();
          data.append('id', id);
          xhr.open(method, url, true);

          xhr.onload = function() {
            if (xhr.status === 200) {
              location.reload();
            } else {
              console.error('Error: ' + xhr.status);
            }
          };

          xhr.send(data);
        }

  </script>
</body>

</html>