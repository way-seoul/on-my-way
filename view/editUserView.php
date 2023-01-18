<?php 
    $title = "ON MY WAY | Edit";
    ob_start();
?>




<h1>
    Edit form.
</h1>

<div>
    <?php
       if($_SERVER["REQUEST_METHOD"] == "GET"){
        header("location:index.php");
       }else
    
    ?>
</div>

<form method = "POST" action = "" style = "margin-top:3rem">
    <div>
            username <input type = "text" value = <?php if(isset($_POST["name"])){echo($_GET["name"]);} ?>  name = "username">
            password <input type = "text" name = "password" value = " password">
            email <input type = "text" name = "email" value = "email">
            first name <input type = "text"  name = "firstname" value = "fname">
            last name <input type = "text" name = "lastname" value = "lname">
        submit  <input type = "submit" name = "create" value = "sign up">
    </div>
</form>




<?php
     $html = ob_get_clean();
?>

<?PHP
    include  "template.php";
?>