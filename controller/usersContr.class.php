<?php
include './model/usersManager.php';

Class UsersContr extends Users{
    public static function registerUser(){
        if(isset($_POST['add'])){
            UsersContr::addUsers($_POST);
        }

        include_once './view/registerView.php';
    }

    public static function loginUser(){
        $logged_in = false;

        if(isset($_POST['login_button']) && $_POST['username'] !== '' && $_POST['password'] !== ''){
            $user = new Users();
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $user_info = $user->getUser($username);
            $verified_password = password_verify($password, $user_info['password']);
            
            $validated = isset($username) && isset($password) && $username == $user_info['username'] && $verified_password == true ? true : false;
            
            if($validated == true){
                
                $verified_username = $user_info['username'];
                
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $verified_username;
            }else if($validated == false){
                echo "<script>alert('Incorrect username or password!')</script>";
            }
            
            $logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];

            if($logged_in){
                header('location: index.php?action=home');
            }
        }

        include_once './view/loginView.php';
    }
}