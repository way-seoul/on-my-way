<header>
    <nav id="menu">
        <ul>
            <li><a href="../on-my-way/index.php">On My Way</a></li>
            <li><a href="../on-my-way/index.php?action=create-challenge">Add challenge</a></li>
            <li><a href="../on-my-way/index.php?action=my-profile">See My Profile</a></li>
        </ul>
    </nav>
    <form method="GET" id="login-box">
        <!-- if loggedin then show this -->
            <span>
                Hi <strong><?= "username" ?></strong>!
            </span>
            <button type="submit" name="">LOG OUT</button>
        <!-- end if -->
        <!-- else if not loggedin then show this -->
            <button type="submit">LOG IN</button>
        <!-- end if -->
    </form>




</header>