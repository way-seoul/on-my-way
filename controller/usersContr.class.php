<?php
include 'model/usersManager.php';
include_once 'model/challengeManager.php';

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

        if(isset($_POST['login_button']) || isset($_POST['login_button_header']) && (isset($_POST['username']) || isset($_POST['username_header'])) !== '' && (isset($_POST['password']) || isset($_POST['password_header'])) !== ''){
            $user = new Users();

            $username = $_POST['username'] ?? $_POST['username_header'];
            $password = $_POST['password'] ?? $_POST['password_header'];
            
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

    public static function listLeaders(){
        if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) header('location: ' . ROOT);

        $u_manager = new Users();
        $how_many = 10;
        $ten_leaders = $u_manager->getLeadingUsers($how_many);

        $c_manager = new ChallengeManager();
        $challenges = $c_manager->newChallenges();
    
        include_once 'view/leaderboardView.php';
    }
}