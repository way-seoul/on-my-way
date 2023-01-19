<?php
include_once './model/usersManager.php';

function login(){

    if(isset($_POST['login_button']) && $_POST['username'] !== '' && $_POST['password'] !== ''){
        $user = new Users();
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $user_info = $user->getUser($username);
        $verified_password = password_verify($password, $user_info['password']);
        
        $validated = isset($username) && isset($password) && $username == $user_info['username'] && $verified_password == true ? true : false;
        
        if($validated == true){
            

            $_SESSION['logged_in'] = true;

        }
        
        $logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
        
        return $logged_in;
    }
}




