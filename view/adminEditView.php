<?php 
    $title = 'ON MY WAY | EDIT THE USER';
    $admin_check = isset($user['admin']) && $user['admin'] == 1 ? 1:0;
    ob_start();
?>

<div class="container form-view">

    <!-- <div class="btn"> -->
    <div class="back-btn">
        <!-- <button type="button"> -->
        <a href="<?= ADMIN_PATH ?>">← See Full List of Users</a>
        <!-- </button> -->
    </div>

    <h1>Edit The User</h1>
    <h2>You're editing user id: <?= $user['id'];?> user name: <?= $user['username'];?></h2>


    <form method="POST" action="" style="margin-top: 3rem;">
    <div class="row">
            <div class="col-md-6 col-12 form-box">
                <div class="fields">
                    <label for="username">User Name: </label>
                    <input type="text" name="username" id="username" value=<?= isset($user['username'])? $user['username']:" ";?>>
                </div>
                <div class="fields">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" value=<?= isset($user['email'])? $user['email']:" ";?>>
                </div>
                <div class="fields">
                    <label>Admin: </label>
                    <div id="exception">
                        <input class="radio" type="radio" name="admin" id="yes" value="1" <?= $admin_check == 1? 'checked':""?>>
                        <label for="yes">YES</label>
                        <input class="radio" type="radio" name="admin" id="no" value="0"  <?= $admin_check == 0? 'checked':""?>>
                        <label for="no">NO</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 form-box">
                <div class="fields">
                    <label for="first_name">First Name: </label>
                    <input type="text" name="first_name" id="first_name" value=<?= isset($user['first_name'])? $user['first_name']:" ";?>>
                </div>
                <div class="fields">
                    <label for="last_name">Last Name: </label>
                    <input type="text" name="last_name" id="last_name" value=<?= isset($user['last_name'])? $user['last_name']:" ";?>>
                </div>
                <button type="submit" name="edit" value="edit" class="submit-btn">Done</button>
            </div>
        </div>
    </form>

</div>

<?php 
    $html = ob_get_clean();
    include 'template.php';
?>