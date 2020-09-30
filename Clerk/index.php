<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/slider.css">
    <link rel="stylesheet" href="clerk.css">
    <script src="https://kit.fontawesome.com/2b554022ef.js" crossorigin="anonymous"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css' rel='stylesheet' />
    <title>Repairs</title>

</head>

<body>

    <nav class="sidebar">
        <!-- <h2 class="link-text">MENU</h2> -->
        <ul>
            <li class="nav-logo"><span class="nav-link" href="#"><i class="fas fa-lightbulb"></i><span class="link-text" style="margin-left: 5px;">LiFix</span> </span>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-home"></i><span class="link-text">Home</span> </a></li>
            <li class="nav-item"><a class="nav-link active" href="#"><i class="fas fa-columns"></i><span class="link-text">DailyRepairs</span> </a></li>
            <li class="nav-item"><a class="nav-link" href="./repairHistory.html"><i class="fas fa-history"></i><span class="link-text">RepairHistory</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-file-invoice"></i><span class="link-text">Purchases</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-plus-square"></i><span class="link-text">LampPost</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-cog"></i><span class="link-text">Settings</span></a></li>

        </ul>

    </nav>



    <div class="main_content">
        <header>
            <h1>Available Repairs</h1>
        </header>
        <div class="main">

            <div class="list-section">
                <div class="lists">
                    <?php include "getAvailRepairs.php" ?>
                </div>
                <!-- <button style="margin-top: 10px;" onclick="AssignRepairs()">Assign</button> -->
            </div>

            <div id="map" class="map-section"></div>

        </div>
    </div>

    <!-- load map from mapbox api -->
    <script>
        let markerArr = new Map()



        mapboxgl.accessToken = 'pk.eyJ1IjoibGFrc2hhbnM5OCIsImEiOiJja2J4aXc1ZGowMXlnMnlsbXN5bGNhczEwIn0.c7hzHhRTqXx4CycvscjHww';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [79.861489, 6.885039],
            zoom: 14
        });



        // var marke2 = new mapboxgl.Marker()
        //     .setLngLat([79.854770, 6.891551])
        //     .addTo(map);
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                mapdata = JSON.parse(this.responseText);
                // console.log(mapdata);
                // add markers to the map
                mapdata.forEach(mk => {


                    var marker = new mapboxgl.Marker({
                            color: "black"
                            // color: "#3FB1CE"
                        })
                        .setLngLat([mk.longitude, mk.lattitude])
                        .addTo(map);
                    // markerArr['id' + mk.repair_id] = mk;
                    markerArr.set(mk.repair_id, marker);
                });

            }
        };
        xmlhttp.open("GET", "getMapdata.php", true);
        xmlhttp.send();
    </script>
    <script src="app.js"></script>
</body>

</html>