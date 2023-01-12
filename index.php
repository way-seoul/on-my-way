<?php

// determine action

$action = isset($_GET['action']) ? $_GET['action'] : '';

// determine valid actions
switch($action){
    //need to change default to cases: 'register'
    case "login": 
        include 'controller/register.php'; 
        break;
    case "edit":
        include "controller/editUser.php";
}