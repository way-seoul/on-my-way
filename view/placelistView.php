<?php
$title = 'Places List';
ob_start();
?>



<?php
    $html = ob_get_clean(); // give the code into a variable
    include '_template.php'; // and call the variable from the template
?>