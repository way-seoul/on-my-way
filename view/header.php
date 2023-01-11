<?php
    $highlight = 'text-decoration:underline';
    $username = 'username;'
?>

<header>
    <nav id="menu">
        <ul>
            <li><a href="../on-my-way/index.php">main</a></li>
            <li><a href="../on-my-way/index.php?action=list-challenges">challenges</a></li>
            <li><a href="../on-my-way/index.php?action=create-challenge">add challenge</a></li>
            <li><a href="../on-my-way/index.php?action=admin">users</a></li>
            <li><a href="../on-my-way/index.php?action=register">add user</a></li>
        </ul>
    </nav>
    <form method="GET" id="login-box">
        <!-- if loggedin then show this -->
            <span>
                Hi <strong><?= $username ?></strong>!
            </span>
            <button type="submit" name="">LOG OUT</button>
        <!-- end if -->
        <!-- else if not loggedin then show this -->
            <button type="submit">LOG IN</button>
        <!-- end if -->
    </form>




</header>