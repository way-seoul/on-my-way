<?php
$title = 'ON MY WAY | WELCOME';
ob_start();
?>
<script>
    //Common JavaSript Variables which will be used in map.js
    //For Preview Page: Set map defaults to Wcoding
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
<!--Only includes function definitions-->
<script src="public/map.js"></script>
<script defer src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=<?=$db_password = $_SERVER['ONMYWAY_GMAP_KEY'];?>&callback=initMap&v=weekly&libraries=geometry"
      defer>
</script>
<h1>Welcome to On My Way</h1>
<h2><a href="<?= REGISTER_PATH ?>">Join Now</a></h2>
<h3>Please click here to <a href="<?= LOGIN_PATH ?>">log in</a> / <a href="<?= REGISTER_PATH ?>">register</a></h3>
<div id="map"></div>
<?php
$html = ob_get_clean(); 
include 'template.php'; // and call the variable from the template
?>