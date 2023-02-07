<?php

Class HomeContr {
    public static function home(){
        $placeManager = new PlaceManager();

        //When user clicks 'share location' button, fetch all places and send back to front-end
        if(isset($_GET['get_place_coords'])) {
            $existingPlaces = $placeManager->retrievePlaces();
            print_r(json_encode($existingPlaces));
            die();
        }
        
        include './view/homeView.php';
    }
}