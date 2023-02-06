<?php
    $highlight = 'color:white; font-weight:bolder';
    $username = 'username';
?>

<header>
    <nav id="menu">
        <ul>
            <li><a href="<?= ROOT ?>" style="<?= $action == '' ? $highlight:'' ?>">On My Way</a></li>
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                <li><a href="<?= LIST_CHALLENGES_PATH ?>" style="<?= $action == 'list-challenges' ? $highlight:'' ?>">Challenges</a></li>
                <li><a href="<?= USER_PROFILE_PATH ?>" style="<?= $action == 'my-profile' ? $highlight:'' ?>">See My Profile</a></li>
            <?php endif ?>
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']
                        && isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                <li><a href="<?= ADMIN_PATH ?>" style="<?= $action == 'admin' ? $highlight:'' ?>">Admin</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <form method="POST" id="login-box">
        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
            if(!isset($_POST['log_out'])) {?>
                <span>
                    Hi <strong><?= $_SESSION['user'] ?></strong>!
                </span>
                <button type="submit" name="log_out">LOG OUT</button>
            <?php }else {
                session_unset();
                session_destroy();
                header('Location: index.php?action=');
            }
        } else {?>
            <a href="<?= LOGIN_PATH ?>" style="margin-right:20px;">log in</a>
        <?php } ?>
    </form>
</header>


