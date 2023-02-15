<?php
include_once './model/usersManager.php';

Class UsersContr extends Users{
    public static function registerUser(){
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) header('location: ' . ROOT);

        if(isset($_POST['add'])){
            UsersContr::addUsers($_POST);
        }

        include_once './view/registerView.php';
    }

    public static function loginUser(){
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) header('location: ' . ROOT);

        if(isset($_POST['login_button']) && isset($_POST['username']) !== '' && isset($_POST['password']) !== ''){
            $user = new Users();

            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $user_info = $user->getUser($username);

            if($user_info == true){
                
                $verified_password = password_verify($password, $user_info['password']);
                
                $validated = isset($username) && isset($password) && $username == $user_info['username'] && $verified_password == true ? true : false;
                
                if($validated == true){
                    
                    $verified_username = $user_info['username'];
                    $verified_user_id = $user_info['id'];
                    $verified_admin = $user_info['admin'];

                    
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $verified_user_id;
                    $_SESSION['admin'] = $verified_admin;
                    $_SESSION['user'] = $verified_username;

                    $total_points = Users::getUserTotalPoints($_SESSION['user_id']);
                    $_SESSION['total_points'] = $total_points['points_total'];

                }else{
                    echo "<script>alert('Incorrect username or password!')</script>";
                }
                
                $logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
                $is_admin = (isset($_SESSION['admin']) && $_SESSION['admin'] == 1);
    
                if($logged_in){
                    if(!$is_admin) header('location: index.php?action=home');
                    else header('location: index.php?action=admin');
                }
                
            }else{
                echo "<script>alert('Incorrect username or password!')</script>";
            }
        }
        
        include_once './view/loginView.php';
    }
}