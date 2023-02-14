<?php
    $highlight = 'font-family: Eastman-bold';
    $_GET['action'] = $_GET['action'] ?? '';
?>
<header>
    <nav id="menu">
        <ul>
            <li><a href="<?= ROOT ?>" style="<?= $_GET['action'] == 'home'|| $_GET['action'] == '' ? $highlight:'' ?>">ON MY WAY</a></li>
            <li><a href="<?= LIST_CHALLENGES_PATH ?>" style="<?= $_GET['action'] == 'list-challenges' || $_GET['action'] == 'challenge-specific' ? $highlight:'' ?>">CHALLENGES</a></li>
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                <li><a href="<?= USER_PROFILE_PATH ?>" style="<?= $_GET['action'] == 'my-profile' ? $highlight:'' ?>">MY PROFILE</a></li>
            <?php endif ?>
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']
                        && isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                <li><a href="<?= ADMIN_PATH ?>" style="<?= $_GET['action'] == 'admin' ? $highlight:'' ?>">ADMIN</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <?php if(isset($_SESSION['user']) && !isset($_POST['log_out'])){ ?>
        <div>
            <div style="position: relative; margin-right: 20px;">
                <input type="checkbox" id="profile_toggle">
                <label id="profile_toggle_label" for="profile_toggle"><img src="./public/image/favicon.ico" alt="profile"></label>
                <ul id="profile_ul">
                    <li>
                        <form method="POST" id="login-box">
                            <button id="logout_button" type="submit" name="log_out">LOG OUT</button>
                            <?php }else if(isset($_POST['log_out'])){
                                session_unset();
                                session_destroy();
                                ?>
                                <!-- Include FirebaseUI -->
                                <script src="https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth.js"></script>
                                <!-- Add firebase to the project from Google FirebaseUI -->
                                <script src="https://www.gstatic.com/firebasejs/8.0/firebase.js"></script>
                                <script>
                                    // Define api key & re-direct URL and make them readable thru JS
                                    var googleLoginAPIKey = "<?= $_SERVER['ONMYWAY_GLOGIN_KEY']; ?>";
                                    var redirectURL = "<?= ROOT ?>";
                                </script>
                                <script src ="public/google-logout.js"></script>
                                <?php
                                //header('Location: index.php?action=');
                                ?>
                            <?php } ?>
                        </form>                   
                    </li>
                </ul>
            </div>
        </div>
</header>
