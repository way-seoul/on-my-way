<?php
include 'controllerHelper.php';
include './model/placeManager.php';

$placeManager = new PlaceManager();

//When user clicks 'share location' button, fetch all places and send back to front-end
if(isset($_GET['get_place_coords'])) {
    $existingPlaces = $placeManager->retrievePlaces();
    print_r(json_encode($existingPlaces));
    die();
}

if ($_SESSION['logged_in']) {
    include 'view/home.php';
} else {
    include 'view/landingView.php';
}
