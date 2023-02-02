<?php
    $highlight = 'color:white; font-weight:bolder';
    $username = 'username';
?>

<header>
    <nav id="menu">
        <ul>
            <li><a href="<?= ROOT ?>" style="<?= $action == '' ? $highlight:'' ?>">On My Way</a></li>
            <li><a href="<?= LIST_CHALLENGES_PATH ?>" style ="<?= $action == '' ? $hightlight:'' ?>">Challenges</a></li>
            <?php if(isset($_SESSION['logged_in'])){ ?>
                <li><a href="<?= CREATE_CHALLENGE_PATH ?>" style="<?= $action == 'create-challenge' ? $highlight:'' ?>">Add challenge</a></li>
                <li><a href="<?= USER_PROFILE_PATH ?>" style="<?= $action == 'my-profile' ? $highlight:'' ?>">See My Profile</a></li>
                <?php if(isset($_SESSION['logged_in']) && $_SESSION['admin'] == true ){?>
                    <li><a href="<?= ADMIN_PATH ?>" style="<?= $action == 'admin' ? $highlight:'' ?>">Admin</a></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </nav>
    <?php if(!isset($_SESSION['user'])){?>
        <form method="POST" action="<?= LOGIN_PATH ?>">
            <input type="text" name="username_header" placeholder="Username" required>
            <input type="password" name="password_header" placeholder="Password" required>
            <button name="login_button_header">Log In</button>
        </form>
    <?php }else if(isset($_SESSION['user']) && !isset($_POST['log_out'])){ ?>
        <form method="POST" id="login-box">
            <span>
                Hi <strong><?= $_SESSION['user'] ?></strong>!
            </span>
            <button type="submit" name="log_out">LOG OUT</button>
    <?php }else if(isset($_POST['log_out'])){
        session_unset();
        session_destroy();
        header('Location: index.php?action=');
    ?>
    <?php } ?>
        </form>
</header>