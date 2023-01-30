<?php
$title = 'ON MY WAY | WELCOME';
ob_start();
?>
<script src="public/user-location-home.js" defer></script>
<h1>Welcome to On My Way</h1>
<h2>Please view existing places on our map</h2>
<button id="get-location">
    To Use This App, please share your location
</button>

<h1>On My Way</h1>
<h2>Please view existing places & challenges on our map</h2>
<div id="logged-in-map"></div>
<div id="map"></div>

<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>