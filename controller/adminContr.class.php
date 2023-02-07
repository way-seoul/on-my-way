<?php
include './model/adminManager.php';

class AdminContr {
    public static function admin(){
        if(!isset($_SESSION['logged_in'])){ // Validate if logged in user is an admin in the condition later.
            header('location: index.php?action=');
        }else{
            //Delete user
            //prepare data
            $manager = new Admin();
            
            if (isset($_POST['delete'])) {
                // delete user
                $id = $_POST['id'];
                $manager->deleteUser($id);
            }elseif (isset($_POST['add'])) {
                // add user
                $manager->addUsers($_POST);
            }
            
            $users = $manager->listUsers();
            
            //Reset password
            if(isset($_POST['reset'])){
                $id = $_POST['id'];
                $reset_password = '0000';
                $manager->resetUserPassword($reset_password, $id);
            }
    
            include './view/adminView.php';
        }
    }

    public static function adminEdit(){
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
}