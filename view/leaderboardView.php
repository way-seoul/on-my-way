<?php 
    $h1 = "LEADERS BOARD";
    $title = 'ON MY WAY | ' . $h1;
    ob_start();
?>

<div class="container form-view">
    <h1><?= $h1 ?></h1>
    <div class="list-box" id="leaders">

        <div class="admin-title">
            <div class="col-12">
                <h2>Top <?= $how_many ?> Leaders</h2>
            </div>
        </div>
        <hr>

        <div class="row">
            <table class="admin-table">
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
                        foreach ($ten_leaders as $leader): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $leader['username'] ?></td>
                        <td><?= $leader['points_total'] ?></td>
                        <td>
                            <?php if($leader['challenge_ids'] != ''): ?>
                                <ol>
                                <?php 
                                    $challenge_ids = explode(',', $leader['challenge_ids']); 
                                    foreach($challenge_ids as $challenge_id):
                                        $challenge = $challenges[$challenge_id];
                                ?>
                                    <li><a href="<?= CHALLENGE_PATH ?>&id=<?= $challenge_id ?>">
                                        <?= $challenge['name'] . " (" . $challenge['score'] . " points)" ?>
                                    </a></li>
                                    <?php endforeach ?>
                                </ol>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php 
    $html = ob_get_clean();
    include 'template.php';
?>