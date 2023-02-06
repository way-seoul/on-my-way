<?php
include './model/usersManager.php';

Class UsersContr extends Users{
    public static function registerUser(){
        if(isset($_GET['from']) && $_GET['from']=='admin'){
            $fromAdmin = 1;
        }
        if(isset($_POST['add'])){
            UsersContr::addUsers($_POST);
        }

        include_once './view/registerView.php';
    }

    public static function loginUser(){
        $logged_in = false;

        if(isset($_POST['login_button']) || isset($_POST['login_button_header']) && ($_POST['username'] || $_POST['username_header']) !== '' && ($_POST['password'] || $_POST['password_header']) !== ''){
            $user = new Users();
            $username = $_POST['username'] ?? $_POST['username_header'];
            $password = $_POST['password'] ?? $_POST['password_header'];
            
            $user_info = $user->getUser($username);
            $verified_password = password_verify($password, $user_info['password']);
            
            $validated = isset($username) && isset($password) && $username == $user_info['username'] && $verified_password == true ? true : false;
            
            if($validated == true){
                
                $verified_username = $user_info['username'];
                
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $verified_username;
                $_SESSION['admin'] = $user_info['admin'];
            }else if($validated == false){
                echo "<script>alert('Incorrect username or password!')</script>";
            }
            
            $logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
            $is_admin = (isset($_SESSION['admin']) && $_SESSION['admin'] == 1);

            if($logged_in){
                if(!$is_admin) header('location: index.php?action=home');
                else header('location: index.php?action=admin');
            }
        }
        
        include_once './view/loginView.php';
    }
}