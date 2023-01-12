<?php
include '../model/usersManager.php';

if(isset($_POST['login_button'])){
    $user = new Users;
    $verified_user = $user->verifyUserPassword($password);

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if($password == $verified_user['password']){
        session_start();
    }
}