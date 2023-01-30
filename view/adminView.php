<?php 
    $title = 'ON MY WAY | DASHBOARD';
    ob_start();
?>

<h1>Dashboard</h1>

<div class="btn">
    <button type="button">
    <a href="<?= LOGIN_PATH ?>">Log Out</a>
    </button>
</div>

<h2>Manage Users</h2>

<table border="1" style="margin-bottom: 15rem;">
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Created Date</th>
            <th>Admin</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?= $user['id']; ?></td>
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['first_name']; ?></td>
                    <td><?= $user['last_name']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['created_date']; ?></td>
                    <td><?= $user['admin']; ?></td>
                    <td><a href="<?= ADMIN_EDIT_PATH ?>&id=<?=$user['id']?>">Edit</a></td>
                    <td><button type="button" class="delete-user" name="delete"
                    data-id="<?= $user['id'] ?>">Delete</button></td>
                    <td><button type="button" class="reset-password" name="reset" data-id=<?= $user['id'] ?>>Reset password</button></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<h2>Add Users</h2>

<form method="POST" action="" style="margin-top: 3rem;">
    <div>
        User Name <input type="text" name="username"/><br>
        Password <input type="text" name="password"/><br>
        Email <input type="text" name="email"/><br>
        First Name <input type="text" name="first_name"/><br>
        Last Name <input type="text" name="last_name"/><br>
    </div>
    <div>
        <button type="submit" name="add" value="add">Add A New User</button>
    </div>
</form>

<h2>Manage Challenges</h2>
<a href="<?= LIST_CHALLENGES_PATH ?>">Challenges List page</a> <!-- this is for convenience -->
<!-- list of challenges: Add/Edit/Delete Challenges -->

<?php 
    $html = ob_get_clean();
    include 'template.php';
?>