<?php
    session_start();

    include_once "./controller/_paths.php";
    include_once "./controller/previewContr.class.php";
    include_once "./controller/homeContr.class.php";
    include_once "./controller/adminContr.class.php";
    include_once "./controller/usersContr.class.php";
    include_once "./controller/challengeContr.class.php";

    $action = $_GET['action'] ?? '';

    switch($action) {
        case 'admin':
            AdminContr::admin();
            break;
        case 'admin_edit': 
            AdminContr::adminEdit();
            break;
        case 'register':
            UsersContr::registerUser();
            break;
        case 'create-challenge':
            ChallengeContr::createChallenge();
            break;
        case 'list-challenges':
            ChallengeContr::listChallenges();
            break;
        case 'challenge-specific':
            ChallengeContr::showChallengeInfo();
            break;
        case "add-place":
            include './controller/add-place.php';
            break;
        case 'login':
            UsersContr::loginUser();
            break;
        case 'home':
            HomeContr::home();
            break;
        default:
            PreviewContr::preview();
            break;
    }
?>
