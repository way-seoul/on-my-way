<?php
$title = 'ON MY WAY | WELCOME';
ob_start();
?>
<link rel="stylesheet" href="public/prev-home.css">
<link rel="stylesheet" href="public/home-view.css">
<script>
     //Common JavaSript Variables which will be used in map.js
    //For Home Page: Set to Wcoding by defulat
    //NOTE: THESE VALUES WILL BE OVERWRITTEN ONCE THE USER SHARES THEIR LOCATION!
    let mapOptions = {
        disableDefaultUI: true,
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
<div class="container-md">
    <div class="row gx-5">
        <div class="content-container col-12 col-md-5">
            <div class="title">
                <h1>Welcome to On My Way</h1>
            </div>
            <div class="controls">
                <button class="green-btn" id="get-location">
                    Click To View Places Near You
                </button>
                <p>In Order To Use Our App, you must share your location</p>
                <div id="resultMessageContainer">
                    <h6 id="resultMsg"></h6>
                    <ul id="placeResults"></ul>
                </div>
            </div>
        </div>
        <div class="map-container col-12 col-md-7">
            <div id="map"></div>
        </div>
    </div>
</div>
<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>