<?php 
include 'model/registerFunc.php';

$register_manager = new registerFunction();

if (isset($_POST['add'])) {
    // add user
    $register_manager->addUsers($_POST);
}

//include view

include 'view/registerView.php';