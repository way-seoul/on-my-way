<?php

Class HomeContr {
    public static function home(){
        $placeManager = new PlaceManager();
        if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) header('location: ' . ROOT);

        //When user clicks 'share location' button, fetch all places and send back to front-end
        if(isset($_POST['get_place_coords'])) {
            $existingPlaces = $placeManager->retrievePlaces();
            print_r(json_encode($existingPlaces));
            die();
        }
        include './view/homeView.php';
    }
}