<?php
$title = 'ON MY WAY | WELCOME';
ob_start();
?>

<h1>On My Way</h1>
<h2>Please view existing places & challenges on our map</h2>
<div id="logged-in-map"></div>

<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>