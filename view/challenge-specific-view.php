<?php
$title = 'ON MY WAY | '.$challenge['name'];
ob_start();
?>

<h1><?= $challenge['name'] ?></h1>
<div id="challenge">
    <p>This challenge belongs to <strong><?= $place['name'] ?></strong></p>
</div>


<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>