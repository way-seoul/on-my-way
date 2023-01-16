<header>
    <nav id="menu">
        <ul>
            <li><a href="../on-my-way/index.php">On My Way</a></li>
            <li><a href="../on-my-way/index.php?action=create-challenge">Add challenge</a></li>
            <li><a href="../on-my-way/index.php?action=my-profile">See My Profile</a></li>
        </ul>
    </nav>
    <form method="POST" id="login-box">
        <!-- if loggedin then show this -->
        <?php if($login){?>
            <span>
                Hi <strong><?= $_SESSION['user'] ?></strong>!
            </span>
            <button type="submit" name="log_out">LOG OUT</button>
        <!-- end if -->
        <!-- else if not loggedin then show this -->
        <?php }else if(!$login){?>
            <button type="submit">LOG IN</button>
        <?php } ?>
        <!-- end if -->
    </form>




</header>