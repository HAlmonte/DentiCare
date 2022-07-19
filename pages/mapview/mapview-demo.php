<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script src="./index.js"></script>
      <style>
          /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
          height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
      </style>
  </head>
  <body>
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtLEZFNhRsFQfIAB9F7wKfVutlKORa6NQ&callback=initMap&v=weekly" async></script>
      <script>          
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
          } else { 
              alert("Geolocation is not supported by this browser.");
          }
          var latitude;
          var longitude;
          function showPosition(position) {
              latitude = position.coords.latitude;
              longitude = position.coords.longitude;
              initMap();
          }
          
          function initMap() {
              const myLatLng = { lat: latitude, lng: longitude };
              const map = new google.maps.Map(document.getElementById("map"), {
                  zoom: 13,
                  center: myLatLng,
                  });

              new google.maps.Marker({
                  position: myLatLng,
                  map,
                  title: "Your Location",
              });
              
              <?php
              require_once '../database&config/config.php';
                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="SELECT clinic_name, latitude, longitude FROM tbl_clinic";
                $qry=$cn->prepare($sql);
                $qry->execute();
                $qry->bind_result($clinic_name, $latitude, $longitude);
                $qry->store_result();
                $num = 0;
                while ($qry->fetch()){
                    echo "
                    const clinicLatLng$num = { lat: $latitude, lng: $longitude };
                    new google.maps.Marker({
                    position: clinicLatLng$num,
                    map,
                    title: '$clinic_name',
                    });
                    ";
                    $num++;
                }
              
              ?>
                          
          }
      </script>
  </body>
</html>