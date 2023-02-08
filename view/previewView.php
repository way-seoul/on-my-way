<?php
$title = 'ON MY WAY | WELCOME';
ob_start();
?>
<link rel="stylesheet" href="public/app.css">
<link rel="stylesheet" href="public/preview.css">
<script>
    //Common JavaSript Variables which will be used in map.js
    //For Preview Page: Set map defaults to Wcoding
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
<!--Only includes function definitions-->
<script src="public/map.js"></script>
<script defer src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=<?=$db_password = $_SERVER['ONMYWAY_GMAP_KEY'];?>&callback=initMap&v=weekly&libraries=geometry"
      defer>
</script>
<div class="container-md">
    <div class="row gx-5">
        <div class="content-container col-12 col-md-4">
            <div id="info-links-container">
                <div id="sign-up-login-links">
                    <a href="<?= REGISTER_PATH ?>">SIGN UP | </a>
                    <a href="<?= LOGIN_PATH ?>">LOGIN</a>
                </div>
                <div id="app-info">
                    <h1>On My Way</h1> 
                    <p>This is an entertainment app that encourages people to walk out to explore nature and landmarks.</p>
                    <hr>
                </div>
            </div>
            <div id="join-container">
                <a id="join-link" href="<?= REGISTER_PATH ?>">Join Now</a>
            </div>
        </div>
        <div class="map-container col-12 col-md-8">
            <div id="map"></div>
        </div>
    </div>
    <?php
    $html = ob_get_clean(); 
    include 'non-logged-in-template.php';
    ?>
</div>