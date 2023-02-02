<?php
$title = 'ON MY WAY | WELCOME';
ob_start();
?>
<script>
     //Common JavaSript Variables which will be used in map.js
    //For Home Page: Set to Wcoding by defulat
    //NOTE: THESE VALUES WILL BE OVERWRITTEN ONCE THE USER SHARES THEIR LOCATION!
    let mapOptions = {
        zoom: 16,
        center: 
            { 
                lat: 37.53622850959400, lng: 126.894975568805080 
            }
    };
    let mapMarkers =
    [
        {name: 'Sample Place 1', lat: 37.53622850959400, lng: 126.894975568805080},
        {name: 'Sample Place 2', lat: 37.537053744792225, lng: 126.896220113787990}
    ]; 
</script>
<script src="public/user-location-home.js" defer></script>
<script src="public/map.js" defer></script>
<script defer src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=<?=$db_password = $_SERVER['ONMYWAY_GMAP_KEY'];?>&callback=initMap&v=weekly&libraries=geometry"
      defer>
</script>
<h1>Welcome to On My Way</h1>
<h2>Please view existing places on our map</h2>
<h5>In Order To Use Our App, you must share your location</h5>
<button id="get-location">
    Click To Share Location
</button>
<div>
    <p id="resultMessageContainer"></p>
</div>
<div id="map"></div>
<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>