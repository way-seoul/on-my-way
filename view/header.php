<?php
    $highlight = 'color:white; font-weight:bolder';
    $_GET['action'] = $_GET['action'] ?? '';
?>
<header>
    <nav id="menu">
        <ul>
            <li><a href="<?= ROOT ?>" style="<?= $_GET['action'] == 'home'|| $_GET['action'] == '' ? $highlight:'' ?>">On My Way</a></li>
            <li><a href="<?= LIST_CHALLENGES_PATH ?>" style="<?= $_GET['action'] == 'list-challenges' ? $highlight:'' ?>">Challenges</a></li>
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                <li><a href="<?= USER_PROFILE_PATH ?>" style="<?= $_GET['action'] == 'my-profile' ? $highlight:'' ?>">See My Profile</a></li>
            <?php endif ?>
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']
                        && isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                <li><a href="<?= ADMIN_PATH ?>" style="<?= $_GET['action'] == 'admin' ? $highlight:'' ?>">Admin</a></li>
            <?php endif ?>
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
