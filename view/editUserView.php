<?php 
    $title = "ON MY WAY | Edit";
    ob_start();
?>




<h1>
    Edit form.
</h1>

<form method = "POST" action = "" style = "margin-top:3rem">
    <div>
        username <input type = "text" value = <?php if(isset($_POST["name"])){echo($_GET["name"]);} ?>  name = "username">
        password <input type = "text" value = " password">
        email <input type = "text" value = "email">
        first name <input type = "text" value = "fname">
        last name <input type = "text" value = "lname">
    </div>
</form>




<?php
     $html = ob_get_clean();
?>

<?PHP
    include  "template.php";
?>