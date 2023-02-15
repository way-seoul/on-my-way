<?php
include_once './model/adminManager.php';
include_once './model/challengeManager.php';
include_once './model/placeManager.php';
include_once './model/usersManager.php';


class AdminContr {
    public static function admin(){

        $manager = new Admin();

        //create new account or verify to login for google users
        if (isset($_POST['username'])) {
            
            $usermanager = new Users();
            $googleName = $_POST['username'];
            $userInfo = $usermanager->getUser($googleName);

            //compare the google login user data with the users in our database
            //if not existed, create a new account for the user
            if($userInfo == null) {
                $manager->addUsers($_POST);
                $userInfo = $usermanager->getUser($googleName);
            } 

            $verified_username = $userInfo['username'];
            $verified_user_id = $userInfo['id'];
            $verified_admin = $userInfo['admin'];

            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $verified_user_id;
            $_SESSION['admin'] = $verified_admin;
            $_SESSION['user'] = $verified_username;

            $logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];

            if($logged_in){
                header('location: '. ROOT);
            }
    
        }

        if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) header('location: ' . ROOT);
        if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) header('location: ' . ROOT . 'home');
        
        //Delete user
        //prepare data
        // $manager = new Admin();
        
        if (isset($_POST['delete'])) {
            // delete user
            $id = $_POST['id'];
            $manager->deleteUser($id);
        }
        
        $users = $manager->listUsers();
        
        //Reset password
        if(isset($_POST['reset'])){
            $id = $_POST['id'];
            $reset_password = '0000';
            $manager->resetUserPassword($reset_password, $id);
        }

        // ********************************************* list challenges
        $c_manager = new ChallengeManager();
        $challenges = $c_manager->getChallDataForAdmin();
        $f_msg_deleteChll = "";
        
        if(isset($_POST['delete-chll']) && $_POST['delete-chll']!= '') {
            $delete_msg = $c_manager->deleteChallenge($_POST['delete-chll']);
            if($delete_msg == 1) {
                header('Location:' . ADMIN_PATH);
            } else {
                $f_msg_deleteChll = $delete_msg;
            }
        } 

        // ********************************************* list locations
        $places = $c_manager->getPlacesForAdmin();
        $f_msg_deletePlace = "";

        if(isset($_POST['delete-Place']) && $_POST['delete-Place']!='') {
            $delete_msg = $c_manager->deletePlace($_POST['delete-Place']);
            if($delete_msg == 1) {
                header('Location:' . ADMIN_PATH);
            } else {
                $f_msg_deletePlace = $delete_msg;
            }
        }

        include './view/adminView.php';
    }

    public static function adminEdit(){
        if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) header('location: ' . ROOT);
        if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) header('location: ' . ROOT . 'home');

        //prepare data
        $admin_edit_manager = new Admin();

        $id = $_GET['id'];

        if (isset($_POST['edit'])) {
            //show the pre-filled answer
            $edited_username = $_POST['username'];
            $edited_email = $_POST['email']; 
            $edited_firstname = $_POST['first_name']; 
            $edited_lastname = $_POST['last_name']; 
            $edited_admin = $_POST['admin']; 
            $admin_edit_manager -> editEntry($id, $edited_username, $edited_email, $edited_firstname, $edited_lastname, $edited_admin);
        }

        $user = $admin_edit_manager->showEntry($id);

        include './view/adminEditView.php';
    }

    public static function adminAdd() {
        $manager = new Admin();

        if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) header('location: ' . ROOT);
        if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) header('location: ' . ROOT . 'home');

        if(isset($_POST['add'])){
            $manager->addUsers($_POST);
        }

        $fromAdmin = 1;
        include_once './view/registerView.php';

    }
}