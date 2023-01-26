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
            
            $verified_username = $user_info['username'];
            $verified_email = $user_info['email'];
            $verified_first_name = $user_info["first_name"];
            $verified_last_name = $user_info["last_name"];
            $verified_password = $user_info["password"];

            
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $verified_username;
            $_SESSION["email"] = $verified_email;
            $_SESSION["firstname"] = $verified_first_name;
            $_SESSION["lastname"] = $verified_last_name;
            $_SESSION["password"] = $verified_password;
        }else if($validated == false){
            echo "<script>alert('Incorrect username or password!')</script>";
        }
        
        $logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
        
        return $logged_in;
    }
}

function logout(){
    $logout = isset($_POST['log_out']) ? true : false;
    
    if($logout){
        session_destroy();
    }
}

$login = login();
$logout = logout();

include_once './view/loginView.php';