<?php
    include_once './model/usersManager.php';
    $u_manager = new Users();
    $leaders = $u_manager->getLeadingTenUsers();
?>

<div class="admin-title">
    <div class="col-12">
        <h2 style="text-align: center;">Top 10 Leaders</h2>
    </div>
</div>

<div class="row">
    <table class="admin-table" style="text-align: center;">
        <thead>
            <tr>
                <th>RANK</th>
                <th>USERNAME</th>
                <th>TOTAL POINTS</th>
                <th>ACCOMPLISHMENTS</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
                foreach ($leaders as $leader): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $leader['username'] ?></td>
                <td><?= $leader['points_total'] ?></td>
                <td><?= $leader['challenges'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>