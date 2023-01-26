<?php 
    $title = "ON MY WAY | Edit";
    ob_start();
?>




<h1>
    Edit form.
</h1>

<div>
</div>

<form method = "POST" action = "" style = "margin-top:3rem">
    <div>
        <span>
                <?= $_SESSION['user'] ?>
        </span>

            username <input type = "text" value = "<?= $_SESSION['user'] ?>"  name = "uname"><br>
            email <input type = "text" name = "email" value = "<?= $_SESSION["email"]?>"><br>
            first name <input type = "text"  name = "firstname" value = "<?= $_SESSION["firstname"]?>"><br>
            last name <input type = "text" name = "lastname" value = "<?= $_SESSION["lastname"]?>"><br>
            password <input type = "password" name = "pwd" value = "password"><br>
            submit  <button type = "submit" name = "submit" value = "sign up"> submit</button>
    </div>

    <div>
        <?= $_POST["uname"];?>
    </div>



</form>

// syntax for phpmyadmin 
INSERT INTO users ( username, first_name, last_name, email) VALUES ('king_james', 'lebron', 'james', 'lbj@gmail.com')


<?php
     $html = ob_get_clean();
?>

<?php
    include  "template.php";
?>