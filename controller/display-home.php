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


if (isset($_SESSION['logged_in'])) {
    // redirect instead of include?
    include 'view/home.php';
    print_r($_SESSION);
} else {
    // redirect instead of include?
    include 'view/landingView.php';
    print_r($_SESSION);
}
