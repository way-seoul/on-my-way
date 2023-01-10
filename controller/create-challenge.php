<?php

require_once 'model/challengeManager.php';
require_once 'model/placeManager.php';

$challenges = new ChallengeManager();
$places = new PlaceManager();
$action = 'create-challenge';
$btnText = 'Add A New Challenge';
$btnName = 'add-challenge';

//IF POST ARR IS SET - THEN FORM HAS BEEN SUBMITTED
$data = $_POST ?? null;
if(isset($_POST['add-challenge']) && $data) {
    $cleanData = $challenges->validateData($data);
    if($cleanData) {
        $challenges->addChallenge($cleanData);
        $formMsg = 'New Challenge Added';
    } else {
        $formMsg = 'Form Validation Failed!';
    }
}

//Pull list of existing places from DB for user to select from
$existingPlaces = $places->retrievePlaces();

require_once 'view/challenge-form.php';