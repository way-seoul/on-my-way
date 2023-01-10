<?php

// determine action

$action = isset($_GET['action']) ? $_GET['action'] : '';

// determine valid actions
switch($action){
    //need to change default to cases: 'register'
    default: 
        include 'controller/register.php'; 
        break;
}