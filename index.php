<?php
    $action = $_GET['action'] ?? '';

    switch($action) {
        case "create-challenge":
            include './controller/create-challenge.php';
            break;
        case "list-challenges":
            include './controller/list-challenges.php';
            break;
        case "challenge-specific":
            include './controller/challenge-specific.php';
            break;
        default:
            include './controller/display-home.php';
            break;
    }
?>
