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
            session_start();
            
            $verified_username = $user_info['username'];
            
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $verified_username;
        }else if($validated == false){
            echo "<script>alert('Incorrect username or password!')</script>";
        }
        
        $logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
        $logout = isset($_GET['log_out']) ? true : false;
        
        if($logout){
            $logged_in = false;
            session_destroy();
        }
        
        return $logged_in;
    }
}

$login = login();

include_once './view/loginView.php';