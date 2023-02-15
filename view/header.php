<?php
    $highlight = 'font-family: Source Sans Pro, sans-serif; font-weight: 800;';
    $_GET['action'] = $_GET['action'] ?? '';
?>
<header>
    <nav id="menu">
        <ul>
            <li><a href="<?= ROOT ?>" style="<?= $_GET['action'] == 'home'|| $_GET['action'] == '' ? $highlight:'' ?>">ON MY WAY</a></li>
            <li><a href="<?= LIST_CHALLENGES_PATH ?>" style="<?= $_GET['action'] == 'list-challenges' || $_GET['action'] == 'challenge-specific' ? $highlight:'' ?>">CHALLENGES</a></li>
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <?php endif ?>
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']
                        && isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                <li><a href="<?= ADMIN_PATH ?>" style="<?= $_GET['action'] == 'admin' ? $highlight:'' ?>">ADMIN</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <?php if(isset($_SESSION['user']) && !isset($_POST['log_out'])){ ?>
        <div id="profile_container">
            <div>
                <div>
                    <h3>Welcome, <?= $_SESSION['user'] ?></h3>
                </div>
                <div>
                    <span id="total_points">TOTAL POINTS: <?= $_SESSION['total_points'] ?></span>
                </div>
            </div>
            <div id="profile_toggle_container">
                <input type="checkbox" id="profile_toggle">
                <label id="profile_toggle_label" for="profile_toggle"><img src="./public/image/favicon.ico" alt="profile"></label>
                <ul id="profile_ul">
                    <li><a id="profile_link" href="<?= USER_PROFILE_PATH ?>">MY PROFILE</a></li>
                    <li>
                        <form method="POST" id="login-box">
                            <button id="logout_button" type="submit" name="log_out">LOG OUT</button>
                            <?php }else if(isset($_POST['log_out'])){
                                session_unset();
                                session_destroy();
                                header('Location: index.php?action=');
                            ?>
                            <?php } ?>
                        </form>                   
                    </li>
                </ul>
            </div>
        </div>
</header>
