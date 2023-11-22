<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dry-It | Dashboard</title>
    <link rel="stylesheet" href="../styles/laundry-service.css">
    <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090297730372472842/LogoSEcropped.png" type="image/x-icon">
  </head>
  <body>
    <!-- Header -->
    <header>
      <?php
        include "../includes/navbar.php";
        require_once "../controller/LaundryController.php";
        session_start();

        if(!isset($_SESSION['token'])){

          $_SESSION['error'] = "Authentication Error!";
          header('Location: ../index.php');
          exit();
        }
      ?>
    </header>

    <section class="search">
        <div class="container">
          <div class="laundry-info">
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
          </div>
        </div>
      </section>
    

    <!-- Cari Laundry -->
        
      <section class="search">
        <div class="container">
          <div class="wash-type">
            <h2>Service</h2>
            <div class="prices">
              <?php
                $service = LaundryController::getInstance()->getService();
                foreach ($service as $item) {
                  $service_id = $item->getId();
                  $service_name = $item->getServiceName();
                  $service_price = $item->getServicePrice();

                  echo "<div class='price'>";
                  echo "<span>$service_name</span>";
                  echo "<div class='price-laundry'>";
                  echo "<span>Rp. $service_price</span>";
                  echo "</div>";
                  echo "<div class='quantity'>";
                  echo "<button class='minus-btn'>-</button>";
                  echo "<input type='text' value='0' />";
                  echo "<button class='plus-btn'>+</button>";
                  echo "</div>";
                  echo "</div>";
                }
              ?>
              <!-- Add more price elements here -->
            </div>
          </div>
        </div>
      </section>
      

      <div class="order-list">
        <h2>Order List</h2>
        <ul class="items-list">
          <!-- Selected items will be dynamically added here -->
        </ul>
      </div>
  
      <button id="confirm-btn">Confirm</button>
      

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          const minusBtns = document.querySelectorAll('.minus-btn');
          const plusBtns = document.querySelectorAll('.plus-btn');
          const itemsList = document.querySelector('.items-list');
          const confirmBtn = document.getElementById('confirm-btn');

          // Tambahkan event listener untuk tombol minus
          minusBtns.forEach(function(minusBtn) {
            minusBtn.addEventListener('click', function() {
              let quantityInput = this.nextElementSibling;
              let currentValue = parseInt(quantityInput.value);

              if (currentValue !== 0) {
                currentValue--;
                quantityInput.value = currentValue;
                updateOrderList();
              }
            });
          });

          // Tambahkan event listener untuk tombol plus
          plusBtns.forEach(function(plusBtn) {
            plusBtn.addEventListener('click', function() {
              let quantityInput = this.previousElementSibling;
              let currentValue = parseInt(quantityInput.value);

              currentValue++;
              quantityInput.value = currentValue;
              updateOrderList();
            });
          });

          var url = '';
          
          // Update order list
          function updateOrderList() {
            itemsList.innerHTML = ''; // Clear previous items

            //array to store data
            let orderList = [];

            // Get all quantity inputs
            const quantityInputs = document.querySelectorAll('.quantity input');

            // Loop through each quantity input
            quantityInputs.forEach(function(quantityInput) {
              let quantityValue = parseInt(quantityInput.value);

              // If quantity is greater than 0, add it to the order list
              if (quantityValue > 0) {
                let serviceName = quantityInput.closest('.price').querySelector('span').innerText;
                let listItem = document.createElement('li');
                listItem.innerText = serviceName + ' : ' + quantityValue;
                listItem.style.marginBottom = '10px'; // Add margin to the list item
                itemsList.appendChild(listItem);

                orderList.push(serviceName + ':' + quantityValue);
              }
            });

            let orderListString = orderList.join(',');
            url = "./confirm.php?id=<?php echo $tenant_id; ?>&orderlist=" + encodeURIComponent(orderListString);
            confirmBtn.setAttribute('href', url);
          }

          // Event listener for confirm button
          confirmBtn.addEventListener('click', function() {
            // window.location.href = "Confirm.php?id=<?php echo base64_encode($tenant_id); ?>&name=<?php echo urlencode($tenant_name); ?>&address=<?php echo urlencode($tenant_address); ?>&photo=<?php echo urlencode($tenant_photo); ?>&phone=<?php echo urlencode($tenant_phone) ?>";
            window.location.href = url;
          });
        });
      </script>

  </body>
</html>