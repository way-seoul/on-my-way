<?php

// determine action

$action = isset($_GET['action']) ? $_GET['action'] : '';

// determine valid actions
switch($action){
    case 'admin':
        include 'controller/admin.php';
        break;
    
    case 'admin_edit': 
        include 'controller/admin_edit.php'; 
        break;

    //need to change default to cases: 'landing-apge'
    default: 
        include 'controller/register.php'; 
        break;
}