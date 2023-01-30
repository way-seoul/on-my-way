<?php
$title = 'ON MY WAY | WELCOME';
ob_start();
?>

<h1>Welcome to On My Way</h1>
<h2><a href="<?= REGISTER_PATH ?>">Join Now</a></h2>
<h3>Please click here to <a href="<?= LOGIN_PATH ?>">log in</a> / <a href="<?= REGISTER_PATH ?>">register</a></h3>
<div id="map"></div>


<?php
$html = ob_get_clean(); 
include 'template.php'; // and call the variable from the template
?>