<?php

require_once 'model/challengeManager.php';
require_once 'model/placeManager.php';



$challenges = new ChallengeManager();
$places = new PlaceManager();


//IF POST ARR IS SET - THEN FORM HAS BEEN SUBMITTED
$data = $_POST ?? null;
if(isset($_POST['submit']) && $data) {
    $cleanData = $challenges->validateData($data);
    if($cleanData) {
        $challenges->addChallenge($cleanData);
    } else {
        $errMessage = 'Form Validation Failed!';
    }
}

//Pull list of existing places from DB for user to select from
$existingPlaces = $places->retrievePlaces();

require_once 'view/create-challenge-form.php';