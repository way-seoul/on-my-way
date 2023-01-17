<?php
$title = 'ON MY WAY | WELCOME';
ob_start();
?>

<h1>Welcome to On My Way</h1>
<h2><a href="../on-my-way/index.php?action=register">Join Now</a></h2>
<h3>Please click here to login / <a href="../on-my-way/index.php?action=register">register</a></h3>
<div id="map"></div>


<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>