<?php
    $highlight = 'color:white; font-weight:bolder';
    $username = 'username';
?>

<header>
    <nav id="menu">
        <ul>
            <li><a href="<?= $root ?>" style="<?= $action == '' ? $highlight:'' ?>">On My Way</a></li>
            <li><a href="<?= $createChallenge_path ?>" style="<?= $action == 'create-challenge' ? $highlight:'' ?>">Add challenge</a></li>
            <!-- if loggedin then show this -->
                <li><a href="<?= $$userProfile_path ?>" style="<?= $action == 'my-profile' ? $highlight:'' ?>">See My Profile</a></li>
            <!-- end if -->
            <!-- if the user is admin == true, let's delete this link later and just send the admin directly to admin page -->
                <li><a href="<?= $admin_path ?>" style="<?= $action == 'admin' ? $highlight:'' ?>">Admin</a></li>
            <!-- end if -->
        </ul>
    </nav>
    <form method="POST" id="login-box">
        <!-- if loggedin then show this -->
        <?php if(isset($_SESSION['user']) && !isset($_POST['log_out'])){?>
            <span>
                Hi <strong><?= $_SESSION['user'] ?></strong>!
            </span>
            <button type="submit" name="log_out">LOG OUT</button>
        <!-- end if -->
        <!-- else if not loggedin then show this -->
        <?php }else if(isset($_POST['log_out']) || !isset($_SESSION['user'])){
            session_destroy();
        ?>
            
        <!-- end if -->
        <?php } ?>
    </form>
</header>