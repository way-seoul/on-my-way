<?php 
    $title = 'Welcome Page';
    ob_start();
?>

<h1>Welcome to On My Way</h1>
<h2>Please view existing places on our map</h2>
<h3>Please click here to login / <a href="<?= $register_path ?>">register</a></h3>

<?php
    $html = ob_get_clean(); // give the code into a variable
    include 'template.php'; // and call the variable from the template
?>