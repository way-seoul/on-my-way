<?php 
    $title = 'ON MY WAY | REGISTER';
    ob_start();
?>

<h1>CREATE AN ACCOUNT</h1>

<form method="POST" action="" style="margin-top: 3rem;">
    <div>
        User Name <input type="text" name="username"/><br>
        Password <input type="text" name="password"/><br>
        Email <input type="text" name="email"/><br>
        First Name <input type="text" name="first_name"/><br>
        Last Name <input type="text" name="last_name"/><br>
    </div>
    <div>
        <button type="submit" name="add" value="add">REGISTER</button>
    </div>
</form>

<div class="btn">
    Already have an account?
    <a href="index.php?action=login">Log In</a>
</div>

<?php 
    $html = ob_get_clean();
?>

<?php 
    include 'template.php';
?>