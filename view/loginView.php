<?php
    $title = 'ON MY WAY | LOG IN';
    ob_start();
?>
<div class="login_div">
    <img class="login_pic" src="public/image/loginPic.jpg" alt="login pic">
    <div class="login_header">
        <h1>WELCOME BACK!</h1>
        <h2>LOG IN</h2>
    </div>
    <div class="login_form_top">
        <form method="POST" action="">
            <div class="login_username">
                <div class="username_label">
                    <label for="username">Username</label>
                </div>
                <input class="username_input" type="text" name="username" placeholder="Enter username" size="60">
            </div>
            <div class="login_password">
                <div class="password_label">
                    <label for="password">Password</label>
                </div>
                <input class="password_input" type="password" name="password" placeholder="Enter password" size="60">
            </div>
            <div class="login_button_div">
                <button class="login_button" type="submit" name="login_button">Log In</button>
            </div>
        </form>
    </div>
    <div class="login_footer">
        <div class="sign_up_link">
            <p>Don't have an account? <a href="<?= REGISTER_PATH ?>">Sign up</a></p>
        </div>
    </div>
    <div class="on_my_way">ON MY WAY</div>
</div>
<?php
    $html = ob_get_clean();
    include 'non-logged-in-template.php';
?>