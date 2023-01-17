<?php
    include_once "controller/_paths.php";

    $action = $_GET['action'] ?? '';

    switch($action) {
        case 'admin':
            include 'controller/admin.php';
            break;
        case 'admin_edit': 
            include 'controller/admin_edit.php'; 
            break;
        case 'register':
            include 'controller/register.php'; 
            break;
        case "create-challenge":
            include './controller/create-challenge.php';
            break;
        case "list-challenges":
            include './controller/list-challenges.php';
            break;
        case "challenge-specific":
            include './controller/challenge-specific.php';
            break;
        case "edit":
            include "controller/editUser.php";
            break;
        default:
            include './controller/display-home.php';
            break;
    }
?>
