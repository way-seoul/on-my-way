<?php
    $title = 'ON MY WAY | REGISTER';
    ob_start();
?>

<div class="g-0 row" style="height:100vh;">
    <div class="col-12 col-md-6" style="position: relative; padding-right:0; padding-left:0; display: flex; justify-content: center; align-items: center; min-height: 100vh;">
        <img class="register_pic" src="public/image/loginPic.jpg" alt="register pic">
        <div class="on_my_way">ON MY WAY</div>
    </div>


    <div class="col-12 col-md-6" style="min-height:100vh;">
        <div class="register_div">
            <div class="register_header">
                <h1>REGISTER</h1>
            </div>
            <div class="register_form_top">
                <form method="POST" action="" style="margin-top: 3rem;">
                    <div class="signup_username">
                        <div class="username_label">
                            <label for="username">Username</label>
                        </div>
                        <input class="username_input" type="text" name="username" placeholder="Enter username" size="60" required>
                    </div>
                    <div class="signup_password">
                        <div class="password_label">
                            <label for="password">Password</label>
                        </div>
                        <input class="password_input" type="password" name="password" placeholder="Enter password" size="60" value="<?= (isset($fromAdmin) && $fromAdmin == 1) ? "0000":'' ?>" required>
                    </div>
                    <div class="signup_email">
                        <div class="email_label">
                            <label for="email">Email</label>
                        </div>
                        <input class="email_input" type="text" name="email" placeholder="Enter email" size="60" required>
                    </div>
                    <div class="firstname">
                        <div class="firstname_label">
                            <label for="firstname">First Name</label>
                        </div>
                        <input class="firstname_input" type="text" name="first_name" placeholder="Enter first name" size="60" required>
                    </div>
                    <div class="lastname">
                        <div class="lastname_label">
                            <label for="lastname">Last Name</label>
                        </div>
                        <input class="lastname_input" type="text" name="last_name" placeholder="Enter last name" size="60" required>
                    </div>
                    <?php if(isset($fromAdmin) && $fromAdmin == 1): ?> 
                        <div class="admin">
                            <div class="admin_label">
                                <label for="admin">Admin?</label>
                            </div>
                            <input class="admin_input" type="radio" name="admin" id="yes" value="1">
                            <label for="yes">YES</label>
                            <input class="admin_input" type="radio" name="admin" id="no" value="0" checked>
                            <label for="no">NO</label>
                        </div>
                        <div class="register_button_div">
                            <button class="register_button" type="submit" name="add" value="add">REGISTER</button>
                        </div>
                    <?php endif?>

                    <?php if(!isset($fromAdmin)): ?>
                        <div class="register_button_div">
                            <button class="register_button" type="submit" name="add" value="add">REGISTER</button>
                            <div class="register_footer">
                                <div class="register_link">
                                    <p>Already have an account? <a href="<?= LOGIN_PATH ?>">Log In</a></p>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </form>
            </div>
        </div>  
    </div>
</div>

<?php
    //re-direct users after form submissions
    
    if (isset($fromAdmin) && $fromAdmin == 1 && isset($_POST["add"]) && $_POST["add"]){
        header('Location:'. ADMIN_PATH);
    } else if(!isset($fromAdmin) && isset($_POST["add"]) && $_POST["add"]){
        header('Location:'. LOGIN_PATH);
    }
?>

<?php 
    $html = ob_get_clean();
    include 'non-logged-in-template.php';
    if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['user'])){
        //header('Location: index.php?action=create-challenge');
    }
?>