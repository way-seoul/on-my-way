<?php


    $action = $_GET['action'] ?? '';

    print_r($_GET['action']);

    switch($action) {
        case "create-challenge":
            include './controller/create-challenge.php';
            break;
        default:
            echo 'Nope youve chosen an invalid route';
            break;
    }
?>
