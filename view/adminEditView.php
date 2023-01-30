<?php 
    $title = 'ON MY WAY | EDIT THE USER';
    ob_start();
?>

<h1>Edit The User</h1>
<h2>You're editing user id: <?= $user['id'];?> user name: <?= $user['username'];?></h2>

<div class="btn">
    <button type="button">
    <a href="<?= ADMIN_PATH ?>">See Full List of Users</a>
    </button>
</div>

<form method="POST" action="" style="margin-top: 3rem;">
    <div>
        User Name: <input type="text" name="username" value=<?= isset($user['username'])? $user['username']:" ";?>><br>
        Email: <input type="text" name="email" value=<?= isset($user['email'])? $user['email']:" ";?>><br>
        First Name: <input type="text" name="first_name" value=<?= isset($user['first_name'])? $user['first_name']:" ";?>><br>
        Last Name: <input type="text" name="last_name" value=<?= isset($user['last_name'])? $user['last_name']:" ";?>><br>
        Admin: <input type="text" name="admin" value=<?= isset($user['admin'])? $user['admin']:" ";?>><br>
    </div>
    <div>
        <button type="submit" name="edit" value="edit">Edit User</button>
    </div>
</form>

<?php 
    $html = ob_get_clean();
    include 'template.php';
?>