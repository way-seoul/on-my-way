<?php

    $title = 'ON MY WAY | REGISTER';
    ob_start();
?>

<h1>CREATE AN ACCOUNT</h1>

<form method="POST" action="" style="margin-top: 3rem;">
    <div>
        User Name <input type="text" name="username"/><br>
        Password <input type="text" name="password" value="<?= (isset($fromAdmin) && $fromAdmin == 1) ? "0000":'' ?>"/><br>
        Email <input type="text" name="email"/><br>
        First Name <input type="text" name="first_name"/><br>
        Last Name <input type="text" name="last_name"/><br>
        <?php if(isset($fromAdmin) && $fromAdmin == 1): ?>
            Admin?
            <input type="radio" name="admin" id="yes" value="1">
            <label for="yes">YES</label>
            <input type="radio" name="admin" id="no" value="0">
            <label for="no">NO</label>
        <?php endif?>
    </div>
    <div>
        <button type="submit" name="add" value="add">REGISTER</button>
    </div>
</form>

<?php if(!isset($fromAdmin)): ?>
<div class="btn">
    Already have an account?
    <a href="<?= LOGIN_PATH ?>">Log In</a>
</div>
<?php endif ?>

<?php 
    $html = ob_get_clean();
    include 'template.php';
    if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['user'])){
        //header('Location: index.php?action=create-challenge');
    }
?>