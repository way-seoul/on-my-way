<?php
    include_once './model/usersManager.php';
    $u_manager = new Users();
    $leaders = $u_manager->getLeadingTenUsers();
?>

<h2>Top 10 Leaders</h2>
<div>
    <table border="1">
        <thead>
            <tr>
                <th>Username</th>
                <th>Total Points</th>
                <th>Accomplished Challenges</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($leaders as $leader): ?>
            <tr>
                <td><?= $leader['username'] ?></td>
                <td><?= $leader['points_total'] ?></td>
                <td><?= $leader['challenges'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>