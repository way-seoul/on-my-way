<?php

    $title = 'ON MY WAY | REGISTER';
    ob_start();
?>

<div class="register_div">
    <img class="register_pic" src="public/image/loginPic.jpg" alt="register pic">
    <div class="register_header">
        <h1>REGISTER</h1>
    </div>
    <div class="register_form_top">
        <form method="POST" action="" style="margin-top: 3rem;">
            <div class="signup_username">
                <div class="username_label">
                    <label for="username">Username</label>
                </div>
                <input class="username_input" type="text" name="username" placeholder="Enter username" size="60">
            </div>
            <div class="signup_password">
                <div class="password_label">
                    <label for="password">Password</label>
                </div>
                <input class="password_input" type="text" name="password" placeholder="Enter password" size="60">
            </div>
            <div class="signup_email">
                <div class="email_label">
                    <label for="email">Email</label>
                </div>
                <input class="email_input" type="text" name="email" placeholder="Enter email" size="60">
            </div>
            <div class="firstname">
                <div class="firstname_label">
                    <label for="firstname">First Name</label>
                </div>
                <input class="firstname_input" type="text" name="first_name" placeholder="Enter first name" size="60">
            </div>
            <div class="lastname">
                <div class="lastname_label">
                    <label for="lastname">Last Name</label>
                </div>
                <input class="lastname_input" type="text" name="last_name" placeholder="Enter last name" size="60">
            </div>
            <div class="register_button_div">
                <button class="register_button" type="submit" name="add" value="add">REGISTER</button>
            </div>
        </form>
    </div>

    <div class="register_footer">
        <div class="register_link">
            <p>Already have an account? <a href="<?= LOGIN_PATH ?>">Log In</a></p>
        </div>
    </div>
    <div class="on_my_way_register">ON MY WAY</div>
</div>

<?php 
    $html = ob_get_clean();
    include 'non-logged-in-template.php';
    if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['user'])){
        header('Location: index.php?action=create-challenge');
    }
?>