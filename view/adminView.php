<?php 
    $title = 'ON MY WAY | DASHBOARD';
    ob_start();
?>

<h1>Dashboard</h1>

<h2>Users</h2>
<a href="<?= REGISTER_PATH ?>"
    style="display:block; background-color:black; width:fit-content; padding: 10px; margin: 5px;"
>Add Users ></a>

<table border="1">
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
                    <td><?= $user['admin']==1 ? "YES":"NO"; ?></td>
                    <td><a href="<?= ADMIN_EDIT_PATH ?>&id=<?=$user['id']?>">Edit</a></td>
                    <td><button type="button" class="delete-user" name="delete"
                    data-id="<?= $user['id'] ?>">Delete</button></td>
                    <td><button type="button" class="reset-password" name="reset" data-id=<?= $user['id'] ?>>Reset password</button></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<!-- <h2>Add Users</h2>

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
</form> -->

<br><br>

<h2>Challenges</h2>
<a href="<?= CREATE_CHALLENGE_PATH ?>"
    style="display:block; background-color:black; width:fit-content; padding: 10px; margin: 5px;"
>Add a Challenge ></a>

<form action="<?= ADMIN_PATH ?>" method="POST">
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Challenge Name</th>
                <th>Content</th>
                <th>Conditions</th>
                <th>Points</th>
                <th>Accomplished Users</th>
                <!-- <th>Creator</th> -->
                <th>Created Date</th>
                <th>Updated Date</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($challenges as $challenge) { ?>
            <tr>
                <td><?= $challenge['id']; ?></td>
                <td><a href="<?= CHALLENGE_PATH ?>&id=<?= $challenge['id']; ?>"><?= $challenge['name']; ?></a></td>
                <td><?= $challenge['content']; ?></td>
                <td><?= $challenge['conditions']; ?></td>
                <td><?= $challenge['score']; ?></td>
                <td><?= $challenge['user_count']; ?></td>
                <td><?= $challenge['created_date']; ?></td>
                <td><?= $challenge['updated_date']; ?></td>
                <td>
                    <a href="<?= EDIT_CHALLENGE_PATH ?>&id=<?=$challenge['id']?>">Edit</a>
                </td>
                <td><button type="submit" name="delete-chll" value="<?= $challenge['id']; ?>">DELETE</button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</form>

<br><br>

<h2>Locations</h2>
<a href="<?= ADD_PLACE_PATH ?>"
    style="display:block; background-color:black; width:fit-content; padding: 10px; margin: 5px;"
>Add a Location ></a>
<form action="<?= ADMIN_PATH ?>" method="POST">
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Place Name</th>
                <th>Location</th>
                <th>Challenges</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($places as $place) { ?>
            <tr>
                <td><?= $place['id']; ?></td>
                <td><?= $place['name']; ?></td>
                <td><?= $place['location'] ?></td>
                <td><?= $place['challenges'] ?></td>
                <td><button type="submit" name="delete-Place" value="<?= $place['id'] ?>">DELETE</button></td>
            </tr>
        </tbody>
        <?php } ?>
    </table>
</form>
<br><br>


<?php 
    $html = ob_get_clean();
    include 'template.php';
?>