<?php
$title = 'ON MY WAY | WELCOME';
ob_start();
?>
<script src="public/user-location-home.js" defer></script>
<h1>Welcome to On My Way</h1>
<h2>Please view existing places on our map</h2>
<h5>In Order To Use Our App, you must share your location</h5>
<button id="get-location">
    Click To Share Location
</button>
<div>
    <p id="resultMessageContainer"></p>
</div>
<div id="logged-in-map"></div>
<div id="map"></div>

<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>