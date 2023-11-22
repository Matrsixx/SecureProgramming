<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dry-It</title>
        <link rel="stylesheet" href="Home.css">
        <link rel="shortcut icon" href="https://cdn.discordapp.com/attachments/524461320314028052/1090297730372472842/LogoSEcropped.png" type="image/x-icon">
    </head>
    <body>
    <!-- Header -->
        <header>
            <div class="logo">
                <img src="https://cdn.discordapp.com/attachments/524461320314028052/1090298933110124737/logo2.png" alt="Dry-It Logo">
            </div>
            
            <nav>
                <ul>
                <li><a href="Home.php">Home</a></li>
                <li><a href="./transaction.php">Transaction</a></li>
                <li class="profile">
                    <a href="#">Profile</a>
                    <ul>
                    <li><a href="profile.php">View Profile</a></li>
                    <li><a href="actions/doLogout.php">Logout</a></li>
                    </ul>
                </li>
                </ul>
            </nav>
            
            <div class="location">
                <p>Lokasi Anda:</p>

                <button class="btn-location" id="location"></button>
            
                <script>
                var x = document.getElementById("location");

                function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, errorCallback => {
                    console.log(errorCallback);
                    x.innerHTML = "Please allow location access";
                    }, {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                    });
                } else { 
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
                }
                
                var lat = 0;
                var lon = 0;

                function showPosition(position) {
                clearTimeout(setTimeout("geolocFail()", 10000));

                lat = position.coords.latitude;
                lon = position.coords.longitude;
                var api = "1ecf70f59a484579831a92c9331e4e4e";
                
                var requestOptions = {
                    method: 'GET',
                };
                
                fetch("https://api.geoapify.com/v1/geocode/reverse?lat=" + lat + "&lon=" + lon + "&apiKey=" + api, requestOptions)
                    .then(response => response.json())
                    .then((result) => {
                    var type = result.features[0].properties.result_type;
                    var name = result.features[0].properties.name;
                    var street = result.features[0].properties.street;
                    // x.innerHTML = lat + ',' + lon + "<br> " + address;
                    console.log(lat + ',' + lon);
                    if (name == street || name == null) {
                        x.innerHTML = street;
                    } else {
                        x.innerHTML = name + "<br>" + street;
                    }
                    
                    })
                    .catch(error => {
                    console.log('error', error);
                    x.innerHTML = "Geolocation is not supported by this browser.";
                    });
                
                }

                window.onload = function() {
                getLocation();
                };
                </script>
            </div>
        </header>
    </body>
</html>
