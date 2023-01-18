<?php 
include 'model/adminFunc.php';

//Delete user
//prepare data
$manager = new adminFunction();

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
    //reset password
    $id = $_POST['id'];
    $reset_password = '0000';
    $manager->resetUserPassword($reset_password, $id);
}

//include view

include 'view/adminView.php';