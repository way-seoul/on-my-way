<?php
    $action = $_GET['action'] ?? '';

    switch($action) {
        case "create-challenge":
            include './controller/create-challenge.php';
            break;
        default:
            include './controller/display-home.php';
            break;
    }
?>
