<?php
include '../model/usersManager.php';

if(isset($_POST['login_button'])){
    $user = new Users;
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $verified_user = $user->verifyUserPassword($password);

    if($verified_user['username'])
}