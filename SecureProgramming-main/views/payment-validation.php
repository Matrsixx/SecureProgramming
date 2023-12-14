<!DOCTYPE html>
<html>
<head>
	<title>Dry-It! | Payment</title>
	<link rel="stylesheet" type="text/css" href="../styles/payment-validation.css">
  <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090297730372472842/LogoSEcropped.png" type="image/x-icon">
</head>
<body>
	<!-- <header>
        <div class="logo">
          <img src="https://media.discordapp.net/attachments/524461320314028052/1090298933110124737/logo2.png" alt="Dry-It Logo">
        </div>
        
        <nav>
          <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="Transaction.php">Transaction</a></li>
            <li class="profile">
              <a href="#">Profile</a>
              <ul>
                <li><a href="profile.php">View Profile</a></li>
                <li><a href="#">Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
	</header> -->

	<main>
      <div class="container">
            <h1>Total Pembayaran</h1>
            <div class="total">Rp. <?php echo $_GET["price"]?></div>
              <h2>Masukkan Kode Promo</h2>
              <form>
                <input type="text" placeholder="Masukkan kode promo">
                <button type="submit">Gunakan Kode</button>
              </form>
              <h2>Pilih Metode Pembayaran</h2>
            <div class="metode">
              <div class="card">
                <a href="#" style="text-decoration: none;" onclick="openPopup('popup')">
                    <img src="https://cdn.discordapp.com/attachments/1075754942071050372/1120539593117274203/qr_Toko_karunia_20.06.23_1687227571_cropped.jpg" alt="Qris">
                    <div class="card-name">Qris</div>
                </a>
              </div>
            </div>
            <br>
            <a href="Home.php">
              <button type="submit">Done</button>
            </a>
        </div>

        <div class="blurred-background">
          <div class="popup-container">
            <div id="popup" class="popup">
              <img src="https://cdn.discordapp.com/attachments/1075754942071050372/1120539593117274203/qr_Toko_karunia_20.06.23_1687227571_cropped.jpg" alt="Qris">
              <h1>Scan QRIS</h1>
              <button onclick="closePopup('popup')">Close</button>
            </div>
          </div>
        </div>

	</main>
</body>

<script>
    function openPopup(popupId) {
      var popup = document.getElementById(popupId);
      popup.style.display = "block";
      document.body.classList.add("popup-active");
    }

    function closePopup(popupId) {
      var popup = document.getElementById(popupId);
      popup.style.display = "none";
      document.body.classList.remove("popup-active");
    }

    </script>
</html>
