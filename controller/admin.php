<?php 
include 'model/adminFunc.php';

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

//include view

include 'view/adminView.php';